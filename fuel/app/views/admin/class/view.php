<h2>Viewing #<?php echo $class->id; ?></h2>

<p>
	<strong>Class name:</strong>
	<?php echo $class->class_name; ?></p>
<p>
	<strong>Chairs:</strong>
	<?php echo $class->chairs; ?></p>
<p>
	<strong>Subject id:</strong>
	<?php echo $class->subject_id; ?></p>
<p>
	<strong>User id:</strong>
	<?php echo $class->user_id; ?></p>

<?php echo Html::anchor(Controller_Base::get_prefix() . 'class/edit/'.$class->id, 'Edit'); ?> |
<?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?>