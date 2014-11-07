<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetaRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meta_recipe', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('meta_id')->unsigned()->index();
			$table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
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
		Schema::drop('meta_recipe');
	}

}
