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

Type groups:
    @group models
    @group controllers

Object groups:
    @group items

    