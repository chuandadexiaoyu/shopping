<?php

class BaseModelStub extends BaseModel
{
    protected $table = 'items';

    public $validationRules = array(
        // This is a custom array
        'foo' => array(
            'foo'   => 'between:0,10',
        ),

        // This is wrong because fields should have associated values
        'wrong' => array(
            'foo',
        ),

        // Field names
        'fields' => array(
            'id'        => '',
            'name'      => '',
            'details'   => '',
            'sku'       => '',    
        ),

        // Validation rules to View/Use/Read/Lookup records
        'view' => array(
            'id'        => 'integer|min:0',
            'name'      => 'between:1,40',
            'details'   => 'between:1,250',
            'sku'       => 'between:1,20'
        ),

        // Validation rules required to add a record
        'new' => array(
            'name'      => 'required|min:2|max:40',
            'details'   => 'between:4,250',
            'sku'       => 'between:4,20'
        ),

        // Validation rules to edit records
        'edit' => array(
            'name'      => 'min:2|max:40',
            'details'   => 'between:4,250',
            'sku'       => 'between:4,20'
        ),
    );

}
