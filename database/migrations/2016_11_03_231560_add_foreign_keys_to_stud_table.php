<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stud', function(Blueprint $table)
		{
			$table->foreign('pbrRod', 'stud_ibfk_1')
                                ->references('pbr')
                                ->on('mjesto')
                                ->onUpdate('RESTRICT')
                                ->onDelete('RESTRICT');
                        
			$table->foreign('pbrStan', 'stud_ibfk_2')
                                ->references('pbr')
                                ->on('mjesto')
                                ->onUpdate('RESTRICT')
                                ->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stud', function(Blueprint $table)
		{
			$table->dropForeign('stud_ibfk_1');
			$table->dropForeign('stud_ibfk_2');
		});
	}

}
