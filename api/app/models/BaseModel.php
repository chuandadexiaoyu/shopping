<?php

class BaseModel extends Eloquent
{
    
    protected $reservedWords = array(
        'count',
        'offset'
    );

    protected $validationRules = array();

    protected $defaultRule = 'view';


    /**
     * Validate data according to the validation rules
     * 
     * @param  array $data      array of field/value pairs to validate
     * @param  string $context  context of the request (view, add, edit, etc.)
     * @return [type]           [description]
     */
    public function validate($data, $context=Null)
    {
        $context = $context ?: $this->defaultRule;
        $params = $this->getInputParameters($data);
        $this->verifyAllFieldNamesAreKnown($params, $context);
        $this->verifyAllFieldsHaveValues($params);

        return Validator::make($params, $this->validationRules[$context]);
    }

    public function search($findWhat, $context=Null)
    {
        // If we were passed an integer, find the primary key
        if(is_numeric($findWhat)) {
            return parent::find($findWhat);            
        } 

        $params  = $this->getInputParameters($findWhat);

        // Validate the input
        $context = $context ?: $this->defaultRule;
        $validator = $this->validate($params, $context);
        if (!$validator->passes()) {
            App::abort(400, $validator->errors()->all(':message'));      
        }

        // TODO: Figure out how to use other parameters: =, >=, <=, >, < 
        // search for submitted parameters
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


// Private helper functions --------------------------------------------------------------

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


    private function verifyAllFieldNamesAreKnown($data, $context=Null)
    {
        $context = $context ?: $this->defaultRule;
        $this->verifyContextExists($context);

        $paramKeys = array_keys($data);
        $ruleKeys  = array_keys($this->validationRules[$context]);
        $diff      = array_diff($paramKeys, $ruleKeys, $this->reservedWords);

        if (count($diff)==0)
            return;

        if (count($diff)==1)
            App::abort(400, 'Unknown field: '.$diff[0].'');

        $fieldList = '';
        foreach($diff as $field) {
            $fieldList .= $field . ', ';
        }
        App::abort(400, 'Unknown fields: '.substr($fieldList,0,-2).'');
    }


    private function verifyContextExists($context)
    {
        if (!isset($this->validationRules[$context])) {
            App::abort(500, 'invalid validation rule: '.$context.'');
        }

        // check each key in the context to make sure it has an associated value
        foreach($this->validationRules[$context] as $key=>$value) {
            if (is_integer($key)) {
                App::abort(500, 'missing value for validation rule: '.$context.'.'.$value);
            }
        }

        return True;
    }


}

