<?php

class BaseController extends Controller
{
	public $name = '';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->data->where('deleted','=','0')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $found = $this->findOrFail($id);
        return $found;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $found = $this->findOrFail($id);
        $found->deleted = True;
        $found->save();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // TODO: store user records
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // TODO: update user records
    }


	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Return an item, or send a 404 error with a message if the item could not be found
	 * 
	 * @param  $id 		ID number of the resource to locate
	 * @return Object 	The resource that was found
	 */
	protected function findOrFail($id)
    {
        $found = $this->data->find($id);

        if (!$found)
            App::abort(404, $this->name.' record '.$id.' was not found');

        if ($found->deleted)
            App::abort(404, $this->name.' record '.$id.' has been deleted');

        return $found;
    }


}