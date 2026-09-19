<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('name');
            $table->decimal('profit_share', 5, 2)->nullable();
            $table->string('status')->default('active')->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('status')->default('active');
            $table->timestamps();
        });
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('transaction_number')->unique();
            $table->uuid('request_token')->nullable()->unique();
            $table->date('transaction_date')->index();
            $table->string('transaction_type')->index();
            $table->foreignId('partner_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('resident_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('expense_category_id')->nullable()->constrained()->restrictOnDelete();
            $table->nullableMorphs('source');
            $table->decimal('amount', 14, 2);
            $table->string('direction');
            $table->string('paid_from')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('reference_number')->nullable()->index();
            $table->string('description');
            $table->text('notes')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();
            $table->string('status')->default('active')->index();
            $table->foreignId('reversal_of_id')->nullable()->constrained('financial_transactions')->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->unique(['source_type', 'source_id']);
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->string('transaction_number')->nullable()->unique()->after('id');
            $table->uuid('request_token')->nullable()->unique()->after('transaction_number');
            $table->string('status')->default('active')->after('notes');
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('updated_by');
            $table->dropColumn(['transaction_number', 'request_token', 'status']);
        });
        Schema::dropIfExists('financial_transactions');
        Schema::dropIfExists('expense_categories');
        Schema::dropIfExists('partners');
    }
};
