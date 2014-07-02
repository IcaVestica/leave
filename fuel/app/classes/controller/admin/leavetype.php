<?php
class Controller_Admin_Leavetype extends Controller_Admin{

	public function action_index()
	{
		$data['leavetypes'] = Model_Leavetype::find('all');
		$this->template->title = "Leave Types";
		$this->template->content = View::forge('admin/leavetypes/index', $data);

	}

	public function action_view($id = null)
	{
		$data['leavetype'] = Model_Leavetype::find($id);

		$this->template->title = "Leave Type";
		$this->template->content = View::forge('admin/leavetypes/view', $data);

	}
        
        public function action_create()
	{

            \Config::load('rules::config', 'rules');
            $rules = Config::get('rules');
            $installed_rules = Db::query("SELECT * FROM installed_rules")->execute()->as_array();
            $data = array();
            $name = '';
            

            $view = View::forge('admin/leavetypes/create');

            if (Input::method() == 'POST')
            {
                if(count($installed_rules)):
                foreach($installed_rules as $installed_rule):
                    $data[$installed_rule['name']] = Input::post($installed_rule['name']); 
                    if(isset($rules[$installed_rule['name']]['options'])):
                        $data[$installed_rule['name'].'_option'] = Input::post($installed_rule['name'].'_option');
                    endif;
                    if(Input::post($installed_rule['name'])):
                        $name .= $installed_rule['name'].'-'.Input::post($installed_rule['name']).'_';
                    endif;
                    if(Input::post($installed_rule['name'].'_option')):
                        $name .= Input::post($installed_rule['name'].'_option').'_';
                    endif;
                endforeach;
                $data['name'] = $name;
                endif;
                 
               $leavetype =  DB::insert('leavetype')->set($data)->execute();

                if (!empty($leavetype))
                {
                    Session::set_flash('success', 'Added leavetype #'.reset($leavetype).'.');
                    Response::redirect('admin/leavetype');
                }

                else
                {
                    Session::set_flash('error', 'Could not save leavetype.');
                }
            }

            // Set some data
            $view->set_global('type', array('input' => 'input', 'checkbox' => 'checkbox'));
            $view->set_global('installed_rules', $installed_rules);

            $this->template->title = "Create Leave type";
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