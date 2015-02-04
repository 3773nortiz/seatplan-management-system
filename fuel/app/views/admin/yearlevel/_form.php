<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Level', 'level', array('class'=>'control-label')); ?>

				<?php echo Form::input('level', Input::post('level', isset($yearlevel) ? $yearlevel->level : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Level')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>