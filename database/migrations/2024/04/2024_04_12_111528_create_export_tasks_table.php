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
        Schema::create('import_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->default(null)->constrained();
            $table->string('path');
            $table->unsignedTinyInteger('status')->nullable()->default(null);
            $table->unsignedInteger('success_count')->nullable()->default(null);
            $table->unsignedInteger('errors_count')->nullable()->default(null);
            $table->timestamp('finished_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_tasks');
    }
};
