<h2>Editing Attendance</h2>
<br>

<?php echo render(Controller_Base::get_prefix() . 'attendance/_form'); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance/view/'.$attendance->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance', 'Back'); ?></p>
