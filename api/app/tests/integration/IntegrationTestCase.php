<?php

/**
 * The integration tests rely on sample data being in the database.
 * They run significantly slower than unit tests, but check several
 * components at the same time.
 * 
 * @group integration
 * @group db
 */
class IntegrationTestCase extends TestCase
{

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

    /**
     * Get a route, assert that it succeeds, and return the object with the content
     * (in JSON) converted to an object
     * 
     * @param  $uri       The uri from which to receive data
     *                    (eg, ItemsController@index, etc.)
     * @param  $params    Parameters to be sent to the controller action
     * @return stdClass   The resulting content converted to an object
     */
    protected function getJsonRoute($uri, $params=array())
    {
        $response = $this->get($uri, $params);
        $this->assertOK();
        return json_decode($response->getContent());
    }


}

