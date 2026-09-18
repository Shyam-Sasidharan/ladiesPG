<?php

// Uses a new, isolated database for each run. Never touches the application database.
require __DIR__.'/../vendor/autoload.php';
use App\Models\ActiveAllocation;
use App\Models\Allocation;
use App\Models\Floor;
use App\Models\Resident;
use App\Models\Room;
use App\Services\AllocationService;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Process\Process;

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();
if (($argv[1] ?? '') === 'worker') {
    config(['database.connections.mysql.database' => $argv[2]]);
    DB::purge('mysql');
    while (microtime(true) < (float) $argv[5]) {
        usleep(1000);
    }
    try {
        app(AllocationService::class)->allocate((int) $argv[3], (int) $argv[4], ['date' => today()->toDateString()]);
        echo 'allocated';
    } catch (ValidationException $e) {
        echo 'rejected';
    }
    exit;
}
if (! app()->environment('local', 'testing')) {
    throw new RuntimeException('Run concurrency checks only locally.');
}
$database = 'ladies_pg_test_'.date('YmdHis');
$connection = config('database.connections.mysql');
$pdo = new PDO('mysql:host='.$connection['host'].';port='.$connection['port'], $connection['username'], $connection['password']);
$pdo->exec('CREATE DATABASE `'.$database.'` CHARACTER SET utf8mb4');
config(['database.default' => 'mysql', 'database.connections.mysql.database' => $database]);
DB::purge('mysql');
Artisan::call('migrate', ['--force' => true]);
$floor = Floor::create(['name' => 'Concurrency test', 'number' => 0]);
$room = Room::create(['floor_id' => $floor->id, 'number' => 'T1', 'capacity' => 2, 'monthly_rent' => 5000, 'security_deposit' => 10000]);
$bed = $room->beds()->create(['name' => 'B1', 'position' => 1]);
$bed2 = $room->beds()->create(['name' => 'B2', 'position' => 2]);
$residents = [];
foreach ([1, 2, 3] as $i) {
    $residents[] = Resident::create(['full_name' => 'Concurrent '.$i, 'mobile' => '900000000'.$i, 'joining_date' => today()->toDateString()]);
}
$race = function (array $pairs) use ($database) {
    $start = microtime(true) + 2;
    $processes = [];
    foreach ($pairs as [$resident,$bed]) {
        $p = new Process([PHP_BINARY, __FILE__, 'worker', $database, (string) $resident, (string) $bed, (string) $start], dirname(__DIR__));
        $p->start();
        $processes[] = $p;
    }
    $out = [];
    foreach ($processes as $p) {
        $p->wait();
        if (! $p->isSuccessful()) {
            throw new RuntimeException($p->getErrorOutput().$p->getOutput());
        } $out[] = trim($p->getOutput());
    }
    sort($out);
    if ($out !== ['allocated', 'rejected']) {
        throw new RuntimeException('Race protection failed: '.json_encode($out));
    }
};
$race([[$residents[0]->id, $bed->id], [$residents[1]->id, $bed->id]]);
if (ActiveAllocation::count() !== 1 || Allocation::count() !== 1) {
    throw new RuntimeException('Unexpected allocation count.');
}
$room2 = Room::create(['floor_id' => $floor->id, 'number' => 'T2', 'capacity' => 1, 'monthly_rent' => 5000, 'security_deposit' => 10000]);
$bed3 = $room2->beds()->create(['name' => 'B1', 'position' => 1]);
$race([[$residents[2]->id, $bed2->id], [$residents[2]->id, $bed3->id]]);
if (ActiveAllocation::count() !== 2 || Allocation::count() !== 2) {
    throw new RuntimeException('Duplicate resident allocation.');
}
echo "PASS: two concurrent admins cannot allocate the same bed or the same resident.\nIsolated test database: $database\n";
