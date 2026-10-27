<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type'); // physical, service, digital
            $table->string('availability')->default('available'); // available, sold_out, preorder
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->string('image')->nullable();
            $table->date('preorder_ends_at')->nullable();
            $table->string('production_estimate')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
