<?php

namespace Corals\Modules\Approval\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Corals\Modules\Marketplace\database\migrations;

class AddIsInfluencerStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketplace_stores', function (Blueprint $table) {
            $table->boolean('is_influencer')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace_stores', function (Blueprint $table) {
            $table->dropColumn('is_influencer');
        });
    }
}
