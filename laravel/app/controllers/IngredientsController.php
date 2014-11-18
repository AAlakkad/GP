<?php
use AAlakkad\RecipesFinder\Repositories\Ingredient\IngredientRepository;

class IngredientsController extends \BaseController
{
    private $ingredient;

    public function __construct( IngredientRepository $ingredientRepository )
    {
        $this->ingredient = $ingredientRepository;
    }

    /**
     * Display a listing of ingredients
     *
     * @return Response
     */
    public function index()
    {
        $ingredients = $this->ingredient->paginate();

        $this->layout->content = View::make( 'ingredients.index', compact( 'ingredients' ) );
    }

    /**
     * Show the form for creating a new ingredient
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make( 'ingredients.form' );
    }

    /**
     * Store a newly created ingredient in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (!$validator = $this->ingredient->validate( Input::all() )) {
            return $this->redirectErrors($validator);
        }

        $this->ingredient->create( Input::all() );

        return Redirect::route( 'ingredients.index' );
    }

    /**
     * Display the specified ingredient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( $id )
    {
        $ingredient = $this->ingredient->getById( $id );

        $this->layout->content = View::make( 'ingredients.show', compact( 'ingredient' ) );
    }

    /**
     * Show the form for editing the specified ingredient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $ingredient = $this->ingredient->getById( $id );

        $this->layout->content = View::make( 'ingredients.form', compact( 'ingredient' ) );
    }

    /**
     * Update the specified ingredient in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( $id )
    {
        $ingredient = $this->ingredient->getById( $id );
        
        if (!$validator = $this->ingredient->validate( Input::all() )) {
            return $this->redirectErrors($validator);
        }

        $ingredient->update( Input::all() );

        return Redirect::route( 'ingredients.index' );
    }

    /**
     * Remove the specified ingredient from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        $this->ingredient->destroy( $id );

        return Redirect::route( 'ingredients.index' );
    }

}
