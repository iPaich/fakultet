<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class AddForeignKeysToOrgjedTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orgjed', function(Blueprint $table)
		{
			$table->foreign('sifNadorgjed', 'orgjed_ibfk_1')->references('sifOrgjed')->on('orgjed')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orgjed', function(Blueprint $table)
		{
			$table->dropForeign('orgjed_ibfk_1');
		});
	}
}