<?php
class Controller_Admin_Rules extends Controller_Admin{

	public function action_index()
	{
                
                \Config::load('rules::config', 'rules');
                $rules = Config::get('rules');
              
		$data['rules'] = $rules;
		$this->template->title = "Rules";
		$this->template->content = View::forge('admin/rules/index', $data);

	}
        
        public function action_install($name)
        {
            Db::query("CREATE TABLE IF NOT EXISTS `installed_rules` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) NOT NULL ,
                  `element` text NOT NULL DEFAULT '',
                  PRIMARY KEY (`id`) 
                ) ")->execute();
            
            \Config::load('rules::config', 'rules');
            $rules = Config::get('rules');
            $installed_rule = $rules[$name];
            $type = $installed_rule['type'];
            $action_model_name = '\Rules\Model_Element_'.  ucfirst($type);
            $element = new $action_model_name();
            $element_html = base64_encode($element->create($installed_rule));
            Db::query("INSERT INTO `installed_rules` (
                  `name`,
                  `element`  
                ) VALUES('$name', '$element_html')")->execute(); 
            Db::query("CREATE TABLE IF NOT EXISTS `leavetype` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` text NOT NULL, 
                  PRIMARY KEY (`id`) 
                ) ")->execute();
            
            $columns = DB::list_columns('leavetype');
            if(!in_array($name, array_keys($columns))):
                 Db::query("ALTER TABLE leavetype
                ADD $name varchar(255)")->execute();
                
            endif;
            if(isset($installed_rule['options'])):
                if(!in_array($name.'_option', array_keys($columns))):
                    $col_title = $name.'_option';
                 Db::query("ALTER TABLE leavetype
                ADD $col_title varchar(255)")->execute();
                
                endif;
            endif;
                    
            $data['rules'] = $rules;
            $this->template->title = "Rules";
            $this->template->content = View::forge('admin/rules/index', $data);
        }
        
        

	public function action_view($id = null)
	{
		$data['rule'] = Model_Rule::find($id);

		$this->template->title = "Rule";
		$this->template->content = View::forge('admin/rules/view', $data);

	}
        
        public function action_create()
	{
           
            
            \Rules\Model_Rule::getRule();
            \Config::load('rules::config', 'rules');
            $rules = Config::get('rules');
            var_dump($rules);

            $view = View::forge('admin/rules/create');
 
            if (Input::method() == 'POST')
            {
                $rule = Model_Rule::forge(array(
                    'name' => Input::post('name'),
                    'type' => Input::post('type'),
                    'required' => Input::post('required'),
                    'label' => Input::post('label'),
                    'has_options' => Input::post('has_options'),
                    'options_type' => Input::post('options_type'),
                ));

                if ($rule and $rule->save())
                {
                    Session::set_flash('success', 'Added rule #'.$rule->id.'.');
                    Response::redirect('admin/rules');
                }

                else
                {
                    Session::set_flash('error', 'Could not save rule.');
                }
            }

            // Set some data
            $view->set_global('type', array('input' => 'input', 'checkbox' => 'checkbox'));
            $view->set_global('options_type', array('select' => 'select'));

            $this->template->title = "Create Rule";
            $this->template->content = $view;
        }

        
        
        public function action_edit($id = null)
        {
            $view = View::forge('admin/rules/edit');

            $rule = Model_Rule::find($id);
  
            
            if (Input::method() == 'POST')
            {
                $rule->name = Input::post('name');
                $rule->type = Input::post('type');
                $rule->required = Input::post('required');
                $rule->label = Input::post('label');
                $rule->has_options = Input::post('has_options');
                $rule->options_type = Input::post('options_type');

                if ($rule->save())
                {
                    Session::set_flash('success', 'Updated rule #' . $id);
                    Response::redirect('admin/rules');
                }

                else
                {
                    Session::set_flash('error', 'Could not update rule #' . $id);
                }
            }

            else
            {
                $this->template->set_global('rule', $rule, false);
            }

            // Set some data
            $view->set_global('type', array('input' => 'input', 'checkbox' => 'checkbox'));
            $view->set_global('options_type', array('select' => 'select'));


            $this->template->title = "Edit Rule";
            $this->template->content = $view;
        }
        
        
	public function action_delete($id = null)
	{
		if ($rule = Model_Rule::find($id))
		{
			$rule->delete();

			Session::set_flash('success', e('Deleted rule #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete rule #'.$id));
		}

		Response::redirect('admin/rules');

	}


}