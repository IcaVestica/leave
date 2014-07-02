<?php
class Model_Leavetype extends \Orm\Model
{
        protected static $_table_name = 'leavetype';
        protected static $_belongs_to = array('rule');
        protected static $_properties = array('id','name');

        public function _construct() {

             
             $columns = Db::list_columns("leavetype")->execute();
             if(count($columns)):
                 foreach($columns as $colname => $column):
                    self::$_properties[] = $colname;
                 endforeach;
             endif;
             
             var_dump(self::$_properties);
        }
	
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('type', 'Type', 'required');
		$val->add_field('label', 'Label', 'required');
		return $val;
	}

}
