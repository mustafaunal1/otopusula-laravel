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
    Schema::create('yorumlar', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('arac_id');
        $table->string('yazan_ad');
        $table->integer('puan');
        $table->text('yorum');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yorumlar');
    }
};
