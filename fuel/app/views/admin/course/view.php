<h2>Viewing #<?php echo $course->id; ?></h2>

<p>
	<strong>Coursename:</strong>
	<?php echo $course->coursename; ?></p>

<?php echo Html::anchor(Controller_Base::get_prefix() . 'course/edit/'.$course->id, 'Edit'); ?> |
<?php echo Html::anchor(Controller_Base::get_prefix() . 'course', 'Back'); ?>