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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 15, 2);
            $table->string('currency')->default('IDR');
            $table->integer('stock')->default(0);
            $table->enum('production_method', ['Hand-Carved', 'CNC-Assisted'])->default('Hand-Carved');
            $table->string('svlk_certificate_number')->nullable();
            $table->date('svlk_issue_date')->nullable();
            $table->string('model_3d_path')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
