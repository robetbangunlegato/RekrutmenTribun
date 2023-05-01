<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ktp');
            $table->string('npwp');
            $table->string('cv');
            $table->string('surat_lamaran');
            $table->string('data_pendukung')->default('-');
            $table->string('status_administrasi')->default('-');
            $table->string('status_wawancara')->default('-');
            $table->string('status_psikotes')->default('-');
            $table->string('waktu_kirim');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftars');
    }
}
