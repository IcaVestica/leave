<?php
class Model_Rule extends \Orm\Model
{
        protected static $_table_name = 'rules';
        protected static $_belongs_to = array('rule');
	protected static $_properties = array(
		'id',
		'name',
		'type',
		'required',
		'label',
		'has_options',
                'options_type',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('type', 'Type', 'required');
		$val->add_field('label', 'Label', 'required');
		return $val;
	}
        
        public static function getInstalledRules()
        {
            return Db::query("SELECT * FROM installed_rules")->execute()->as_array();
        }

}
