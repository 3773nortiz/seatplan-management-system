<h2>Editing Subject</h2>
<br>

<?php echo render('admin/subject/_form'); ?>
<p>
	<?php echo Html::anchor('admin/subject/view/'.$subject->id, 'View'); ?> |
	<?php echo Html::anchor('admin/subject', 'Back'); ?></p>
