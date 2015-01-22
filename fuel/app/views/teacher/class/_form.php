
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo Form::open(array("class"=>"form-horizontal")); ?>

			<fieldset>
				<div class="form-group">
					<?php echo Form::label('Class name', 'class_name', array('class'=>'control-label')); ?>

						<?php echo Form::input('class_name', Input::post('class_name', isset($class) ? $class->class_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Class name')); ?>

				</div>
				<div class="form-group">
					<?php echo Form::label('No. of Chairs', 'chairs', array('class'=>'control-label')); ?>

						<?php echo Form::input('chairs', Input::post('chairs', isset($class) ? $class->chairs : ''), 
						array('class' => 'col-md-4 form-control', 'placeholder'=>'No. of Chairs')); ?>

				</div>
				<div class="form-group" hidden>
					<?php echo Form::label('Subject id', 'subject_id', array('class'=>'control-label')); ?>

						<?php echo Form::input('subject_id', Input::post('subject_id', isset($class) ? $class->subject_id : 0), 
						array('class' => 'col-md-4 form-control', 'placeholder'=>'Subject id')); ?>

				</div>
				<div class="form-group" hidden>
					<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

						<?php echo Form::input('user_id', (isset($class) ? $class->user_id : $current_user->id), 
								array('class' => 'col-md-4 form-control', 
									  'placeholder'=>'User id')); ?>

				</div>
				<div class="form-group col-md-6 col-md-offset-3">
					<label class='control-label'>&nbsp;</label>
					<?php echo Form::submit('submit', 'Save', array(
						'class' => 'btn btn-primary',
						'style' => 'width: 100%')); ?>		
				</div>
			</fieldset>
		<?php echo Form::close(); ?>
	</div>
</div>