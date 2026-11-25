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
        Schema::create('araclar', function (Blueprint $table) {
            $table->id();
            $table->string('marka');
            $table->string('model');
            $table->year('yil');
            $table->string('yakit_turu');
            $table->string('motor_gucu');
            $table->decimal('bakim_maliyeti', 8, 2)->nullable();
            $table->string('resim_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('araclar');
    }
};
