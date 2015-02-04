<h2>Viewing #<?php echo $yearlevel->id; ?></h2>

<p>
	<strong>Level:</strong>
	<?php echo $yearlevel->level; ?></p>

<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel/edit/'.$yearlevel->id, 'Edit'); ?> |
<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel', 'Back'); ?>