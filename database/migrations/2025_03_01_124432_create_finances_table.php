<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type'); // Income, Expense, Payroll, etc.
            $table->decimal('amount', 15, 2);
            $table->string('currency')->default('KES'); // Kenyan Shillings
            $table->string('category'); // Salary, Taxes, Procurement, etc.
            $table->string('description')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('department_id')->nullable(); // Department making the transaction
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
