
        <?php
        if(isset($user)) :?>
            <script type="text/javascript">
                $(function () {
                    $("#fileselect").fileinput({
                        initialPreview: [
                            "<img class='img-responsive' width='200px' src='<?= Config::get('base_url').'uploads/'. $user->prof_pic ?>'/>",
                        ],
                        overwriteInitial: true,
                        initialCaption: '<?=  $user->prof_pic; ?>'
                    });
                });
            </script>
        <?php else: ?>
            <script>
             $(function () {
                $("#fileselect").fileinput();
            });
            </script>
        <?php endif; ?>


        <div class="row">
             <?php echo Form::label('Upload Image', 'fileselect1', array('class'=>'control-label')); ?>
            <input id="fileselect" name="fileselect" type="file" multiple="false"
              data-show-preview="true" data-show-upload="false"
              data-show-caption="true" accept="image/*">
        </div>

        <?php
            $userTypes = array();
            foreach (Config::get('simpleauth.groups') as $key => $value) {
                if($key == 50 || $key == 1) $userTypes[$key] = $value['name'];
            }
        ?>

        <?php if ($action != 'edit'): ?>
             <div class="form-group" hidden>
                <?php echo Form::label('Register As', 'group', array('class'=>'control-label')); ?>
                <?php echo Form::select('group', $userTypes, $userTypes,
                      array('class'    => 'form-control register-as',
                            'onchange' => 'filterRegisterType()'));
                ?>
            </div>
        <?php endif; ?>
        <?php if ($action != 'edit'): ?>
            <div class="form-group">
                <?php echo Form::label('ID Number', 'username', array('class'=>'control-label')); ?>
                <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''),
                array('class' => 'col-md-4 form-control', 'required' => '')); ?>
            </div>
        <?php else: ?>
            <div class="form-group">
                <?php echo Form::label('ID Number', 'username', array('class'=>'control-label')); ?>
                <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''),
                array('class' => 'col-md-4 form-control', 'required' => '', 'disabled')); ?>
            </div>
        <?php endif; ?>

         <div class="form-group">
            <?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>
            <?php echo Form::password('password', Input::post('password', isset($user) ? '••••••' : ''),
            array('class' => 'col-md-4 form-control', 'required' => '', 'placeholder' => 'Password must not be greater than 10')); ?>
        </div>

        <div class="form-group">
            <?php echo Form::label('First Name', 'fname', array('class'=>'control-label')); ?>

                <?php echo Form::input('fname', Input::post('fname', isset($user) ? $user->fname : ''),
                array('class' => 'col-md-4 form-control', 'required' => '')); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('Middle Name', 'mname', array('class'=>'control-label')); ?>

                <?php echo Form::input('mname', Input::post('mname', isset($user) ? $user->mname : ''),
                array('class' => 'col-md-4 form-control', 'required' => '')); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('Last Name', 'lname', array('class'=>'control-label')); ?>

                <?php echo Form::input('lname', Input::post('lname', isset($user) ? $user->lname : ''),
                array('class' => 'col-md-4 form-control', 'required'    => '')); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

                <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''),
                array('class' => 'col-md-4 form-control', 'required' => '')); ?>

        </div>

         <?php if ($action != 'edit'): ?>
            <div class="form-group">
                <?php echo Form::label('Birth Date', 'bdate', array('class'=>'control-label')); ?>
                <div class="input-group date">
                        <?php echo Form::input('bdate', Input::post('bdate', isset($user) ? $user->bdate : ''),
                        array('class' => 'col-md-4 datepicker form-control',
                        'data-date-format' => 'mm/dd/yyyy',
                        'required'   => '',
                        'placeholder' => 'MM/DD/YYYY')); ?>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
        <?php else: ?>
            <div class="form-group">
                <?php echo Form::label('Birth Date', 'bdate', array('class'=>'control-label')); ?>
                <div class="input-group date">
                        <?php echo Form::input('bdate', Input::post('bdate', isset($user) ? $user->bdate : ''),
                        array('class' => 'col-md-4 datepicker form-control',
                        'data-date-format' => 'mm/dd/yyyy',
                        'required'   => '',
                        'disabled')); ?>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
        <?php endif; ?>


        <?php
            $gender = Config::get('gender');
        ?>

        <?php if ($action != 'edit'): ?>
            <div class="form-group">
                <?php echo Form::label('Gender', 'gender', array('class'=>'control-label')); ?>
                <?php
                    echo Form::select('gender', $gender, $gender,
                        array('class' => 'form-control'));
                ?>
            </div>
        <?php else: ?>
            <div class="form-group">
                <?php echo Form::label('Gender', 'gender', array('class'=>'control-label')); ?>
                <?php
                    echo Form::select('gender', $gender, $gender,
                        array('class' => 'form-control', 'disabled'));
                ?>
            </div>
        <?php endif; ?>


        <div class="form-group">
            <?php echo Form::label('Address', 'address', array('class'=>'control-label')); ?>

                <?php echo Form::input('address', Input::post('address', isset($user) ? $user->address : ''),
                array('class' => 'col-md-4 form-control', 'required'  => '')); ?>
        </div>


        <div class="form-group">
            <?php echo Form::label('Contact Number', 'contact', array('class'=>'control-label')); ?>
            <?php echo Form::input('contact', Input::post('contact', isset($user) ? $user->contact : ''),
            array('class' => 'col-md-4 form-control', 'required'   => '')); ?>

        </div>

        <?php
            $courses = array();
            $course = Model_Course::find('all', array(
                        'select'    => array('id', 'coursename'),
                        'where'     => array(array('id', '!=', 0))
                        ));

            foreach ($course  as $key => $value) {
                    $courses[$key]  = $value['coursename'];
                }

        ?>

        <?php if ($action != 'edit'): ?>
            <div class="form-group" <?= (isset($user) && $user->group != 1 ? 'hidden' : '') ?>>
                <?= Form::label('Year Level', 'yearlevel_id', array('class'=>'control-label')); ?>
                <?= Form::select('yearlevel_id', 0, Arr::assoc_to_keyval(Model_Yearlevel::getYearLevel(), 'id', 'level') + (isset($user) && $user->group != 1 ? ['0' => ''] : []),
                    array('class'    => 'form-control')); ?>
            </div>
        <?php else: ?>
            <div class="form-group" <?= (isset($user) && $user->group != 1 ? 'hidden' : '') ?>>
                <?= Form::label('Year Level', 'yearlevel_id', array('class'=>'control-label')); ?>
                <?= Form::select('yearlevel_id', 0, Arr::assoc_to_keyval(Model_Yearlevel::getYearLevel(), 'id', 'level') + (isset($user) && $user->group != 1 ? ['0' => ''] : []),
                    array('class'    => 'form-control', 'disabled')); ?>
            </div>
        <?php endif; ?>

        <?php if ($action != 'edit'): ?>
            <div class="form-group course-list" <?= (isset($user) && $user->group != 1 ? 'hidden' : '') ?>>
                   <?= Form::label('Course', 'course_id', array('class'=>'control-label')); ?>

                    <?= Form::select('course_id', $courses, $courses + (isset($user) && $user->group != 1 ? ['0' => ''] : []),
                        array('class' => 'form-control')); ?>
            </div>
        <?php else: ?>
            <div class="form-group course-list" <?= (isset($user) && $user->group != 1 ? 'hidden' : '') ?>>
                   <?= Form::label('Course', 'course_id', array('class'=>'control-label')); ?>

                    <?= Form::select('course_id', $courses, $courses + (isset($user) && $user->group != 1 ? ['0' => ''] : []),
                        array('class' => 'form-control', 'disabled')); ?>
            </div>
        <?php endif; ?>


        <!-- HIDDEN -->


        <div class="form-group" hidden>
            <?php echo Form::label('Last login', 'last_login', array('class'=>'control-label')); ?>
            <?php echo Form::input('last_login', Input::post('last_login', isset($user) ? $user->last_login : ''),
            array('class' => 'col-md-4 form-control')); ?>
        </div>

        <div class="form-group" hidden>
            <?php echo Form::label('Login hash', 'login_hash', array('class'=>'control-label')); ?>
            <?php echo Form::input('login_hash', Input::post('login_hash', isset($user) ? $user->login_hash : ''),
            array('class' => 'col-md-4 form-control')); ?>
        </div>

        <div class="form-group" hidden>
            <?php echo Form::label('Profile fields', 'profile_fields',
                array('class'=>'control-label')); ?>
            <?php echo Form::textarea('profile_fields', Input::post('profile_fields', isset($user) ? $user->profile_fields : ''),
            array('class' => 'col-md-8 form-control', 'rows' => 8)); ?>
        </div>

        <!-- HIDDEN -->
        <br/>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <?php echo Form::submit('submit', $action == 'edit' ? 'Update' : 'Submit', array(
                        'class' => 'btn btn-primary',
                        'style' => 'width:100%')); ?>
                </div>
                <div class="col-md-6">
                    <?php echo Html::anchor($action == 'edit' ? 'account' : 'account/login', 'Back', array(
                        'class' => 'btn btn-primary',
                        'style' => 'width:100%')); ?>
                </div>

            </div>
        </div>


<script>
        function filterRegisterType () {
            var registerType = $("select.register-as option:selected").val();
            console.log(registerType);
                if(registerType == 50) {
                   $('div.form-group.course-list').attr('hidden', 'true');
                }
            }
</script>