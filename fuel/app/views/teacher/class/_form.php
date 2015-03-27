
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<?php echo Form::open(array("class"=>"form-horizontal")); ?>

			<fieldset>
				<div class="form-group">
					<?php echo Form::label('Class name', 'class_name', array('class'=>'control-label')); ?>

						<?php echo Form::input('class_name', Input::post('class_name', isset($class) ? $class->class_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Class name')); ?>

				</div>
				<?php if ($scenario != 'edit') : ?>
				<div class="form-group">
					<?php echo Form::label('No. of Chairs', 'chairs', array('class'=>'control-label')); ?>

						<?php echo Form::input('chairs', Input::post('chairs', isset($class) ? $class->chairs : ''),
						array('class' => 'col-md-4 form-control', 'placeholder'=>'No. of Chairs')); ?>

				</div>
				<?php endif; ?>

				 <?php
		            $subjects = array();
		            $subject = Model_Subject::find('all', array(
		                        'select'    => array('id', 'subject_name')
		                        ));

		            foreach ($subject  as $key => $value) {
		                    $subjects[$key]  = $value['subject_name'];
		                }

		        ?>

		        <div class="form-group">
	             	<?= Form::label('Subject', 'subject_id', array('class'=>'control-label')); ?>

	                <?= Form::select('subject_id', Input::post('subject_id', isset($class) ? $class->subject_id : ''), $subjects,
	                    array('class' => 'form-control')); ?>
       			</div>

       			<div class="form-group">
	             	<?= Form::label('Class Schedule', 'schedule', array('class'=>'control-label')); ?>
	             	<br>
	             	<?php
	             		$schedules = [];
	             		if (isset($class)) {
	             			for ($x = 0; $x < strlen($class->schedule); $x++) {
	             				$schedules[$class->schedule[$x]] = 1;
	             			}
	             		}

	             		foreach (Config::get('schedules') as $key => $value) {
	             			echo '<div class="schedule-parent">';
	             			echo  Form::label($value, 'schedule', array('class'=>'control-label'));
		             		echo Form::checkbox('schedule' . $key, '1', Input::post('schedule' . $key, isset($class) && isset($schedules[$key]) ? '1' : ''),
		                    	array('class' => 'form-control schedule-checkbox'));
		             		echo '</div>';
	             		}
	             	?>
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