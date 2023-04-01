<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLamaransIdFieldToDaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftars', function (Blueprint $table) {
            //
            Schema::table('daftars',function(Blueprint $table){
                $table->foreignId('lamaran_id')->after('updated_at')->constrained()->onDelete('cascade')->onUpdate('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftars', function (Blueprint $table) {
            //
            Schema::table('daftars', function(Blueprint $table){
                $table->dropForeign('daftars_lamaran_id_foreign');
                $table->dropColumn('lamaran_id');
            });
        });
    }
}
