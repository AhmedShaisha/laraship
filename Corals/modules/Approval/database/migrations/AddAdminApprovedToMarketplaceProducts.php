<?php
namespace Corals\Modules\Approval\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Corals\Modules\Marketplace\database\migrations;

class AddAdminApprovedToMarketplaceProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketplace_products', function (Blueprint $table) {
            //
            $table->enum('admin_approved', ['accepted', 'rejected','pending','review','no request'])->default('no request');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace_products', function (Blueprint $table) {
            //
            $table->dropColumn('admin_approved');
        });
    }
}
