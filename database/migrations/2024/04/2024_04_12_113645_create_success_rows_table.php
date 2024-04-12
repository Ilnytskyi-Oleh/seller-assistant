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
        Schema::create('success_rows', function (Blueprint $table) {
            $table->id();
            $table->string('row1')->nullable()->default(null);
            $table->string('row2')->nullable()->default(null);
            $table->string('row3')->nullable()->default(null);
            $table->string('row4')->nullable()->default(null);
            $table->string('row5')->nullable()->default(null);
            $table->string('row6')->nullable()->default(null);
            $table->string('row7')->nullable()->default(null);
            $table->string('row8')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_rows');
    }
};
