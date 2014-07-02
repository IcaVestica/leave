<?php
class Model_Leave extends \Orm\Model
{
        protected static $_table_name = 'leave';
        
        protected static $_properties = array('id','user', 'type', 'start', 'end', 'note', 'approved');

        

}
