<?php namespace AAlakkad\RecipesFinder\Repositories\Recipe;

use AAlakkad\RecipesFinder\Repositories\BaseRepository;

class DbRecipeRepository extends BaseRepository implements RecipeRepository
{

    protected $model, $rules;

    public function __construct( \Recipe $model )
    {
        parent::__construct();
        $this->rules = $model::$rules;
        $this->model = $model;
    }

    public function getById( $id )
    {
        return $this->model->with( 'ingredients' )->findOrFail( $id );
    }


    public function validate( $data )
    {
        $validator = \Validator::make( $data, $this->rules );
        if ($validator->fails()) {
            return false;
        }
        return $validator;
    }

    public function getList()
    {
        return $this->model->lists( 'name', 'id' );
    }

    function saveWithIngredients( $data, $ingredients = [ ] )
    {
        return $this->model->create( $data )->ingredients()->saveMany( $ingredients );
    }

    function attachIngredients( $id, $ingredients = [ ] )
    {
        $recipe = $this->getById( $id );

        // detach all related ingredients
        $recipe->ingredients()->detach();

        // attach the selected ingredients only
        foreach ($ingredients as $ingredient) {
            if (isset( $ingredient['id'] )) {
                $attributes = [ ];
                if (isset( $ingredient['amount'] )) {
                    $attributes['amount'] = (int) $ingredient['amount'];
                }
                $recipe->ingredients()->attach( $ingredient['id'], $attributes );
            }
        }

        return $recipe->save();
    }

    function getRecipesByIngredients( $ingredients = [ ] )
    {

    }
}
