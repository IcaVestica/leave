<?php
namespace Rules;

class Model_Element_Checkbox 
{
    public function create($rule)
    {
        $name = $rule['field_name'];
        $label = $rule['label'];
        $html = "<label for='$name'>$label</label>";
        $html .= "<input type='checkbox' id='$name' name='$name' />";
        return $html;
    }
}
