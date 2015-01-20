<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Subject name', 'subject_name', array('class'=>'control-label')); ?>

				<?php echo Form::input('subject_name', Input::post('subject_name', isset($subject) ? $subject->subject_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Subject name')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>