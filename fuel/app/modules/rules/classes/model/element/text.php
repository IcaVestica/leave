<?php
namespace Rules;

class Model_Element_Text 
{
    public function create($rule)
    {
        $name = $rule['field_name'];
        $label = $rule['label'];
        $html = "<label for='$name'>$label</label>";
        $html .= "<input type='text' id='$name' name='$name' />";
        if(isset($rule['options'])):
            $select_name = $name.'_option';
            $html .="<select name='$select_name'>";
            foreach($rule['options'] as $ruleopt):
                $html .="<option value='$ruleopt'>$ruleopt<option>";
            endforeach;
            $html .="</select>";
        endif;
        return $html;
    }
}
