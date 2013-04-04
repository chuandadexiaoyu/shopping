Testing
=========
There will be a full suite of unit tests for the program. After cloning the repository, you should be able to go into the api folder, run phpunit, and see a passing test. 

Use phpunit.xml for testing; runs all unit tests:
    phpunit             

Use all.xml for testing; this includes integration tests (with pseudo db)
    phpunit -c all.xml  

Run all failing tests in the system. If everything is working correctly, these should all fail.
    phpunit --group failing

Exclude the listed groups from being unit tested. 
    phpunit --exclude-group group1,group2,etc.

    

Testing groups defined
------------------------
These groups have been defined in the app:

Overall groups:
    @group integration  integration components (interactivity of entire project)
    @group failing      failing tests
    @group db           interact with database (slow)

Type groups:
    @group base         Base objects only (eg, BaseController, BaseModel, etc.)
    @group models       
    @group controllers

Object groups:
    @group items

    
    
Incomplete tests
-------------------

Use $this->markTestIncomplete();


Class Map
------------

TestCase --- BaseControllerTest
          |
          |- ItemsControllerTest
          |
          |- ItemTest
          |
          |- IntegrationTestCase --- ItemIntegrationTest



Class Documentation
=====================

TestCase
---------
createApplication()     Creates the application
tearDown()              Cleans up after a test runs
prepareForTests()       TODO: delete! Migrate and seeds the database

getProviderMock($className, $function, $jsonResult)
    Mocks a class, one function it should call, and the result (in json) returned by that function

mock($classname)
    Mocks a class (eg, item, user, vendor, etc.) based on <class>RepositoryInterface

mockDbResult($jsonResult)
    Returns a mock database result (Collection) based on JSON code

getJsonAction($action, $params)
    Run a controller action, assert it succeeds, and return the (json) content converted to an object

getAction($action, $params)
    Get a response from a controller action (eg, 'ItemsController@show')

get($uri, $params)          Get a uri
post($uri, $json, $params)  Post a json string to a uri
put($uri, $params)          Put a json string to a uri
delete($uri, $params)       Delete a uri

assertOK()        Get a response; verify the header returned OK and the content is not empty
assertError($code, $msg)    Get a response, verify header returns (given) code 
                            and content contains error message 

assertRecordFound($itemList, $field, $expectedValue, $errorMessage)
    Make sure a particular record was found in a search

assertRecordNotFound($itemList, $field, $expectedValue, $errorMessage)
    Make sure a particular record was found in a search

substrInArray($array, $expectedValue)
    Returns true if substring found in any item in array



IntegrationTestCase
----------------------
prepareForTests()       
    Migrate and seed the database

getJsonRoute($uri, $params)
    Go to a specified route, assert it succeeds, and return the (json) content converted to an object





