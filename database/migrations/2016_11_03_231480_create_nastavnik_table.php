<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNastavnikTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nastavnik', function(Blueprint $table)
		{
		/**
		 * postavio na autoincrement rucno
		 * ako postavim increments() on to pretvori u INT(11)
		 * a integer() postavi u INT(10) nakon toga ne rade FOREIGN KEY
		 * */
			$table->increments('sifNastavnik')->unsigned();
			//$table->integer('sifNastavnik')->primary();
			$table->char('imeNastavnik', 25);
			$table->char('prezNastavnik', 25);
			$table->integer('pbrStan')->unsigned()->index('pbrStan');
			$table->integer('sifOrgjed')->unsigned()->index('sifOrgjed');
			$table->decimal('koef', 3);
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
		Schema::drop('nastavnik');
	}

}
