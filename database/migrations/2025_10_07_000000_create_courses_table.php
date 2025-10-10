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
        Schema::create('courses', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('level');
            $table->string('subject');
            $table->string('title');
            $table->text('description');
            $table->text('image');
            $table->boolean('is_active')->default(true);
            $table->foreignUlid('instructor_id')->constrained('users')->onDelete('cascade');
            $table->text('topics');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
