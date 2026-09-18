<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('checkouts', fn (Blueprint $t) => $t->decimal('deposit_applied', 12, 2)->default(0));
    }

    public function down(): void
    {
        Schema::table('checkouts', fn (Blueprint $t) => $t->dropColumn('deposit_applied'));
    }
};
