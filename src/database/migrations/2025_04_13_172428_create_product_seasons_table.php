<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_seasons', function (Blueprint $table) {
            $table->id(); // bigint unsigned, PRIMARY KEY
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade'); // 外部キー：products(id)
            $table->foreignId('season_id')
                ->constrained('seasons')
                ->onDelete('cascade'); // 外部キー：seasons(id)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_seasons');
    }
}
