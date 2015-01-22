
        <div class="row">
            <div class="col-md-6">
                <?php 
                    echo Asset::img('ic-avatar.jpg',
                        array(
                            'id' => 'previewHolder',
                            'class' => 'img-responsive',
                        ));
                ?> 
            </div>
        </div>
        <br/>
        <div class="row">
            <?php 
                echo Form::input('fileselect','upload', 
                    array(
                        'type'      => 'file', 
                        'id'        => 'fileselect', 
                        'class'     => 'file-inputs',
                        'required'  => ''
                        ));     
            ?>
        </div>

    <!--     <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
          <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
        </div>
 -->
        <!-- Script for Upload Picture -->
        <script type="text/javascript">
             function readURL(input) {
                   if (input.files && input.files[0]) {
                       var reader = new FileReader();
                       reader.onload = function(e) {
                           $('#previewHolder').attr('src', e.target.result);
                       }

                       reader.readAsDataURL(input.files[0]);
                   }
               }

               $("#fileselect").change(function() {
                   readURL(this);
               });
        </script>
        <br/>

        <?php 
            $userTypes = array();
            foreach (Config::get('simpleauth.groups') as $key => $value) {
                if($key == 50 || $key == 1) $userTypes[$key] = $value['name'];
            } 
        ?>
        
        <?php if ($action != 'edit'): ?>
             <div class="form-group">    
                <?php echo Form::label('Registe As', 'group', array('class'=>'control-label')); ?>
                <?php echo Form::select('group', $userTypes, $userTypes,
                      array('class' => 'form-control'));
                ?>
            </div>
        <?php endif; ?>
       

        <div class="form-group">
            <?php echo Form::label('First Name', 'fname', array('class'=>'control-label')); ?>

                <?php echo Form::input('fname', Input::post('fname', isset($user) ? $user->fname : ''), 
                array('class' => 'col-md-4 form-control', 'placeholder'=>'First Name', 'required' => '')); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('Middle Name', 'mname', array('class'=>'control-label')); ?>

                <?php echo Form::input('mname', Input::post('mname', isset($user) ? $user->mname : ''), 
                array('class' => 'col-md-4 form-control', 'placeholder'=>'Middle Name', 'required' => '')); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('Last Name', 'lname', array('class'=>'control-label')); ?>

                <?php echo Form::input('lname', Input::post('lname', isset($user) ? $user->lname : ''), 
                array('class' => 'col-md-4 form-control', 'placeholder'=>'Last Name', 'required'    => '')); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

                <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), 
                array('class' => 'col-md-4 form-control', 'placeholder'=>'Email', 'required'    => '')); ?>

        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>
                    <?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), 
                    array('class' => 'col-md-4 form-control', 'placeholder'=>'Username', 'required' => '')); ?>
                </div>
                <div class="col-md-6">
                    <?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>
                    <?php echo Form::password('password', Input::post('password', isset($user) ? $user->password : ''), 
                    array('class' => 'col-md-4 form-control', 'placeholder'=>'Password', 'required' => '')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">, 
            <?php echo Form::label('Address', 'address', array('class'=>'control-label')); ?>

                <?php echo Form::input('address', Input::post('address', isset($user) ? $user->address : ''), 
                array('class' => 'col-md-4 form-control', 'placeholder'=>'Address', 'required'  => '')); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('Birth Date', 'bdate', array('class'=>'control-label')); ?>

                <?php echo Form::input('bdate', Input::post('bdate', isset($user) ? $user->bdate : ''), 
                array('class' => 'col-md-4 form-control', 'placeholder'=>'Birth Date', 'required'   => '')); ?>

        </div>

        <?php
            $gender = Config::get('gender');
        ?>

        <div class="form-group">
            <?php echo Form::label('Gender', 'gender', array('class'=>'control-label')); ?>
            <?php
                echo Form::select('gender', $gender, $gender,
                    array('class' => 'form-control'));
            ?>
        </div>

        <div class="form-group">
            <?php echo Form::label('Contact Number', 'contact', array('class'=>'control-label')); ?>
            <?php echo Form::input('contact', Input::post('contact', isset($user) ? $user->contact : ''), 
            array('class' => 'col-md-4 form-control', 'placeholder'=>'Contact Number', 'required'   => '')); ?>

        </div>

        <!-- HIDDEN -->


        <div class="form-group" hidden>
            <?php echo Form::label('Last login', 'last_login', array('class'=>'control-label')); ?>
            <?php echo Form::input('last_login', Input::post('last_login', isset($user) ? $user->last_login : ''), 
            array('class' => 'col-md-4 form-control', 'placeholder'=>'Last login')); ?>
        </div>

        <div class="form-group" hidden>
            <?php echo Form::label('Login hash', 'login_hash', array('class'=>'control-label')); ?>
            <?php echo Form::input('login_hash', Input::post('login_hash', isset($user) ? $user->login_hash : ''), 
            array('class' => 'col-md-4 form-control', 'placeholder'=>'Login hash')); ?>
        </div>
        
        <div class="form-group" hidden>
            <?php echo Form::label('Profile fields', 'profile_fields', 
                array('class'=>'control-label')); ?>
            <?php echo Form::textarea('profile_fields', Input::post('profile_fields', isset($user) ? $user->profile_fields : ''), 
            array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Profile fields')); ?>
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

