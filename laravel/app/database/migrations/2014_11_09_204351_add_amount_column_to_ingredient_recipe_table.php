<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAmountColumnToIngredientRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ingredient_recipe', function(Blueprint $table)
		{
			$table->integer('amount')->after('recipe_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ingredient_recipe', function(Blueprint $table)
		{
			$table->dropColumn('amount');
		});
	}

}
