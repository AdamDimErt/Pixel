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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('description');
            $table->integer('cost');
            $table->integer('discount_cost')->nullable();
            $table->integer('damage_cost')->nullable();
            $table->json('related_goods')->nullable();

            $table->unsignedBigInteger('good_type_id');
            $table->foreign('good_type_id')->references('id')->on('good_types');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
