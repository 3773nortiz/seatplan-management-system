<h2>Editing Course</h2>
<br>

<?php echo render(Controller_Base::get_prefix() . 'course/_form'); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'course/view/'.$course->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'course', 'Back'); ?></p>
