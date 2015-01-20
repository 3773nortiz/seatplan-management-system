<h2>Listing Subjects</h2>
<br>
<?php if ($subjects): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Subject name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($subjects as $item): ?>		<tr>

			<td><?php echo $item->subject_name; ?></td>
			<td>
				<?php echo Html::anchor('admin/subject/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/subject/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/subject/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Subjects.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/subject/create', 'Add new Subject', array('class' => 'btn btn-success')); ?>

</p>
