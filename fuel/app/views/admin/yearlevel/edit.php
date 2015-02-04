<h2>Editing Yearlevel</h2>
<br>

<?php echo render(Controller_Base::get_prefix() . 'yearlevel/_form'); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel/view/'.$yearlevel->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel', 'Back'); ?></p>
