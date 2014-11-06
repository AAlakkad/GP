<?php

class Meta extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
        'key' => 'required',
        'type' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['key', 'type', 'values'];

    public function recipes()
    {
        return $this->belongsToMany('Recipe');
    }

}