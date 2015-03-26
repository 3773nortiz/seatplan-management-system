<h2>Viewing #<?php echo $attendance->id; ?></h2>

<p>
	<strong>Status:</strong>
	<?php echo $attendance->status; ?></p>
<p>
	<strong>Studentclass id:</strong>
	<?php echo $attendance->studentclass_id; ?></p>

<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance/edit/'.$attendance->id, 'Edit'); ?> |
<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance', 'Back'); ?>