<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNastavnikTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('nastavnik', function(Blueprint $table) {
            $table->foreign('pbrStan', 'nastavnik_ibfk_1')
                    ->references('pbr')
                    ->on('mjesto')
                    ->onUpdate('RESTRICT')
                    ->onDelete('RESTRICT');
            
            $table->foreign('sifOrgjed', 'nastavnik_ibfk_2')
                    ->references('sifOrgjed')
                    ->on('orgjed')
                    ->onUpdate('RESTRICT')
                    ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('nastavnik', function(Blueprint $table) {
            $table->dropForeign('nastavnik_ibfk_1');
            $table->dropForeign('nastavnik_ibfk_2');
        });
    }

}
