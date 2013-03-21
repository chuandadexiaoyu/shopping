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
    protected static function notFound()
    {
        return Response::json()->setStatusCode(404);
    }

    protected static function badRequest($errorValue)
    {
        // if(!$errorString)
        //     return Response::json()->setStatusCode(400);
        // else
//            return Response::json($errorString)->setStatusCode(400);
        return Response::json($errorValue)->setStatusCode(400);
    }    
 
}