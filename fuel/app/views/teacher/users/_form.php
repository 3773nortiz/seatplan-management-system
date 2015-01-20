<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Fname', 'fname', array('class'=>'control-label')); ?>

				<?php echo Form::input('fname', Input::post('fname', isset($user) ? $user->fname : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Fname')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Mname', 'mname', array('class'=>'control-label')); ?>

				<?php echo Form::input('mname', Input::post('mname', isset($user) ? $user->mname : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Mname')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Lname', 'lname', array('class'=>'control-label')); ?>

				<?php echo Form::input('lname', Input::post('lname', isset($user) ? $user->lname : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Lname')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

				<?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Email')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>

				<?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password', isset($user) ? $user->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Password')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Address', 'address', array('class'=>'control-label')); ?>

				<?php echo Form::input('address', Input::post('address', isset($user) ? $user->address : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Address')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Bdate', 'bdate', array('class'=>'control-label')); ?>

				<?php echo Form::input('bdate', Input::post('bdate', isset($user) ? $user->bdate : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Bdate')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Gender', 'gender', array('class'=>'control-label')); ?>

				<?php echo Form::input('gender', Input::post('gender', isset($user) ? $user->gender : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Gender')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Contact', 'contact', array('class'=>'control-label')); ?>

				<?php echo Form::input('contact', Input::post('contact', isset($user) ? $user->contact : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Contact')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Prof pic', 'prof_pic', array('class'=>'control-label')); ?>

				<?php echo Form::input('prof_pic', Input::post('prof_pic', isset($user) ? $user->prof_pic : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Prof pic')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Group', 'group', array('class'=>'control-label')); ?>

				<?php echo Form::input('group', Input::post('group', isset($user) ? $user->group : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Group')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Last login', 'last_login', array('class'=>'control-label')); ?>

				<?php echo Form::input('last_login', Input::post('last_login', isset($user) ? $user->last_login : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Last login')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Login hash', 'login_hash', array('class'=>'control-label')); ?>

				<?php echo Form::input('login_hash', Input::post('login_hash', isset($user) ? $user->login_hash : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Login hash')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Profile fields', 'profile_fields', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('profile_fields', Input::post('profile_fields', isset($user) ? $user->profile_fields : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Profile fields')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>