<?php
class Controller_Teacher_Status extends Controller_Account
{

    public function action_index()
    {
        // $data[''] = Model_Attendance::find('all');
        $this->template->title = "Status";
        $this->template->content = View::forge(parent::get_prefix() . 'status/index');

    }


}


