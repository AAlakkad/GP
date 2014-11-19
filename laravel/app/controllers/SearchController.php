<?php

use AAlakkad\RecipesFinder\Repositories\Recipe\RecipeRepository;

class SearchController extends \BaseController
{

    private $recipe;

    public function __construct( RecipeRepository $recipeRepository )
    {
        $this->recipe = $recipeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /search
     *
     * @return Response
     */
    public function index($id = null)
    {
        $selected = $this->getIngredients($id);
        if(count($selected)) {
            // get search results
            $results = $this->recipe->getByIngredients($selected);
            $suggestions = $this->recipe->getSuggestionsByIngredients($selected);
        }
        // get ingredients which is related to recipes
        $ingredients = Ingredient::has( 'recipes' )->get();
        // load view
        $this->layout->content = View::make( 'search.index', compact( 'ingredients', 'selected', 'results', 'suggestions' ) );
    }

    private function getIngredients($id = null)
    {
        $ingredientsIds = [];
        if($id) {
            $ingredients = explode(',', $id);
            if(is_array($ingredients)) {
                // explicit cast array elements to int, and remove everything else
                foreach ($ingredients as $id) {
                    if($id = (int) $id) {
                        array_push($ingredientsIds, $id);
                    }
                }
            }
        }
        return $ingredientsIds;
    }

    /**
     * Index for searching by ingredients
     *
     * @return void
     */
    public function indexIngredients($id = null)
    {
        $ingredientsIds = [];
        if($id) {
            $ingredients = explode(',', $id);
            if(is_array($ingredients)) {
                // explicit cast array elements to int, and remove everything else
                foreach ($ingredients as $id) {
                    if($id = (int) $id) {
                        array_push($ingredientsIds, $id);
                    }
                }
            }
        }
        $this->layout->content = View::make( 'search.index' );
    }
    

    public function doSearch()
    {
        // get all ingredients from Input
        $ingredientsIds = Input::get( 'ingredients' );

        dd($ingredientsIds);
        $ingredientsIds = is_array( $ingredientsIds ) ? $ingredientsIds : [ (int) $ingredientsIds ];

        // do a query to select based on ingredients
        $recipes = Recipe::join( 'ingredient_recipe', 'recipes.id', '=', 'ingredient_recipe.recipe_id' )
                         ->whereIn( 'ingredient_id', $ingredientsIds )
                         ->get();
        // return result

    }

    /**
     * Show the form for creating a new resource.
     * GET /search/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /search
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /search/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /search/{id}/edit
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /search/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /search/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        //
    }

}
