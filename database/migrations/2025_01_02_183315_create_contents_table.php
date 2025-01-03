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
    public function up() : void
    {
        Schema::create('content', function (Blueprint $table) {
            $table->id('content_id'); // Primary key
            $table->string('name'); // Name column
            $table->text('description')->nullable(); // Description column, nullable
            $table->string('path'); // Path column
            $table->date('date')->default(now()->toDateString());
            $table->timestamps(); // Created at and Updated at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists('content');
    }
};