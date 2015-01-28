<h2>Viewing #<?php echo $course->id; ?></h2>

<p>
	<strong>Coursename:</strong>
	<?php echo $course->coursename; ?></p>

<?php echo Html::anchor('admin/course/edit/'.$course->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/course', 'Back'); ?>