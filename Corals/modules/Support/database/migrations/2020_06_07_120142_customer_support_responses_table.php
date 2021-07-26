<?php
namespace Corals\Modules\Support\database\migrations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerSupportResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_support_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('response')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('customer_Support_id')->nullable();
            $table->unsignedInteger('order_id')->nullable();


            $table->foreign('customer_Support_id')->references('id')
            ->on('customer_Supports')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('order_id')->references('id')
            ->on('marketplace_orders')->onDelete('cascade')->onUpdate('cascade');
                
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists('customer_support_responses');
    }
}
