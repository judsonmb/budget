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
        Schema::create('mobile_projects', function (Blueprint $table) {
            $table->id();
            $table->enum('platform', ['iOS', 'Android', 'iOS and Android']);
            $table->integer('screens_number');
            $table->boolean('has_login');
            $table->boolean('has_payment');
            $table->foreignId('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_projects');
    }
};
