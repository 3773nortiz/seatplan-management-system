<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($studentclass) ? $studentclass->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Class id', 'class_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('class_id', Input::post('class_id', isset($studentclass) ? $studentclass->class_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Class id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Seat', 'seat', array('class'=>'control-label')); ?>

				<?php echo Form::input('seat', Input::post('seat', isset($studentclass) ? $studentclass->seat : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Seat')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>