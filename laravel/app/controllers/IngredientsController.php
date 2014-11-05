<?php

class IngredientsController extends \BaseController {

	/**
	 * Display a listing of ingredients
	 *
	 * @return Response
	 */
	public function index()
	{
		$ingredients = Ingredient::all();

		return View::make('ingredients.index', compact('ingredients'));
	}

	/**
	 * Show the form for creating a new ingredient
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ingredients.create');
	}

	/**
	 * Store a newly created ingredient in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Ingredient::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Ingredient::create($data);

		return Redirect::route('ingredients.index');
	}

	/**
	 * Display the specified ingredient.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ingredient = Ingredient::findOrFail($id);

		return View::make('ingredients.show', compact('ingredient'));
	}

	/**
	 * Show the form for editing the specified ingredient.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ingredient = Ingredient::find($id);

		return View::make('ingredients.edit', compact('ingredient'));
	}

	/**
	 * Update the specified ingredient in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ingredient = Ingredient::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Ingredient::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ingredient->update($data);

		return Redirect::route('ingredients.index');
	}

	/**
	 * Remove the specified ingredient from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Ingredient::destroy($id);

		return Redirect::route('ingredients.index');
	}

}
