<?php namespace AAlakkad\RecipesFinder;

use Illuminate\Support\ServiceProvider;

class RecipesServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'AAlakkad\RecipesFinder\Repositories\Recipe\RecipeRepository',
            'AAlakkad\RecipesFinder\Repositories\Recipe\DbRecipeRepository'
        );

        $this->app->bind(
            'AAlakkad\RecipesFinder\Repositories\Ingredient\IngredientRepository',
            'AAlakkad\RecipesFinder\Repositories\Ingredient\DbIngredientRepository'
        );
    }

}
