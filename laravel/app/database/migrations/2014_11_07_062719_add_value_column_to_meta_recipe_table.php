<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddValueColumnToMetaRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('meta_recipe', function(Blueprint $table)
		{
			$table->text('value')->after('recipe_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('meta_recipe', function(Blueprint $table)
		{
			$table->dropColumn('value');
		});
	}

}
