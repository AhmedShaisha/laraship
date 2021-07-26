<?php

namespace Corals\Modules\Support\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SupportTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_Supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('ticket_number');
            $table->string('title');
            $table->text('description')->nullable();
            
            $table->enum('status', ['answered', 'no response yet'])->default('no response yet');
            $table->enum('customer_type', ['seller', 'buyer'])->default('buyer');

            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();

            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('order_id')->references('id')
                ->on('marketplace_orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_Supports');
    }
}
