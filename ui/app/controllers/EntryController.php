<?php

class EntryController extends BaseController
{
    public function index()
    {
        $date = $this->getApi('dates/next');
        if($date) {
            $date = date_create($date)->format('l, F j, Y');
        }
        
        return View::make('user/entry')
            ->with('date', $date);
    }
}
