<h2>Editing Subject</h2>
<br>

<?php echo render(Controller_Base::get_prefix() . 'subject/_form'); ?>
<p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject/view/'.$subject->id, 'View'); ?> |
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject', 'Back'); ?></p>
