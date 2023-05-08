<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDaftarsIdFieldToWawancarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wawancaras', function (Blueprint $table) {
            //
            $table->foreignId('daftar_id')->after('id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('wawancara_id')->after('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wawancaras', function (Blueprint $table) {
            //
            $table->dropForeign('wawancaras_daftars_id_foreign');
            $table->dropColumn('daftars_id');
        });
    }
}
