<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIngredientRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingredient_recipe', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ingredient_id')->unsigned()->index();
			$table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
			$table->integer('recipe_id')->unsigned()->index();
			$table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
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
		Schema::drop('ingredient_recipe');
	}

}
