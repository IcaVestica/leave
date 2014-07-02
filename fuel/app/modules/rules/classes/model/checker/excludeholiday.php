<?php
namespace Rules;

class Model_Checker_Excludeholiday extends Model_Checker_Dispatcher 
{
    public function checkInput($leave){
        
        return $leave;
        
    }
    
}
