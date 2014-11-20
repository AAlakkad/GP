<?php namespace AAlakkad\RecipesFinder\Repositories\Recipe;

use AAlakkad\RecipesFinder\Repositories\BaseRepository;
use \DB;

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
        $recipe = is_numeric($id) ? $this->getById( $id ) : $id;

        // detach all related ingredients
        $recipe->ingredients()->detach();

        // attach the selected ingredients only
        foreach ($ingredients as $ingredient) {
            $attributes = [ ];
            $ingredient_id = null;
            if (isset( $ingredient['id'] )) {
                $ingredient_id = $ingredient['id'];
                if (isset( $ingredient['amount'] )) {
                    $attributes['amount'] = (int) $ingredient['amount'];
                }
            }
            elseif(isset($ingredient->id)) {
                $ingredient_id = $ingredient->id;
                if (isset( $ingredient['amount'] )) {
                    $attributes['amount'] = (int) $ingredient['amount'];
                }
            }

            if($ingredient_id) {
                $recipe->ingredients()->attach( $ingredient['id'], $attributes );
            }
        }

        return $recipe->save();
    }

    public function getByIngredients( $ingredients = [ ] )
    {
        $recipesIds = DB::table('ingredient_recipe')->whereIn('ingredient_id', $ingredients)->groupBy('recipe_id')->get();

        $recipes = $this->model->whereHas('ingredients', function($q) use ($ingredients) {
            // $q->whereIn('ingredient_id', $ingredients);
            $q->where(DB::raw('1'), '=', DB::raw('1'));
            foreach($ingredients as $ingredient) {
                $q->Orwhere('ingredient_id', '=', $ingredient);
            }
        })->groupBy('id')->get();
        return $recipes;
    }

    function getSuggestionsByIngredients( $ingredients = [ ] )
    {
        $recipes = $this->model->whereHas('ingredients', function($q) use ($ingredients) {
            $q->whereIn('ingredient_id', $ingredients);
        })->groupBy('id')->get();
        return $recipes;
    }

    /**
     * Create new recipe
     *
     * @return object
     */
    public function create($input)
    {
        return $this->model->create($input);
    }
    
}
