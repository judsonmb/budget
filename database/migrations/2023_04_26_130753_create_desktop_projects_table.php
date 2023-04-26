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
        Schema::create('desktop_projects', function (Blueprint $table) {
            $table->id();
            $table->enum('supported_os', ['Windows', 'Linux', 'MacOS']);
            $table->integer('screens_number');
            $table->boolean('supports_prints');
            $table->boolean('access_license');
            $table->foreignId('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desktop_projects');
    }
};
