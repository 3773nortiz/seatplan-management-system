<h2>Editing Class</h2>
<br>

<?php echo render(Controller_Base::get_prefix() . 'class/_form'); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'class/view/'.$class->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'class', 'Back'); ?></p>
