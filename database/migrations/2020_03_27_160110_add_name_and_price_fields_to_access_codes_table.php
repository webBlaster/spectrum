<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameAndPriceFieldsToAccessCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_codes', function (Blueprint $table) {
            $table->double('price', 15, 2)->after('books_contained');
            $table->uuid('uuid')->after('id');
            $table->string('license_name')->after('uuid');
            $table->string('expires')->after('duration')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_codes', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('uuid');
            $table->dropColumn('license_name');
            $table->dropColumn('expires');
            $table->dropColumn('deleted_at');
        });
    }
}
