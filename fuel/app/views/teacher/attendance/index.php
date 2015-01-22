<h2>Listing Attendances</h2>
<br>
<?php if ($attendances): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Status</th>
			<th>Studentclass id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($attendances as $item): ?>		<tr>

			<td><?php echo $item->status; ?></td>
			<td><?php echo $item->studentclass_id; ?></td>
			<td>
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Attendances.</p>

<?php endif; ?><p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'attendance/create', 'Add new Attendance', array('class' => 'btn btn-success')); ?>

</p>
