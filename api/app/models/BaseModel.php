<?php

class BaseModel extends Eloquent
{
    
    public $reservedWords = array(
        'count',
        'offset'
    );

    public $validationRules = array();


    /**
     * Validate data according to the validation rules
     * 
     * @param  array $data      array of field/value pairs to validate
     * @param  string $context  context of the request (view, add, edit, etc.)
     * @return [type]           [description]
     */
    public function validate($data, $context='view')
    {
        $params = $this->getInputParameters($data);
        if (!isset($this->validationRules[$context])) {
            App::abort(500, 'invalid validation rule "'.$context.'"');
        }

        $this->verifyAllFieldsHaveValues($params);
        $this->verifyAllFieldNamesAreKnown($params);

        return Validator::make($params, $this->validationRules[$context]);
    }

    public function search($findWhat)
    {
        // If we were passed an integer, find the primary key
        if(is_numeric($findWhat)) {
            return parent::find($findWhat);            
        } 

        $context = 'view';
        $params  = $this->getInputParameters($findWhat);

        // Validate the input
        $validator = $this->validate($params, $context);
        if (!$validator->passes()) {
            App::abort(400, $validator->errors()->all(':message'));      
        }

        // search for submitted parameters
        // TODO: Figure out how to use other parameters: =, >=, <=, >, < 
        $table = $this->getTable();
        $foundItems = $this->from($table);
        foreach($params as $key => $value) {
            $foundItems->where($key, 'like', '%'.$value.'%', 'and');
        }
        if (count($foundItems->get())==1) {
            return $foundItems->first();
        }
        return $foundItems->get();
    }

    /**
     * Return the input parameters as an array
     * 
     * If this function was not passed an array, it needs to receive 
     * an object with an all() function that can be converted to an array.
     */
    private function getInputParameters($findWhat)
    {
        if (is_array($findWhat)) {
            return $findWhat;
        }

        if (is_string($findWhat)) {
            $params = array();
            parse_str($findWhat, $params);
            return $params;
        }

        if (!method_exists($findWhat, 'all')) {
            App::abort(400, 'Array needs to be passed in as an input parameter');
        }
        $params = $findWhat->all();
        return $params;
    }


    /**
     * We should have key/value parameter pairs. If we don't, throw an error
     */
    private function verifyAllFieldsHaveValues($data) 
    {
        foreach($data as $key => $value) {
            if (!$value) {
                App::abort(400, 'Field ' . $key . ' looking for invalid value.');
            }
        }
    }

    private function verifyAllFieldNamesAreKnown($data, $context='fields')
    {
        $paramKeys = array_keys($data);
        $ruleKeys  = $this->validationRules[$context];
        $diff      = array_diff($paramKeys, $ruleKeys, $this->reservedWords);

        if (count($diff)==0)
            return;

        if (count($diff)==1)
            App::abort(400, 'Unknown field "'.$diff[0].'"');

        $fieldList = '';
        foreach($diff as $field) {
            $fieldList .= $field . ', ';
        }
        App::abort(400, 'Unknown fields "'.substr($fieldList,0,-2).'"');
    }

}

