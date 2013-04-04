<?php

class ItemsController extends BaseController 
{
    protected $items;
//    protected $input;         Can we include this in the constructor?

    public function __construct(ItemRepositoryInterface $items)
    {
        $this->items = $items;
        // $this->input = $input;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->show(Input::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $params
     * @return Response
     */
    public function show($params)
    {
        $item = $this->items->search($params);

        if (!$item)
            // App::abort(404, 'Item ' . $params . ' was not found');
            return $this->notFound("Item " . $params . ' was not found');

        // if(is_string($item))
        //     return($item);

        if(is_object($item) && count($item)>0)
            return $item->toJson();

        return $this->notFound('no items found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = Input::json();
        if (count($request)==0) {
            return $this->badRequest('Invalid json string');
        }

        // attempt to validate
        var_dump(Input::json());
        $validator = $this->items->validate(Input::json());
        if (!$validator->passes()) {
            var_dump($validator->messages()->all(':message'));
            // return $this->badRequest($validation->getMessageBag()->all(':message'));
        } else {
            var_dump($request);
        }
        // $this->items->create(array(
        //  'name' => Input::get('name'),
        //  'details' => Input
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
//      var_dump($request);

        return Response::json();
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
        if ($this->items->delete($id))
        	return ;
    }

    public function vendors($id)
    {
        $item = $this->items->search($id);
        if (!$item)
            return $this->notFound("Item " . $id . ' was not found');
        $vendors = $item->vendors();
        if (!$vendors)
            return $this->notFound("There were no vendors for item " . $id);
        return $vendors->get();
    }

    public function carts($id)
    {
        $item = $this->items->search($id);
        if (!$item)
            return $this->notFound("Item " . $id . ' was not found');
        $carts = $item->carts();
        if (!$carts)
            return $this->notFound("There were no carts for item " . $id);
        return $carts->get();
    }

}