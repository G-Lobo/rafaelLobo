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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('coverArt');
            $table->string('link')->nullable();
            $table->string('videoLink')->nullable();
            $table->longText('content');
            $table->date('releaseDate');
            $table->integer('duration');
            $table->foreignId('typeId')->constrained('type');
            $table->foreignId('areaId')->constrained('area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
