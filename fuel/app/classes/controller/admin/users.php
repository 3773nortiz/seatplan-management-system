<?php
class Controller_Admin_Users extends Controller_Users
{
    public function action_index()
    {
        $data['users'] = Model_User::find('all', array(
                'where' => array(array('group', '!=', '100')))
            );

        $this->template->title = "User List";
        $this->template->content = View::forge(parent::get_prefix() . 'users/index', $data);
    }

    public function action_edit($id = null)
    {
        $user = Model_User::find($id);
        $val = Model_User::validate('edit', $user);

        if (Input::post('bdate')) {
            $_POST['bdate'] = Date::create_from_string(Input::post('bdate'), "us")->get_timestamp();
        }

        if (!Input::post('prof_pic')) {
            $_POST['prof_pic'] = $user->prof_pic;
        }

        // $_POST['username'] = $user->username;
        // $_POST['bdate'] = $user->bdate;
        // $_POST['gender'] = $user->gender;

        if ($val->run())
        {
            if (Input::post('password') == '••••••' || !Input::post('password')) {
                $_POST['password'] = $user->password;
            } else {
                $_POST['password'] = Auth::instance()->hash_password(Input::post('password'));
            }

            $user->fname = Input::post('fname');
            $user->mname = Input::post('mname');
            $user->lname = Input::post('lname');
            $user->email = Input::post('email');
            $user->username = Input::post('username');
            $user->password = Input::post('password');
            $user->address = Input::post('address');
            $user->bdate = Input::post('bdate');
            $user->gender = Input::post('gender');
            $user->contact = Input::post('contact');
            $user->prof_pic = Input::post('prof_pic');
            $user->last_login = Input::post('last_login');
            $user->login_hash = Input::post('login_hash');
            $user->profile_fields = Input::post('profile_fields');
            $user->course_id = Input::post('course_id');
            $user->yearlevel_id = Input::post('yearlevel_id');
            Upload::process(Config::get('upload_prof_pic'));

            if (Upload::is_valid() || $user->prof_pic) {

                Upload::save();
                $value = Upload::get_files();

                if (sizeof($value) > 0) {
                    $user->prof_pic = $value[0]['saved_as'];
                }

                if ($user->save()) {
                    Session::set_flash('success', e('You Succesfully Updated Profile #' . $id));
                    Response::redirect('users');
                }
                else
                {

                    Session::set_flash('error', e('Could not update user #' . $id));
                }
            }
        }

        else
        {
            if (Input::method() == 'POST')
            {

                $user->fname = $val->validated('fname');
                $user->mname = $val->validated('mname');
                $user->lname = $val->validated('lname');
                $user->email = $val->validated('email');
                $user->username = $val->validated('username');
                $user->password = $val->validated('password');
                $user->address = $val->validated('address');
                $user->bdate = $val->validated('bdate');
                $user->gender = $val->validated('gender');
                $user->contact = $val->validated('contact');
                $user->prof_pic = $val->validated('prof_pic');
                // $user->group = $val->validated('group');
                $user->last_login = $val->validated('last_login');
                $user->login_hash = $val->validated('login_hash');
                $user->profile_fields = $val->validated('profile_fields');
                $user->course_id = $val->validated('course_id');
                $user->yearlevel_id = $val->validated('yearlevel_id');
                Session::set_flash('error', $val->error());
            }

            $_POST['bdate'] = $user->bdate = Date::forge($user->bdate)->format("%m/%d/%Y", true);
            $this->template->set_global('user', $user, false);
        }

        if (Auth::get('id') == $id ) {
            $this->template->title = "Edit Profile";
            $this->template->content = View::forge('edit_profile');
        } else {
            $this->template->title = "Edit Users";
            $this->template->content = View::forge('admin/users/edit', ['action' => 'edit']);
        }
    }

}
