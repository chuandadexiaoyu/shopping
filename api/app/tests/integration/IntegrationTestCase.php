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

}

