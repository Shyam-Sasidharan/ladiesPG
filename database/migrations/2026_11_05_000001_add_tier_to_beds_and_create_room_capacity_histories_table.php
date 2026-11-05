<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beds', function (Blueprint $table) {
            $table->string('tier', 20)->nullable()->after('position'); // 'DOWN', 'TOP', 'SINGLE'
        });

        Schema::create('room_capacity_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('capacity');
            $table->string('sharing_type', 100);
            $table->date('effective_from');
            $table->date('effective_to')->nullable();
            $table->decimal('monthly_rent', 12, 2)->nullable();
            $table->decimal('rent_without_food', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['room_id', 'effective_from']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_capacity_histories');
        Schema::table('beds', function (Blueprint $table) {
            $table->dropColumn('tier');
        });
    }
};
