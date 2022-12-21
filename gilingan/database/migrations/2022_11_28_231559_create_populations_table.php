<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('populations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik', 16)->unique();
            $table->foreignId('kk_id');
            $table->foreignId('dusun_id');
            $table->foreignId('sex_id');
            $table->date('tanggal_lahir');
            $table->foreignId('citizen_id');
            $table->foreignId('blood_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('populations');
    }
};
