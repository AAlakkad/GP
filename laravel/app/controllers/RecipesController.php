<?php

class RecipesController extends \BaseController
{

    /**
     * Display a listing of recipes
     *
     * @return Response
     */
    public function index()
    {
        $recipes = Recipe::paginate( Config::get( 'app.items_per_page', 10 ) );

        $this->layout->content = View::make( 'recipes.index', compact( 'recipes' ) );
    }

    /**
     * Show the form for creating a new recipe
     *
     * @return Response
     */
    public function create()
    {
        $ingredients = Ingredient::getList();

        $this->layout->content = View::make( 'recipes.form', compact( 'ingredients' ) );
    }

    /**
     * Store a newly created recipe in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make( $data = Input::all(), Recipe::$rules );

        if ($validator->fails()) {
            return Redirect::back()->withErrors( $validator )->withInput();
        }

        $ingredients = [ ];
        foreach (Input::get( 'ingredient' ) as $ingredient) {
            $ingredients [] = Ingredient::find( $ingredient );
        }

        Recipe::create( $data )->ingredients()->saveMany( $ingredients );

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
        $recipe = Recipe::findOrFail( $id );

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
        $recipe      = Recipe::with( 'ingredients' )->find( $id );
        $ingredients = Ingredient::getList();

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
        $recipe = Recipe::findOrFail( $id );

        $validator = Validator::make( $data = Input::all(), Recipe::$rules );

        if ($validator->fails()) {
            return Redirect::back()->withErrors( $validator )->withInput();
        }

        $recipe->update( $data );
        // detach all related ingredients
        $recipe->ingredients()->detach();

        // attach the selected ingredients only
        foreach (Input::get( 'ingredient' ) as $ingredient) {
            if (isset( $ingredient['id'] )) {
                $attributes = [ ];
                if (isset( $ingredient['amount'] )) {
                    $attributes['amount'] = (int) $ingredient['amount'];
                }
                $recipe->ingredients()->attach( $ingredient['id'], $attributes );
            }
        }

        $recipe->save();

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
        Recipe::destroy( $id );

        return Redirect::route( 'recipes.index' );
    }

}
