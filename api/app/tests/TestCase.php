<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $this->runFailingTests = False;

    	$unitTesting = true;

        $testEnvironment = 'testing';

    	return require __DIR__.'/../../bootstrap/start.php';
    }

    public function assertOK($response)
    {
        $this->assertTrue($response->isOk());
        $this->assertFalse($response->isEmpty());
    }

    public function getJSON($uri)
    {
        $response = $this->get($uri);
        $this->assertOK($response);
        return json_decode($response->getContent());
    }


    /*******************************************************************
     * Wrap the standard call methods for simpler syntax
     * 
     * The call method takes these parameters:
     *  string  $method        The HTTP method (GET, POST, PUT, DELETE, etc.)
     *  string  $uri           The URI
     *  array   $parameters    The query (GET) or request (POST) parameters
     *  array   $files         The request files ($_FILES)
     *  array   $server        The server parameters ($_SERVER)
     *  string  $content       The raw body data
     *  bool    $changeHistory 
     */

    /**
     * Get a URI
     * @param  $URI        The URI from which to receive data
     * @param  $parameters The query (GET) parameters
     * @return Illuminate\Http\Response
     */
    public function get($URI, $parameters=array())
    {
        return $this->call('GET', $URI, $parameters);
    }

    /**
     * Post a json string to a URI
     * @param  $URI    The URI to receive the submitted data
     * @param  $json   Raw data to be submitted (this should be json data)
     * @return Illuminate\Http\Response
     */
    public function post($URI, $json, $parameters=array())
    {
        return $this->call('POST', $URI, $parameters, array(), array(), $json);
    }

    /**
     * Put a json string to a URI
     * @param  $URI    The URI to receive the submitted data
     * @return Illuminate\Http\Response
     */
    public function put($URI, $parameters=array())
    {
        return $this->call('PUT', $URI, $parameters);
    }

    /**
     * Delete a URI
     * @param  $URI    The URI to receive the submitted data
     * @return Illuminate\Http\Response
     */
    public function delete($URI, $parameters=array())
    {
        return $this->call('DELETE', $URI, $parameters);
    }


    // public function loadDatabase()
    // {
    //     Artisan::call('migrate');
    //     $this->seed();        
    // }

}
