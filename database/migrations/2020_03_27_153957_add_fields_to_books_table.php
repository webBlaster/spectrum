<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('author');
            $table->string('publisher')->nullable()->after('description');
            $table->date('date_published')->nullable()->after('publisher');
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
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('publisher');
            $table->dropColumn('date_published');
            $table->dropColumn('deleted_at');
        });
    }
}
