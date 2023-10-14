<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('db_store_number')->unique();
            $table->string('db_store_name')->nullable();
            $table->string('db_store_phone')->nullable()->unique();
            $table->string('db_store_email')->nullable()->unique();
            $table->text('db_store_image')->nullable();
            $table->text('db_store_address')->nullable();
            $table->integer('db_store_status')->nullable();
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};