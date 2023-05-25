<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasilTotalsIdFieldToHasilKategorisTable extends Migration
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
            $table->foreignId('hasil_totals_id')->after('id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign('hasil_kategoris_hasil_totals_id_foreign');
            $table->dropColumn('hasil_totals_id');
        });
    }
}
