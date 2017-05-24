<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIspitTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('ispit', function(Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
// add column
            //Schema::enableForeignKeyConstraints();

            Schema::disableForeignKeyConstraints();

            $table->foreign('mbrStud', 'ispit_ibfk_1')
                    ->references('mbrStud')
                    ->on('stud')
                    ->onUpdate('RESTRICT')
                    ->onDelete('RESTRICT');
            
            $table->foreign('sifPred', 'ispit_ibfk_2')
                    ->references('sifPred')
                    ->on('pred')
                    ->onUpdate('RESTRICT')
                    ->onDelete('RESTRICT');
            
            $table->foreign('sifNastavnik', 'ispit_ibfk_3')
                    ->references('sifNastavnik')
                    ->on('nastavnik')
                    ->onUpdate('RESTRICT')
                    ->onDelete('RESTRICT');

            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('ispit', function(Blueprint $table) {
            $table->dropForeign('ispit_ibfk_1');
            $table->dropForeign('ispit_ibfk_2');
            $table->dropForeign('ispit_ibfk_3');
        });
    }

}
