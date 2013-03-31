<?php

use Mockery\Mockery;

define('JSON_WORKS',        '{"name":"works"}');
define('JSON_ITEM_WORKS',   '{"name":"item works"}');
define('JSON_VENDOR_WORKS', '{"name":"vendor works"}');
define('JSON_CART_WORKS',   '{"name":"cart works"}');

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**************************************************************************
     * Standard setup and tear-down functions
     */

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

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * Migrates and seeds the database so that tests can be run on fresh data
     * (only needed for tests that call the database; this is MUCH, MUCH slower
     * than using mocks) 
     */
    protected function prepareForTests()
    {
        Artisan::call('migrate');
        $this->seed();
    }





    /*********************************************************************************
     * Mocks used to simulate data sent from other objects 
     */

    /**
     * Mock a shopping class, one function it should call, and
     * a database result (from a mock database)
     * 
     * @param  string $className    Mocked class (eg, item, user, vendor, etc.)
     * @param  string $function     Name of the function the tested object will call
     * @param  string $jsonResult   Result (in JSON) that would be returned from a database
     * @return Mock                 
     */
    protected function getProviderMock($className, $function, $jsonResult=Null)
    {
        $dbResult = $this->mockDBResult($jsonResult);
        $mock = $this->mock($className)->shouldReceive($function)->once()->andReturn($dbResult);
        return $mock;
    }

    /**
     * Mocks a shopping class based on the class name
     * 
     * @param  string $className    Mocked class (eg, item, user, vendor, etc.)
     * @return Mock
     */
    protected function mock($className)
    {
        $repo = $className . 'RepositoryInterface';
        $mock = \Mockery::mock($repo);
        App::instance($repo, $mock);        
            return $mock;
    }

    /**
     * Returns a mock database result based on JSON code.
     * This class expects to receive a call to count,
     * and will accept a call to toJson (which will return the JSON code)
     * 
     * @param  string $jsonResult   result to return if toJson() is called
     * @return Collection           Eloquent collection object
     */
    protected function mockDBResult($jsonResult)
    {
        $result = \Mockery::mock('Illuminate\Database\Eloquent\Collection');

        if(!$jsonResult) {
            $result->shouldReceive('count')->once()->andReturn(0);
            return $result;
        }
        $resultCount = count(json_decode($jsonResult));
        $result->shouldReceive('count')->andReturn($resultCount);
        $result->shouldReceive('toJson')->andReturn($jsonResult);
        return $result;
    }



    /*********************************************************************************
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
     * Get a URI, assert that it succeeds, then return an object with
     * the content (in JSON) converted to an object
     *  
     * @param  $uri       The URI from which to receive data
     * @return stdClass   The resulting content converted to an object
     */
    protected function getJSON($uri)
    {
        $response = $this->get($uri);
        $this->assertOK();
        return json_decode($response->getContent());
    }

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



    /*********************************************************************************
     * Assertions used to make sure the response is as expected 
     */

    /**
     * Gets a response, makes sure the header returned OK (200),
     * and the content is not empty
     */
    protected function assertOK()
    {
        $response = $this->client->getResponse();
        $this->assertTrue($response->isOk());
        $this->assertNotEmpty($response->getContent());
    }

    /**
     * Gets a response, makes sure the header returned a (given) error code,
     * and the content contains a (given) error message
     *
     * @param  integer $errorCode    error code that should be received
     * @param  string $errorMessage  error message that should be received (as JSON)
     */
    protected function assertError($errorCode, $errorMessage)
    {
        $response = $this->client->getResponse();
        $content = $response->getContent();
        $this->assertEquals($errorCode, $response->getStatusCode(), 'should return error status code');
        $this->assertNotEmpty($content, 'should not have empty content');
        $this->assertNotEquals('[]', $content, 'should not have an empty array');
        $json = json_decode($content);
        $this->assertNotEmpty($json, 'should return a json string');

        $this->assertEquals($errorMessage, 
            $json->errors[0], 
            'should return the phrase "'.$errorMessage.'"');
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
        if (!$this->substringFound($itemList, $field, $expectedValue)) 
            $this->assertTrue(False, $errorMessage);
    }

    protected function assertRecordNotFound($itemList, $field, $expectedValue, $errorMessage) 
    {
        if ($this->substringFound($itemList, $field, $expectedValue)) 
            $this->assertTrue(False, $errorMessage);
    }






    /**********************************************************************************
     * Helper functions
     */

    /**
     * Locates a substring in an array
     * 
     * @param  array $arr               The array in which to search
     * @param  string $expectedValue    The substring to look for
     * @return boolean                  True if the substring was found in the array
     */
    protected function substrInArray($arr, $expectedValue)
    {
        foreach($arr as $item)
            if (stripos($item, $expectedValue) !== False)
                return True;
        return False;
    }

    /**
     * Determines whether a given substring was found in a string, object, or array
     * (this is a case insensitive search)
     * 
     * @param  mixed  $haystack     Item (or list of items) to search in 
     * @param  string $field        Name of the field to search for values
     * @param  string $needle       value to search for
     * @return boolean
     */
    private function substringFound($haystack, $field, $needle)
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

    // public function testTesterWorks()
    // {
    //     $this->assertTrue(True);
    //     $mock = \Mockery::mock('something');
    //     $mock->shouldReceive('test')->once()->andReturn('works');
    //     $this->assertEquals('works', $mock->test());
    // }

    // /**
    //  * @group failing 
    //  */
    // public function testTesterWorksForFailingTests()
    // {
    //     $this->assertFalse(True);
    // }

}



