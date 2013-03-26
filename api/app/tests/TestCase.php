<?php

use Mockery\Mockery;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    public function tearDown()
    {
        \Mockery::close();
    }

    public function mock($class)
    {
        $repo = $class . 'RepositoryInterface';
        $mock = \Mockery::mock($repo);
        App::instance($repo, $mock);        
        return $mock;
    }

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
    	$unitTesting = true;
        $testEnvironment = 'testing';

    	return require __DIR__.'/../../bootstrap/start.php';
    }

    public function assertOK()
    {
        $response = $this->client->getResponse();
        $this->assertTrue($response->isOk());
        $this->assertNotEmpty($response->getContent());
    }

    public function assertError($errorCode, $errorMessage)
    {
        $response = $this->client->getResponse();
        $this->assertEquals($errorCode, $response->getStatusCode(), 'should return error status code');
        $this->assertNotEmpty($response->getContent(), 'should not have empty content');
        $this->assertNotEquals('[]', $response->getContent(), 'should not have an empty array');
        $json = json_decode($response->getContent());
        $this->assertNotEmpty($json, 'should return a json string');
        $this->assertEquals($errorMessage, 
            $json->errors[0], 
            'should return the phrase "'.$errorMessage.'"');
    }

    public function getJSON($uri)
    {
        $response = $this->get($uri);
        $this->assertOK();
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
