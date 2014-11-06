<?php

class MetasController extends \BaseController {

	/**
	 * Display a listing of metas
	 *
	 * @return Response
	 */
	public function index()
	{
		$metas = Meta::all();

		return View::make('metas.index', compact('metas'));
	}

	/**
	 * Show the form for creating a new meta
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('metas.create');
	}

	/**
	 * Store a newly created meta in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Meta::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Meta::create($data);

		return Redirect::route('metas.index');
	}

	/**
	 * Display the specified meta.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$meta = Meta::findOrFail($id);

		return View::make('metas.show', compact('meta'));
	}

	/**
	 * Show the form for editing the specified meta.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$meta = Meta::find($id);

		return View::make('metas.edit', compact('meta'));
	}

	/**
	 * Update the specified meta in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$meta = Meta::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Meta::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$meta->update($data);

		return Redirect::route('metas.index');
	}

	/**
	 * Remove the specified meta from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Meta::destroy($id);

		return Redirect::route('metas.index');
	}

}
