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
        Schema::create('skor', function (Blueprint $table) {
            $table->id('skor_id');
            $table->float('emission_km');
            $table->float('emission_kwh');
            $table->float('emission_food');
            $table->string('food'); // Changed to string
            $table->string('energy'); // Changed to string
            $table->string('transport'); // Changed to string
            $table->timestamps();
        });

        Schema::create('history_carbon_footprint', function (Blueprint $table) {
            $table->id('history_id');
            $table->unsignedBigInteger('skor_id');
            $table->unsignedBigInteger('user_id');
            $table->text('rekomendasi');
            $table->date('date');
            $table->foreign('skor_id')->references('skor_id')->on('skor')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('useraccount')->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor');
        Schema::dropIfExists('history_carbon_footprint');
    }
};
