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
            $table->foreignId('item_id')->constrained();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('desc')->nullable();
            $table->string('color')->nullable();
            $table->string('dimension')->nullable();
            $table->unsignedInteger('cc')->nullable();
            $table->float('weight' , 6 , 2 , true)->nullable();
            $table->float('price' , 6 , 2 , true);
            $table->float('percentage')->nullable();
            $table->string('img')->nullable();
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
