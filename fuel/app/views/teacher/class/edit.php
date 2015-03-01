<h2>Editing Class</h2>
<p>
    <?php echo Html::anchor(Controller_Base::get_prefix() . 'class/view/'.$class->id, 'View'); ?> |
    <?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?></p>
<br>

<?= render(Controller_Base::get_prefix() . 'class/_seatplan', compact('students', 'student_seats', 'class', 'scenario')); ?>