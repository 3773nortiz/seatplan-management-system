<h2>Editing Studentclass</h2>
<br>

<?php echo render(Controller_Base::get_prefix() . 'studentclass/_form'); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'studentclass/view/'.$studentclass->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'studentclass', 'Back'); ?></p>
