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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('db_store_id')->nullable();
            $table->unsignedBigInteger('db_employee_id')->nullable();
            $table->unsignedBigInteger('db_customer_id')->nullable();
            $table->string('db_account_name')->unique();
            $table->string('db_account_password');
            $table->text('db_account_token')->nullable();
            $table->text('db_account_refresh_token')->nullable();
            $table->string('db_account_device')->nullable();
            $table->integer('db_account_status')->nullable()->default(1)->comment('1: Active, 2: not active, 3: block');
            $table->softDeletesTz();
            $table->timestampsTz();
            $table->foreign('db_store_id')->references('id')->on('stores');
            $table->foreign('db_employee_id')->references('id')->on('employees');
            $table->foreign('db_customer_id')->references('id')->on('customers');
        });

        DB::statement('ALTER TABLE accounts MODIFY created_at VARCHAR(255), MODIFY updated_at VARCHAR(255), MODIFY deleted_at VARCHAR(255)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};