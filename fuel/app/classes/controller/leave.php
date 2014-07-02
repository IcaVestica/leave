<?php
class Controller_Leave extends Controller_Base
{
    public function action_index()
    {
        $view = View::forge('leave/index');
         
        $leave_objects = Model_Leavetype::find('all');
        $options = array();
        if(count($leave_objects)):
            foreach($leave_objects as $leave_object):
                $options[$leave_object->id] = $leave_object->name;
            endforeach;
        endif;
            
        $view->leavetypes = $options;
        $user_objects = Model_User::find('all');
        $options_user = array();
        if(count($user_objects)):
            foreach($user_objects as $user_object):
                $options_user[$user_object->id] = $user_object->username;
            endforeach;
        endif;
        $view->users = $options_user;
        if (Input::post('user') AND Input::post('type') AND Input::post('start'))
        {
           $post = Input::post();
           $post['approved'] = 0;
           \Config::load('rules::config', 'rules');
           $rules = Config::get('rules');
           $type_id = $post['type'];
           $type = Db::query("SELECT * FROM leavetype WHERE id=$type_id LIMIT 1")->execute()->as_array();
           $installed_rules = Model_Rule::getInstalledRules();
           $leave =  Model_Leave::forge($post);
           
           if(count($installed_rules)):
               foreach ($installed_rules as $installed_rule):
              
                if($type[0][$installed_rule['name']] and $rules[$installed_rule['name']]['check_on_front']):
                   $leave = \Rules\Model_Checker_Dispatcher::check($installed_rule['name'], $leave);
                   if(!is_object($leave)):
                       
                       Session::set_flash('error', $leave);
                       break;
                       
                   endif;
                endif;
               endforeach;
           endif;
         
           if(is_object($leave)):
               if($leave->save()):
                   Session::set_flash('success', 'Leave requested.');
                   Response::redirect('leave/');
               else:
                   Session::set_flash('error', 'Could not create leave.');
                   Response::redirect('leave/');
               endif;
          endif;
        }else
        {
            Session::set_flash('error', 'Could not create leave. Fill data.');
        }
        $this->template->title = 'Stuff leaves';
        $this->template->content = $view;
    }
    
    public function action_view($slug)
    {

        $post = Model_Post::find_by_slug($slug, array('related' => array('user', 'comments')));
        $this->template->title = $post->title;
        $this->template->content = View::forge('blog/view', array(
            'post' => $post,
        ));
    }
    
    
    public function action_comment($slug)
    {
        $post = Model_Post::find_by_slug($slug);

        // Lazy validation
        if (Input::post('name') AND Input::post('email') AND Input::post('message'))
        {
            // Create a new comment
            $post->comments[] = new Model_Comment(array(
                'name' => Input::post('name'),
                'website' => Input::post('website'),
                'email' => Input::post('email'),
                'message' => Input::post('message'),
                'user_id' => $this->current_user->id,
            ));

            // Save the post and the comment will save too
            if ($post->save())
            {
                $comment = end($post->comments);
                Session::set_flash('success', 'Added comment #'.$comment->id.'.');
            }
            else
            {
                Session::set_flash('error', 'Could not save comment.');
            }

            Response::redirect('blog/view/'.$slug);
        }

        // Did not have all the fields
        else
        {
            // Just show the view again until they get it right
            $this->action_view($slug);
        }
    }
}
?>
