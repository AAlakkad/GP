<?php

class Recipe extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
        'name' => 'required',
        'description' => 'required',
		'steps' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'description', 'steps'];

    public function ingredients()
    {
        return $this->belongsToMany('Ingredient')
    }
}