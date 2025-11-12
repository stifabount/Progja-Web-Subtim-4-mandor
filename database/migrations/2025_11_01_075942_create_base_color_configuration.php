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
        Schema::create('base_color_configuration', function (Blueprint $table) {
            $table->id();
            $table->string('base_color');
            $table->string('pr_color');
            $table->string('sec_color');
            $table->string('third_color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_color_configuration');
    }
};
