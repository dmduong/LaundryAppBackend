<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('db_store_id');
            $table->string('db_employee_number')->unique();
            $table->string('db_employee_name')->nullable();
            $table->integer('db_employee_gender')->nullable()->default(1)->comment('0: girl, 1: boy');
            $table->date('db_employee_birthday')->nullable();
            $table->string('db_employee_phone')->nullable()->unique();
            $table->string('db_employee_email')->nullable()->unique();
            $table->text('db_employee_image')->nullable();
            $table->text('db_employee_address')->nullable();
            $table->integer('db_employee_status')->nullable();
            $table->softDeletesTz();
            $table->timestampsTz();
            $table->foreign('db_store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};