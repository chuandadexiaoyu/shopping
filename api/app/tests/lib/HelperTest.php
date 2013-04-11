<?php

/**
 * This class tests the helper functions
 * 
 * @group helpers
 */
class HelperTest extends TestCase 
{
    public function testGetDelimitedValidationMessagesRequiresValidator()
    {
        return;     // TODO: Figure out how to call functions
        $validator = Validator::make(array('a'=>'a'), array('a', 'between:4,5'));
        $s = getDelimitedValidationMessages($validator);
    }

}
