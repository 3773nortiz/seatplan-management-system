<h2>Listing Courses</h2>
<br>
<?php if ($courses): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Coursename</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($courses as $item): ?>		<tr>

			<td><?php echo $item->coursename; ?></td>
			<td>
				<?php echo Html::anchor('admin/course/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/course/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/course/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Courses.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/course/create', 'Add new Course', array('class' => 'btn btn-success')); ?>

</p>
