<?php
namespace Rules;

class Model_Checker_Dispatcher implements Model_Checker_Checker
{
    
    public static function check($rule_name, $leave)
    {
        
        $name = '\Rules\Model_Checker_'.ucfirst(strtolower(\Inflector::camelize($rule_name)));
        
        $ruler = new $name;
        return $ruler->checkInput($leave);
    }
}
