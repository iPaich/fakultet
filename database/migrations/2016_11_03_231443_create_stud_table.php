<?php
// php artisan make:migration create_stud_table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stud', function(Blueprint $table)
		{
			//$table->integer('mbrStud', true);
			$table->increments('mbrStud');
			$table->char('imeStud', 25);
			$table->char('prezStud', 25);
			$table->integer('pbrRod')->unsigned()->nullable()->index('pbrRod');
			$table->integer('pbrStan')->unsigned()->index('pbrStan');
			$table->dateTime('datRodStud')->nullable();
			$table->char('jmbgStud', 13)->nullable();
                        //$table->char('slikaStud', 10)->nullable();
                        $table->boolean('slikaStud')->default(false);
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
		Schema::drop('stud');
	}

}
