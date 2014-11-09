<?php

class Ingredient extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'description'];

    public function recipes()
    {
        return $this->belongsToMany('Recipe');
    }

    static public function getList()
    {
        return static::lists('name', 'id');
    }

}