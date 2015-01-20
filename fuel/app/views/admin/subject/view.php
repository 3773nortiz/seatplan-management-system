<h2>Viewing #<?php echo $subject->id; ?></h2>

<p>
	<strong>Subject name:</strong>
	<?php echo $subject->subject_name; ?></p>

<?php echo Html::anchor('admin/subject/edit/'.$subject->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/subject', 'Back'); ?>