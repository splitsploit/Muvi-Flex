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
            $table->string('trailer');
            $table->string('casts');
            $table->string('categories');
            $table->string('small_thumbnail');
            $table->string('large_thumbnail');
            $table->date('release_date');
            $table->text('about');
            $table->string('short_about');
            $table->boolean('featured'); // tinyint 0 - 1
            $table->softDeletes(); // deleted_at()
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
