<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->date('notice_date')->nullable()->after('date');
            $table->string('deposit_action')->default('refund_later')->after('reason');
            $table->decimal('deposit_held', 12, 2)->default(0)->after('deposit_action');
            $table->decimal('deposit_refunded', 12, 2)->default(0)->after('refund');
            $table->decimal('pending_refund', 12, 2)->default(0)->after('deposit_refunded');
            $table->text('final_settlement_notes')->nullable()->after('notes');
        });

        DB::table('checkouts')->orderBy('id')->each(function ($checkout) {
            DB::table('checkouts')->where('id', $checkout->id)->update([
                'deposit_action' => $checkout->deposit_applied > 0 ? 'adjust_against_dues' : 'refund_later',
                'deposit_held' => $checkout->refund + $checkout->deductions + $checkout->deposit_applied,
                'deposit_refunded' => 0,
                'pending_refund' => $checkout->refund,
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('checkouts', fn (Blueprint $table) => $table->dropColumn([
            'notice_date', 'deposit_action', 'deposit_held', 'deposit_refunded', 'pending_refund', 'final_settlement_notes',
        ]));
    }
};
