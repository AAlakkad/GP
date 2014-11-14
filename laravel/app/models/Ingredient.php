<?php

class Ingredient extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'name' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'unit', 'description'];

    public function recipes()
    {
        return $this->belongsToMany('Recipe')->withTimestamps()->withPivot('amount');
    }

    static public function getList()
    {
        return static::lists('name', 'id');
    }

}
