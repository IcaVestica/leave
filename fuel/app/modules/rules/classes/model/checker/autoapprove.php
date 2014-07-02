<?php
namespace Rules;

class Model_Checker_Autoapprove extends Model_Checker_Dispatcher 
{
    public function checkInput($leave){
        $leave->approved = 1;
        return $leave;
        
    }
    
}
