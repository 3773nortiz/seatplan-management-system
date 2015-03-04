<div class="row center-block">
	<div class=" col-md-4 col-md-offset-4">
		<?php echo Form::open(array()); ?>

			<?php if (isset($_GET['destination'])): ?>
				<?php echo Form::hidden('destination',$_GET['destination']); ?>
			<?php endif; ?>

			<?php if (isset($login_error)): ?>
				<div class="error"><?php echo $login_error; ?></div>
			<?php endif; ?>

			<div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>">
				<label for="email">Email or Username/ID Number:</label>
				<?php echo Form::input('email', Input::post('email'), array('class' => 'form-control', 'autofocus')); ?>

				<?php if ($val->error('email')): ?>
					<span class="control-label"><?php echo $val->error('email')->get_message('You must provide a username or email'); ?></span>
				<?php endif; ?>
			</div>

			<div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>">
				<label for="password">Password:</label>
				<?php echo Form::password('password', null, array('class' => 'form-control')); ?>

				<?php if ($val->error('password')): ?>
					<span class="control-label"><?php echo $val->error('password')->get_message(':label cannot be blank'); ?></span>
				<?php endif; ?>
			</div>

			<div class="actions">
				<div class="col-md-6">
					<?php echo Form::submit(array('value'=>'Login', 'name'=>'submit', 
					'class' => 'btn btn-md btn-primary btn-block')); ?>
				</div>
				<div class="col-md-6">
					<?php echo Html::anchor('account/register', 'Register', array(
					'class' => 'btn btn-md btn-primary btn-block',)); ?>
				</div>
			</div>

		<?php echo Form::close(); ?>
	</div>


</div>