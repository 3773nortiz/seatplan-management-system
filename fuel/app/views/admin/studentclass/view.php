<h2>Viewing #<?php echo $studentclass->id; ?></h2>

<p>
	<strong>User id:</strong>
	<?php echo $studentclass->user_id; ?></p>
<p>
	<strong>Class id:</strong>
	<?php echo $studentclass->class_id; ?></p>
<p>
	<strong>Seat:</strong>
	<?php echo $studentclass->seat; ?></p>

<?php echo Html::anchor('admin/studentclass/edit/'.$studentclass->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/studentclass', 'Back'); ?>