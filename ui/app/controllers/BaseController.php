<?php

class BaseController extends Controller 
{

    protected function getApi($page)
    {
        $request = Requests::get('http://api.shop/'.$page);
        if($request->headers['content-type']=='application/json') {
            return json_decode($request->body);
        }
        return $request->body;
    }


}