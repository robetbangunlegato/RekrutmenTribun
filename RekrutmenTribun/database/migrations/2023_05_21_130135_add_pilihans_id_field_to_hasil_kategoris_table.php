<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPilihansIdFieldToHasilKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_kategoris', function (Blueprint $table) {
            //
            $table->foreignId('pilihans_id')->after('soals_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_kategoris', function (Blueprint $table) {
            //
            $table->dropForeign('hasil_kategoris_pilihans_id_foreign');
            $table->dropColumn('pilihans_id');

        });
    }
}
