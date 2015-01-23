<h2>Editing Class</h2>
<br>

<?= render(Controller_Base::get_prefix() . 'class/_seatplan', compact('students', 'student_seats') + ['class_id' => $class->id]); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'class/view/'.$class->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?></p>
