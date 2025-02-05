<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('film_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        // Insert predefined film types
        DB::table('film_types')->insert([
            ['id' => 1, 'type' => 'Curta'],
            ['id' => 2, 'type' => 'Longa'],
            ['id' => 3, 'type' => 'Documentario'],
            ['id' => 4, 'type' => 'Animação'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_types');
    }
};
