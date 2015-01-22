<h2>Listing Studentclasses</h2>
<br>
<?php if ($studentclasses): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User id</th>
			<th>Class id</th>
			<th>Seat</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($studentclasses as $item): ?>		<tr>

			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->class_id; ?></td>
			<td><?php echo $item->seat; ?></td>
			<td>
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'studentclass/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'studentclass/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'studentclass/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Studentclasses.</p>

<?php endif; ?><p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'studentclass/create', 'Add new Studentclass', array('class' => 'btn btn-success')); ?>

</p>
