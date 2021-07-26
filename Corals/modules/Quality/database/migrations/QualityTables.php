<?php

namespace Corals\Modules\Quality\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QualityTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_tests', function (Blueprint $table) {
            $table->increments('id');

            //added
            $table->string('code')->unique();
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('order_item_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->text('shipping')->nullable();
            $table->enum('status', ['accepted', 'rejected','review','pending'])->default('pending');
            $table->string('note');
            $table->integer('discount_percentage')->nullable();
            $table->text('response')->nullable();

            //end

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('order_id')->references('id')
                ->on('marketplace_orders')->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('product_id')->references('id')
                ->on('marketplace_products')->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('order_item_id')->references('id')
                ->on('marketplace_order_items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_tests');
    }
}
