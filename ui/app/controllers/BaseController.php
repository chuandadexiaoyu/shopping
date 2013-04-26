<?php

class BaseController extends Controller 
{

    protected function getApi($page)
    {
        $url = Config::get('app.api_url');
        $request = Requests::get($url.'/'.$page);
        if($request->headers['content-type']=='application/json') {
            return json_decode($request->body);
        }
        return $request->body;
    }

    protected function deleteApi($page, $id)
    {
        // arrays for headers, data, options
        $url = Config::get('app.api_url');
        $request = Requests::request($url.'/'.$page.'/'.$id, array(), array(), 'DELETE', array());
    }

}