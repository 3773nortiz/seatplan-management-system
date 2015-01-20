<h2>Editing Attendance</h2>
<br>

<?php echo render('admin/attendance/_form'); ?>
<p>
	<?php echo Html::anchor('admin/attendance/view/'.$attendance->id, 'View'); ?> |
	<?php echo Html::anchor('admin/attendance', 'Back'); ?></p>
