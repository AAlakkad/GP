<?php

use AAlakkad\RecipesFinder\Repositories\Ingredient\IngredientRepository;
use AAlakkad\RecipesFinder\Repositories\Recipe\RecipeRepository;

class RecipesController extends \BaseController
{
    private $recipe;
    private $ingredient;

    public function __construct( RecipeRepository $recipeRepository, IngredientRepository $ingredientRepository )
    {
        $this->recipe     = $recipeRepository;
        $this->ingredient = $ingredientRepository;
    }

    /**
     * Display a listing of recipes
     *
     * @return Response
     */
    public function index()
    {
        $recipes = $this->recipe->paginate();

        $this->layout->content = View::make( 'recipes.index', compact( 'recipes' ) );
    }

    /**
     * Show the form for creating a new recipe
     *
     * @return Response
     */
    public function create()
    {
        $ingredients = $this->ingredient->getList();

        $this->layout->content = View::make( 'recipes.form', compact( 'ingredients' ) );
    }

    /**
     * Store a newly created recipe in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (!$validator = $this->recipe->validate( Input::all() )) {
            return $this->redirectErrors($validator);
        }

        $ingredients = $this->ingredient->getMultipleById( Input::get( 'ingredient' ) );

        $recipe = $this->recipe->create(Input::all());
        $this->recipe->attachIngredients($recipe, $ingredients);

        //$this->recipe->saveWithIngredients( Input::all(), $ingredients );

        return Redirect::route( 'recipes.index' );
    }

    /**
     * Display the specified recipe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $recipe = $this->recipe->getById( $id );

        $this->layout->content = View::make( 'recipes.show', compact( 'recipe' ) );
    }

    /**
     * Show the form for editing the specified recipe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $recipe      = $this->recipe->getById( $id );
        $ingredients = $this->ingredient->getList();

        $this->layout->content = View::make( 'recipes.form', compact( 'recipe', 'ingredients' ) );
    }

    /**
     * Update the specified recipe in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( $id )
    {
        $recipe = $this->recipe->getById( $id );

        if (!$validator = $this->recipe->validate( Input::all() )) {
            return $this->redirectErrors($validator);
        }

        $recipe->update( Input::all() );
        $this->recipe->attachIngredients( $id, Input::get( 'ingredient' ) );

        return Redirect::route( 'recipes.index' );
    }

    /**
     * Remove the specified recipe from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        $this->recipe->destroy( $id );

        return Redirect::route( 'recipes.index' );
    }

}
