<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', fn (Blueprint $t) => $t->boolean('is_admin')->default(false));
        Schema::create('floors', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();
            $t->integer('number')->default(0);
            $t->text('notes')->nullable();
            $t->timestamps();
        });
        Schema::create('rooms', function (Blueprint $t) {
            $t->id();
            $t->foreignId('floor_id')->constrained()->restrictOnDelete();
            $t->string('number')->unique();
            $t->string('type')->default('Sharing');
            $t->unsignedInteger('capacity');
            $t->decimal('monthly_rent', 12, 2);
            $t->decimal('security_deposit', 12, 2)->default(0);
            $t->boolean('ac')->default(false);
            $t->boolean('attached_bathroom')->default(false);
            $t->boolean('food_included')->default(false);
            $t->string('status')->default('active');
            $t->text('notes')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });
        Schema::create('beds', function (Blueprint $t) {
            $t->id();
            $t->foreignId('room_id')->constrained()->restrictOnDelete();
            $t->string('name');
            $t->unsignedInteger('position');
            $t->string('status')->default('available');
            $t->timestamps();
            $t->unique(['room_id', 'name']);
        });
        Schema::create('residents', function (Blueprint $t) {
            $t->id();
            $t->string('full_name');
            $t->string('mobile', 20)->index();
            $t->string('whatsapp', 20)->nullable();
            $t->string('email')->nullable();
            $t->date('date_of_birth')->nullable();
            $t->text('address')->nullable();
            $t->string('emergency_name')->nullable();
            $t->string('emergency_phone', 20)->nullable();
            $t->string('guardian_name')->nullable();
            $t->string('guardian_phone', 20)->nullable();
            $t->string('id_type')->nullable();
            $t->string('id_number')->nullable();
            $t->string('photo')->nullable();
            $t->date('joining_date');
            $t->date('expected_checkout')->nullable()->index();
            $t->string('occupation')->nullable();
            $t->string('organization')->nullable();
            $t->decimal('monthly_rent', 12, 2)->default(0);
            $t->decimal('security_deposit', 12, 2)->default(0);
            $t->boolean('food_required')->default(false);
            $t->string('status')->default('active')->index();
            $t->text('notes')->nullable();
            $t->foreignId('created_by')->nullable()->constrained('users');
            $t->foreignId('updated_by')->nullable()->constrained('users');
            $t->timestamps();
            $t->softDeletes();
        });
        Schema::create('allocations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('resident_id')->constrained()->restrictOnDelete();
            $t->foreignId('bed_id')->constrained()->restrictOnDelete();
            $t->date('check_in');
            $t->date('check_out')->nullable();
            $t->decimal('rent', 12, 2);
            $t->decimal('deposit', 12, 2);
            $t->text('notes')->nullable();
            $t->foreignId('created_by')->nullable()->constrained('users');
            $t->timestamps();
            $t->index(['resident_id', 'check_out']);
        });
        // This small current-state table supplies portable unique constraints on both sides.
        Schema::create('active_allocations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('resident_id')->unique()->constrained()->restrictOnDelete();
            $t->foreignId('bed_id')->unique()->constrained()->restrictOnDelete();
            $t->foreignId('allocation_id')->unique()->constrained()->restrictOnDelete();
        });
        Schema::create('room_transfers', function (Blueprint $t) {
            $t->id();
            $t->foreignId('resident_id')->constrained();
            $t->foreignId('from_allocation_id')->constrained('allocations');
            $t->foreignId('to_allocation_id')->constrained('allocations');
            $t->date('date');
            $t->text('notes')->nullable();
            $t->timestamps();
        });
        Schema::create('rent_records', function (Blueprint $t) {
            $t->id();
            $t->foreignId('resident_id')->constrained()->restrictOnDelete();
            $t->foreignId('allocation_id')->nullable()->constrained();
            $t->date('month');
            $t->date('due_date');
            $t->decimal('amount', 12, 2);
            $t->decimal('late_fee', 12, 2)->default(0);
            $t->timestamps();
            $t->unique(['resident_id', 'month']);
        });
        Schema::create('payments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('resident_id')->constrained()->restrictOnDelete();
            $t->foreignId('rent_record_id')->nullable()->constrained()->restrictOnDelete();
            $t->string('type')->default('rent');
            $t->date('payment_date');
            $t->decimal('amount', 12, 2);
            $t->string('method');
            $t->string('reference')->nullable();
            $t->text('notes')->nullable();
            $t->foreignId('created_by')->nullable()->constrained('users');
            $t->timestamps();
        });
        Schema::create('checkouts', function (Blueprint $t) {
            $t->id();
            $t->foreignId('resident_id')->constrained();
            $t->foreignId('allocation_id')->unique()->constrained();
            $t->date('date');
            $t->text('reason');
            $t->decimal('pending_rent', 12, 2);
            $t->decimal('deductions', 12, 2);
            $t->decimal('refund', 12, 2);
            $t->text('notes')->nullable();
            $t->foreignId('created_by')->nullable()->constrained('users');
            $t->timestamps();
        });
        Schema::create('resident_documents', function (Blueprint $t) {
            $t->id();
            $t->foreignId('resident_id')->constrained();
            $t->string('name');
            $t->string('type');
            $t->string('path');
            $t->string('mime');
            $t->date('expires_at')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });
    }

    public function down(): void
    {
        foreach (['resident_documents', 'checkouts', 'payments', 'rent_records', 'room_transfers', 'active_allocations', 'allocations', 'residents', 'beds', 'rooms', 'floors'] as $table) {
            Schema::dropIfExists($table);
        } Schema::table('users', fn (Blueprint $t) => $t->dropColumn('is_admin'));
    }
};
