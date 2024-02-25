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
        Schema::create('box_receits', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('box_id');
            $table->unsignedInteger('receit_id');
            $table->integer('balance');
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('box_receits');
    }
};
