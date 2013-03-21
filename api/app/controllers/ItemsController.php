<?php

class ItemsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Item::all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$request = Input::json();
		if (!$request) {
			return $this->badRequest('Invalid json string');
		}

		// attempt to validate
	    $validation = Item::validate(Input::all());
	    if (!$validation->passes()) {
	    	return $this->badRequest($validation->getMessageBag()->all(':message'));
	    }
	    // Item::create(array(
	    // 	'name' => Input::get('name'),
	    // 	'details' => Input
	    // ));

	    // if ($validation->passes()) {
	    //         Question::create(array(
	    //                 'question' => Input::get('question'),
	    //                 'user_id' => Auth::user()->id
	    //         ));
	    //         return Redirect::route('home')
	    //                 ->with('message', 'Your question has been posted');
	    // }
	    // return Redirect::route('home')
	    //         ->withErrors($validation)
	    //         ->withInput();

		
		// save the data

		// return the resulting record
//		var_dump($request);

		return Response::json();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = Item::find($id);
		if($item) {
			return $item;
		}
		return $this->notFound();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function vendors($id)
	{
		$item = Item::find($id);
		if (!$item)
			return $this->notFound();
		$vendors = $item->vendors();
		if (!$vendors)
			return $this->notFound();
		return $vendors->get();
	}

	public function carts($id)
	{
		$item = Item::find($id);
		if (!$item)
			return $this->notFound();
		$carts = $item->carts();
		if (!$carts)
			return $this->notFound();
		return $carts->get();
	}

}