<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersIdFieldToHasilTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hasil_totals', function (Blueprint $table) {
            //
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hasil_totals', function (Blueprint $table) {
            //
            $table->dropForeign('hasil_totals_users_id_foreign');
            $table->dropColumn('users_id');
        });
    }
}
