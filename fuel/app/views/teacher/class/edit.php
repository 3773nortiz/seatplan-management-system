<h2>Editing Class</h2>
<br>

<?php echo render(Controller_Base::get_prefix() . 'class/_form', ['class_id' => $class->id, 'student_seats' => $student_seats]); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'class/view/'.$class->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?></p>
