<h2>Editing Studentclass</h2>
<br>

<?php echo render('admin/studentclass/_form'); ?>
<p>
	<?php echo Html::anchor('admin/studentclass/view/'.$studentclass->id, 'View'); ?> |
	<?php echo Html::anchor('admin/studentclass', 'Back'); ?></p>
