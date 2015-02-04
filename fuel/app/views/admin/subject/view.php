<h2>Viewing #<?php echo $subject->id; ?></h2>

<p>
	<strong>Subject name:</strong>
	<?php echo $subject->subject_name; ?></p>

<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject/edit/'.$subject->id, 'Edit'); ?> |
<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject', 'Back'); ?>