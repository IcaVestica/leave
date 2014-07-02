<?php
namespace Rules;

class Model_Checker_Enddaterequired extends Model_Checker_Dispatcher 
{
    public function checkInput($leave){
        if(!$leave->end) return 'End date required';
        return $leave;
        
    }
    
}
