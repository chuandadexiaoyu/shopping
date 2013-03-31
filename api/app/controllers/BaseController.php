<?php

class BaseController extends Controller 
{
    /**
     * Returns a Not Found error (via json)
     * 
     * Return codes are available at:
     * <project>\api\vendor\symfony\http-foundation
     *     \Symfony\Component\HttpFoundation\Response.php
     */
    protected static function notFound($errorValue=Null)
    {
        if(!$errorValue)
            return Response::json()->setStatusCode(404);

        $json = array('errors' => array($errorValue));
        return Response::json($json)->setStatusCode(404);
    }

    protected static function badRequest($errorValue)
    {
        $json = array('errors' => array($errorValue));
        return Response::json($json)->setStatusCode(400);
    } 
 
    protected static function OK($message)
    {
        $json = array($message);
        return Response::json($json)->setStatusCode(200);
    } 
 
}
