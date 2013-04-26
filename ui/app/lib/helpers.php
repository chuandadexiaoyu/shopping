<?php


if (!function_exists('writeDeleteButtonInCell')) 
{
    function writeDeleteButtonInCell($title="Delete this record") 
    {
        return '
        <td>
            <a href="#" class="btn_del" title="'.$title.'"><i class="icon-remove"></i></a>
        </td>';
    }
}

if (!function_exists('writeDetailControlInCell')) 
{
    function writeDetailControlInCell($title = "View record details")
    {
        return '
        <td>
            <a href="#" class="btn_expand" title="'.$title.'">
            <i class="icon-chevron-down"></i></a>
        </td>';
    }
}

if (!function_exists('writeDataFieldInCell'))
{
    function writeDataFieldInCell($fieldName, $fieldData, $recordId)
    {
        $fieldData = $fieldData ?: str_repeat('&nbsp;',20);
        return '<td><a href="" class="ed" data-name="'.$fieldName.'" data-pk="'.$recordId.'">'
                .$fieldData.'</a></td>';
    }
}

if (!function_exists('writeTextFieldInCell'))
{
    function writeTextFieldInCell($fieldName, $placeholder)
    {
        $field = Form::text($fieldName, Null, 
            array(
                'class'=>'new fullWidth', 
                'placeholder'=>$placeholder));

        return '<td>'.$field.'</td>';
    }
}


if (!function_exists('writeNewRecordControlsInCell')) 
{
    function writeNewRecordControlsInCell($addTitle = "Add a new record", $resetTitle = "Reset fields")
    {
        return '
        <td>
            <a href="#" class="btn_add" title="'.$addTitle.'"><i class="icon-ok"></i></a>&nbsp; &nbsp;
            <a href="#" class="btn_reset" title="'.$resetTitle.'"><i class="icon-edit"></i></a>
        </td>';       
    }
}

