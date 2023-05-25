<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoalsIdFieldToPilihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilihans', function (Blueprint $table) {
            //
            $table->foreignId('soals_id')->after('id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pilihans', function (Blueprint $table) {
            //
            $table->dropForeign('pilihans_soals_id_foreign');
            $table->dropColumn('soals_id');
        });
    }
}
