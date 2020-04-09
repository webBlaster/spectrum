<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidFromAndValidTillFieldToDeveloperApiKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_api_keys', function (Blueprint $table) {
            $table->date('valid_from')->nullable()->after('duration');
            $table->date('valid_till')->nullable()->after('valid_from');
            $table->string('created_by')->nullable()->after('valid_till');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer_api_keys', function (Blueprint $table) {
            $table->dropColumn('valid_from');
            $table->dropColumn('valid_till');
            $table->dropColumn('created_by');
        });
    }
}
