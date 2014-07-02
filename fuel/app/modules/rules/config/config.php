<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */


return array(

	'end_date_required' => array(
            'type' =>  'checkbox',
            'label' => 'Is end date required?',
            'field_name'   => 'end_date_required',
            'check_on_front' => 1
        ),
        'auto_approve' => array(
            'type' =>  'checkbox',
            'label' => 'Is automatically approved upon creation?',
            'field_name'   => 'auto_approve',
            'check_on_front' => 1
        ),
        'paid' => array(
            'type' =>  'checkbox',
            'label' => 'Is leave paid?',
            'field_name'   => 'paid',
            'check_on_front' => 0
        ),
        'exclude_holiday' => array(
            'type' =>  'checkbox',
            'label' => 'Holiday should be substracted from number of the days?',
            'field_name'   => 'exclude_holiday',
            'check_on_front' => 0
        ),
        'book_in_advance' => array(
            'type' =>  'text',
            'label' => 'Must be booked in advance',
            'field_name'   => 'book_in_advance',
            'check_on_front' => 1
        ),
        'same_time_users' => array(
            'type' =>  'text',
            'label' => 'Maximum allowed users at the same time',
            'field_name'   => 'same_time_users',
            'check_on_front' => 1
        ),
        'days_allowed' => array(
            'type' =>  'text',
            'label' => 'Days allowed in period',
            'field_name'   => 'days_allowed',
            'options'   => array('days', 'month', 'year'),
            'check_on_front' => 0
        ),

);
