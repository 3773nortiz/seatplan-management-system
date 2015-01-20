<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Status', 'status', array('class'=>'control-label')); ?>

				<?php echo Form::input('status', Input::post('status', isset($attendance) ? $attendance->status : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Studentclass id', 'studentclass_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('studentclass_id', Input::post('studentclass_id', isset($attendance) ? $attendance->studentclass_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Studentclass id')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>