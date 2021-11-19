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
            $table->id();
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
                
                
            $table->unsignedBigInteger('brands_id');
            $table->foreign('brands_id')
                ->references('id')
                ->on('brands')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->string('name', 255);
            $table->string('img', 255)->nullable();
            $table->decimal('price', 8, 0)->default(0);
            $table->integer('soluong')->default(0);
            $table->string('slug', 255)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
