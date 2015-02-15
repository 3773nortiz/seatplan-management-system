<?php
class Controller_Admin_Users extends Controller_Users
{
    public function action_index()
    {
        $data['users'] = Model_User::find('all', array(
                'where' => array(array('group', '50')))
            );

        $this->template->title = "Teacher List";
        $this->template->content = View::forge(parent::get_prefix() . 'users/index', $data);
    }

}
