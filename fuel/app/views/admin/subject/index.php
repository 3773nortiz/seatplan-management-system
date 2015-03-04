<h2>Listing Subjects</h2>
<br>
<?php if ($subjects): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Subject name</th>
			<th>Subject Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($subjects as $item): ?>		
			<tr>
				<td><?php echo $item->subject_name; ?></td>
				<td><?php echo $item->description; ?></td>
				<td>
					<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject/view/'.$item->id, 'View'); ?> |
					<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject/edit/'.$item->id, 'Edit'); ?> |
					<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
				</td>
			</tr>
	<?php endforeach; ?>	
	</tbody>
</table>

<?php else: ?>
<p>No Subjects.</p>

<?php endif; ?><p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'subject/create', 'Add new Subject', array('class' => 'btn btn-success')); ?>

</p>
