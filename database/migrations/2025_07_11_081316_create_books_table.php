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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('author_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->enum('read_status', ['readed', 'reading', 'not_read'])->default('not_read');
            $table->string('publisher')->nullable();
            $table->integer('total_pages')->nullable();
            $table->decimal('cover_price', 12, 2)->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
