<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emission', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name column
            $table->string('type'); // Type column
            $table->float('emission'); // Emission column (decimal with precision)
            $table->timestamps(); // Created at and updated at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emission');
    }
};
