<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pro_name')->nullable();
            $table->integer('pro_category_id')->index()->default(0);
            $table->integer('pro_price')->default(0);
            $table->tinyInteger('pro_sale')->default(0);
            $table->tinyInteger('pro_active')->default(1)->index();
            $table->tinyInteger('pro_hot')->default(0);
            $table->integer('pro_view')->default(0);
            $table->string('pro_avatar')->nullable();
            $table->string('pro_slug')->index();
            $table->string('pro_title_seo')->nullable();
            $table->longText('pro_content')->nullable();
            $table->integer('pro_number')->default(0);
            $table->integer('pro_buy')->default(0);
            $table->integer('pro_total_number')->default(0);
            $table->integer('pro_total_rating')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
