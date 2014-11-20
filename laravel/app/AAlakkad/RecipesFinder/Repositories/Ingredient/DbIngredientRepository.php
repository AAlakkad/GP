<?php namespace AAlakkad\RecipesFinder\Repositories\Ingredient;

use AAlakkad\RecipesFinder\Repositories\BaseRepository;

class DbIngredientRepository extends BaseRepository implements IngredientRepository
{
    protected $model, $rules;

    public function __construct( \Ingredient $model )
    {
        parent::__construct();

        $this->model = $model;
        $this->rules = $model::$rules;
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

    public function getMultipleById( $ids = [ ] )
    {
        $ingredients = [ ];
        foreach ($ids as $ingredient) {
            $ingredients [] = $this->getById( $ingredient );
        }
        return $ingredients;
    }

    /**
     * Create ingredient
     *
     * @return void
     */
    public function create($input)
    {
        return $this->model->create($input);
    }
    
}
