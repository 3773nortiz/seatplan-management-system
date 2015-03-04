<div class="col-md-6 col-md-offset-3">
    <?php echo Form::open(array("class"=>"form-horizontal")); ?>

    	<fieldset>
    		<div class="form-group">
    			<?php echo Form::label('Subject name', 'subject_name', array('class'=>'control-label')); ?>

    				<?php echo Form::input('subject_name', Input::post('subject_name', isset($subject) ? $subject->subject_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Subject name')); ?>
    		</div>
            <div class="form-group">
                <?php echo Form::label('Description', 'description', array('class'=>'control-label')); ?>

                <?php echo Form::input('description', Input::post('description', isset($subject) ? $subject->description : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Description')); ?>
            </div>

    		<div class="form-group">
    			<label class='control-label'>&nbsp;</label>
    			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		
            </div>

    	</fieldset>
    <?php echo Form::close(); ?>