<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersIdFieldToDaftarsTable extends Migration
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
            $table->foreignId('users_id')->after('lamaran_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign('daftars_users_id_foreign');
            $table->dropColumn('users_id');
        });
    }
}
