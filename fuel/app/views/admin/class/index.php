<h2>Listing Classes</h2>
<br>
<?php if ($classes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Class name</th>
			<th>Chairs</th>
			<th>Subject id</th>
			<th>User id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($classes as $item): ?>		<tr>

			<td><?php echo $item->class_name; ?></td>
			<td><?php echo $item->chairs; ?></td>
			<td><?php echo $item->subject_id; ?></td>
			<td><?php echo $item->user_id; ?></td>
			<td>
				<?php echo Html::anchor('admin/class/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/class/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/class/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Classes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/class/create', 'Add new Class', array('class' => 'btn btn-success')); ?>

</p>
