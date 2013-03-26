<?php

class ItemsController extends BaseController 
{

	public function __construct(ItemRepositoryInterface $items)
	{
		$this->items = $items;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->items->all();
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
	    $validation = $this->items->validate(Input::all());
	    if (!$validation->passes()) {
	    	return $this->badRequest($validation->getMessageBag()->all(':message'));
	    }
	    // $this->items->create(array(
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
		$item = $this->items->find($id);
		if($item) {
			return $item;
		}
		return $this->notFound("Item " . $id . ' was not found');
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
		$item = $this->items->find($id);
		if (!$item)
			return $this->notFound("Item " . $id . ' was not found');
		$vendors = $item->vendors();
		if (!$vendors)
			return $this->notFound("There were no vendors for item " . $id);
		return $vendors->get();
	}

	public function carts($id)
	{
		$item = $this->items->find($id);
		if (!$item)
			return $this->notFound("Item " . $id . ' was not found');
		$carts = $item->carts();
		if (!$carts)
			return $this->notFound("There were no carts for item " . $id);
		return $carts->get();
	}

}