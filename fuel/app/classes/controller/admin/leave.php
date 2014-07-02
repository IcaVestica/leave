<?php
class Controller_Admin_Leave extends Controller_Admin{

	public function action_index()
	{
		$data['leaves'] = Model_Leave::find('all');
                if (Input::post('user') AND Input::post('type') AND Input::post('start') AND Input::post('id'))
                {
                   $post = Input::post();
                   $post['approved'] = 0;
                   \Config::load('rules::config', 'rules');
                   $rules = Config::get('rules');
                   $type_id = $post['type'];
                   $type = Db::query("SELECT * FROM leavetype WHERE id=$type_id LIMIT 1")->execute()->as_array();
                   $installed_rules = Model_Rule::getInstalledRules();
                   $leave =  Model_Leave::find($post['id']);
                   if(count($installed_rules)):
                       foreach ($installed_rules as $installed_rule):

                        if($type[0][$installed_rule['name']]):
                           
                           $leave = \Rules\Model_Checker_Dispatcher::check($installed_rule['name'], $leave);
                           if(!is_object($leave)):
                               Session::set_flash('error', $leave);
                               Response::redirect('admin/leave');
                               
                           endif;
                        endif;
                       endforeach;
                   endif;

                   $leave->approved = 1;
                  
                   if($leave->save()):
                       Session::set_flash('success', 'Leave approved.');
                       Response::redirect('admin/leave');
                   else:
                       Session::set_flash('error', 'Could not create leave.');
                       Response::redirect('admin/leave');
                   endif;
                }else
                {
                    Session::set_flash('error', 'Could not create leave. Fill data.');
                }
		$this->template->title = "Requested Leaves";
		$this->template->content = View::forge('admin/leave/index', $data);

	}
}
