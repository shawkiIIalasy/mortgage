<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_amortization_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->integer('month_number');
            $table->double('start_balance');
            $table->double('amount')->comment('Monthly');
            $table->double('principal_amount');
            $table->double('interest_amount');
            $table->double('end_balance');

            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('loan_id')
                ->references('id')
                ->on('loans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_amortization_schedule');
    }
};
