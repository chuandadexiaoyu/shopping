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
            App::abort(404, 'Item ' . $params . ' was not found');

        if(is_object($item) && count($item)>0 && method_exists($item, 'toJson'))
            return $item->toJson();

        App::abort(404, 'no items found');
    }

    /**
     * Store a newly created resource to the database.
     * @return Response
     */
    public function store()
    {
        $request = Input::json();
        if (count($request)==0) {
            App::abort(400, 'Invalid json string');
        }

        // attempt to validate
        $validator = $this->items->validate($request, 'new');
        if (!$validator->passes()) {
            App::abort(400, $validator->errors()->toJson());
        }

        $item = $this->items->create($request);
        //  Item::create( array(
        //     'name'    => Input::get('name'),
        //     'details' => Input::get('details'),
        //     'sku'     => Input::get('sku'),
        // ));

        if(!$item)
            App::abort(500, 'Unable to create item');

        var_dump($item);
        return $item;

        // Item::create()
        echo 'validated';
        return;
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
        $this->items->destroy($id);
        return $this->OK('item '.$id.' deleted');
    }

    public function vendors($id)
    {
        $item = $this->items->search($id);
        if (!$item)
            App::abort(404, 'Item '.$id.' was not found');
            // return $this->notFound("Item " . $id . ' was not found');
        $vendors = $item->vendors();
        if (!$vendors)
            App::abort(404, "There were no vendors for item " . $id);
        return $vendors->get();
    }

    public function carts($id)
    {
        $item = $this->items->search($id);
        if (!$item)
            App::abort(404, "Item " . $id . ' was not found');
        $carts = $item->carts();
        if (!$carts)
            App::abort(404, "There were no carts for item " . $id);
        return $carts->get();
    }


}