<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIspitTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ispit', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('mbrStud')->unsigned()->index('mbrStud');
            $table->integer('sifPred')->unsigned()->index('sifPred');
            $table->integer('sifNastavnik')->index('sifNastavnik');
            $table->dateTime('datIspit');
            $table->smallInteger('ocjena')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('ispit');
    }

}
