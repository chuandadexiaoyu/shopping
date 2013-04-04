<?php

/**
 * This class tests the BaseModel (in order to test, a stub has been included)
 * 
 * @group models
 * @group base
 */
class BaseModelTest extends TestCase 
{
    public function tearDown()
    {
        \Mockery::close();
    }


// Search for BaseModel -----------------------------------------------------------------

    /**
     * @group db
     */
    public function testSearchForBaseModelById()
    {
        $this->prepareForTests();
        $model = new BaseModelStub;
        $this->assertEquals('Windex', $model->search(1)->name, 'should find the first item');
        $this->assertEquals('Windex', $model->search('1')->name, 'should find the first item');
        $this->assertEquals('2', $model->search('name=Pencils')->id, 'should find name "Pencils"');
    }

    /**
     * @group db
     */
    public function testSearchForBaseModelByParameterArray()
    {
        $this->prepareForTests();
        $model = new BaseModelStub;
        $params = array('name' => 'c');
        $models = $model->search($params);
        $this->assertRecordFound($models, 'name', 'pencils', 'should find Pencils from search array');
    }

    /**
     * @group db
     */
   public function testSearchForBaseModelByText()
    {
        $this->prepareForTests();
        $model = new BaseModelStub;

        // Search for a letter
        $model1 = $model->search('name=c');
        $this->assertGreaterThan(4, count($model1), 'should have more than 4 with "c"');
        $this->assertRecordFound($model1, 'name', 'Pencils', 
            'should have found Pencils when searching for "c"');
        $this->assertRecordFound($model1, 'name', 'chair', 
            'should have found chair when searching for "c"');

        // Search in more than one field
        $model2 = $model->search('sku=s&name=c');
        $this->assertLessThan(count($model1), count($model2), 
            'should have fewer results for both sku and name than with just name');
        $this->assertRecordFound($model2, 'name', 'Pencils', 
            'should have found Pencils when searching for "c"');
        $this->assertRecordNotFound($model2, 'name', 'chair', 
            'should have found chair when searching for "c"');
    }


    /**
     * @group db
     */
    public function testSearchForBaseModelWithKeywords()
    {
        // TODO: extract key words from the search string,
        // eg count=x&offset=y; these should be OK
        $this->prepareForTests();
        $model = new BaseModelStub;
        $result = $model->search('count=4&offset=4');
        $this->assertEquals(0, count($result));
    }


    /**
     * @group db
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
   public function testSearchFailsIfPassedInvalidParams()
    {
        $this->prepareForTests();
        $model = new BaseModelStub;
        $result = $model->search('invalidSearchParameter');
        $this->assertEquals(0, count($result));
    }

    /**
     * @group db
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testSearchFailsIfPassedInvalidFieldNames()
    {
        // TODO: extract key words from the search string,
        // eg count=x&offset=y; these should be OK
        // foo=bar should throw an exception.
        $this->prepareForTests();
        $model = new BaseModelStub;
        $result = $model->search('foo=bar');
        $this->assertEquals(0, count($result));
    }





// Validation ----------------------------------------------------------------

    public function testValidateSucceedsForValidName()
    {
        $model = new BaseModelStub;

        // Send (valid) name field
        $data = array('name'=>'joel');
        $validator = $model->validate($data);
        $this->assertTrue($validator->passes(), 'should succeed for valid name');
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(0, count($errors), 'should not have any errors');
    }

    /**
     * Make sure the validation succeeds if passed a standard Input object
     */
    public function testValidateSucceedsIfPassedValidObjectData()
    {
        $model = new BaseModelStub;
        $data = new \Symfony\Component\HttpFoundation\ParameterBag(array('name'=>'joel'));
        $validator = $model->validate($data, 'new');
        $this->assertTrue($validator->passes());
    }

    public function testValidateFailsIfPassedInvalidObjectData()
    {
        $model = new BaseModelStub;
        $data = new \Symfony\Component\HttpFoundation\ParameterBag(array('name'=>'j'));
        $validator = $model->validate($data, 'new');
        $this->assertFalse($validator->passes());
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(1, count($errors), 'should fail 1 test');
        $this->assertTrue($this->substrInArray($errors, 'characters'), 
            'should return character limit message');
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testValidateThrowsErrorIfInvalidRuleSelected()
    {
        $model = new BaseModelStub;
        $validator = $model->validate(array(), 'invalidRule');
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testValidateThrowsErrorIfNotGivenArrayOrArrayableObject()
    {
        $model = new BaseModelStub;
        $validator = $model->validate('foo');
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testValidateThrowsErrorForUnknownField()
    {
        $model = new BaseModelStub;
        $validator = $model->validate(array('foo' => 'bar'));        
    }

    public function testValidateFailsForInvalidDetails()
    {
        $model = new BaseModelStub;

        // Do not send Name field, just (too short) details
        $data = array('details' => 'a');
        $validator = $model->validate($data, 'new');
        $this->assertTrue($validator->fails(), 'should fail for missing item');
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(2, count($errors), 'should fail 2 tests');
        $this->assertTrue($this->substrInArray($errors, 'required'), 
            'should return field required message');
        $this->assertTrue($this->substrInArray($errors, 'between'), 
            'should return character limit message');
    }

    public function testValidateFailsForInvalidSKU()
    {
        $model = new BaseModelStub;

        // Send (valid) name field, and (too short) sku
        $data = array('name'=>'joel', 'sku'=>'a');
        $validator = $model->validate($data, 'new');
        $this->assertTrue($validator->fails(), 'should fail for short sku');
        $errors = $validator->errors()->all(':message');
        $this->assertEquals(1, count($errors), 'should fail 1 test');
        $this->assertTrue($this->substrInArray($errors, 'between'), 
            'should return character limit message');
    }


}

