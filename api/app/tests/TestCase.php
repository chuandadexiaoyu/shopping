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
        if(in_array('foo', $_SERVER['argv'])) {
            $testEnvironment = 'foo';
        }
    	return require __DIR__.'/../../bootstrap/start.php';
    }

    protected function assertOK()
    {
        $response = $this->client->getResponse();
        $this->assertTrue($response->isOk());
        $this->assertNotEmpty($response->getContent());
    }

    protected function assertError($errorCode, $errorMessage)
    {
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $this->assertEquals($errorCode, $response->getStatusCode(), 'should return error status code');
        $this->assertNotEmpty($content, 'should not have empty content');
        $this->assertNotEquals('[]', $content, 'should not have an empty array');
        $json = json_decode($content);
        $this->assertNotEmpty($json, 'should return a json string');

        // var_dump($content);
        // var_dump($json); //->errors()->all(':message'));
        $this->assertEquals($errorMessage, 
            $json->errors[0], 
            'should return the phrase "'.$errorMessage.'"');
    }

    protected function getJSON($uri)
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
    protected function get($URI, $parameters=array())
    {
        return $this->call('GET', $URI, $parameters);
    }

    /**
     * Post a json string to a URI
     * @param  $URI    The URI to receive the submitted data
     * @param  $json   Raw data to be submitted (this should be json data)
     * @return Illuminate\Http\Response
     */
    protected function post($URI, $json, $parameters=array())
    {
        return $this->call('POST', $URI, $parameters, array(), array(), $json);
    }

    /**
     * Put a json string to a URI
     * @param  $URI    The URI to receive the submitted data
     * @return Illuminate\Http\Response
     */
    protected function put($URI, $parameters=array())
    {
        return $this->call('PUT', $URI, $parameters);
    }

    /**
     * Delete a URI
     * @param  $URI    The URI to receive the submitted data
     * @return Illuminate\Http\Response
     */
    protected function delete($URI, $parameters=array())
    {
        return $this->call('DELETE', $URI, $parameters);
    }

    protected function prepareForTests()
    {
        Artisan::call('migrate');
        $this->seed();
    }

    /**
     * Make sure that a particular record was found in a search
     * @param  $itemList        List of records (found with 'where' clause)
     * @param  $field           Name of the field to check
     * @param  $expectedValue   Value that should be found in a record in the results
     * @param  $errorMessage    Message to return if there was no match
     * @return                
     */
    protected function assertRecordFound($itemList, $field, $expectedValue, $errorMessage) 
    {
        if (!$this->recordFound($itemList, $field, $expectedValue)) 
            $this->assertTrue(False, $errorMessage);
    }

    protected function assertRecordNotFound($itemList, $field, $expectedValue, $errorMessage) 
    {
        if ($this->recordFound($itemList, $field, $expectedValue)) 
            $this->assertTrue(False, $errorMessage);
    }


    protected function stringInArray($arr, $expectedValue)
    {
        foreach($arr as $item)
            if (stripos($item, $expectedValue) !== False)
                return True;
        return False;
    }




    //**********************************************************************************
    // Private helper functions
    

    /**
     * Determines whether a given substring was found in a string, object, or array
     * (this is a case insensitive search)
     * 
     * @param  mixed  $haystack     Item (or list of items) to search in 
     * @param  string $field        Name of the field to search for values
     * @param  string $needle       value to search for
     * @return boolean
     */
    private function recordFound($haystack, $field, $needle)
    {
        // if we were given a stdClass object, check to see if the value is in it
        if(is_object($haystack) and get_class($haystack) === 'stdClass')
            return (stripos($haystack->$field, $needle) !== False);

        // If we were given an array or collection object, look through
        // each item to find the value
        foreach ($haystack as $item)
            if (stripos($item->$field, $needle) !== False )
                return True;
        return False;
    }

}



