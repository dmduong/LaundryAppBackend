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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('db_store_id');
            $table->string('db_customer_number')->nullable()->unique();
            $table->string('db_customer_name');
            $table->integer('db_customer_gender')->nullable()->default(1)->comment('0: girl, 1: boy');
            $table->date('db_customer_birthday')->nullable();
            $table->text('db_customer_address')->nullable();
            $table->string('db_customer_phone')->unique()->nullable();
            $table->string('db_customer_email')->unique()->nullable();
            $table->text('db_customer_image')->nullable();
            $table->integer('db_customer_status')->nullable();
            $table->softDeletesTz();
            $table->timestampsTz();
            $table->foreign('db_store_id')->references('id')->on('stores');
        });

        DB::statement('ALTER TABLE customers MODIFY created_at VARCHAR(255), MODIFY updated_at VARCHAR(255), MODIFY deleted_at VARCHAR(255)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};