<?php if ($users): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>			
			<th>Email</th>
			<th>Address</th>
			<th>Bdate</th>
			<th>Gender</th>
			<th>Contact</th>
			<!-- <th>Last login</th> -->
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $item): ?>		<tr>
		<td><?php echo $item->fname . ' '. $item->mname[0].'. ' .$item->lname; ?></td>
		<td><?php echo $item->email; ?></td>
		<td><?php echo $item->address; ?></td>
		<td><?php echo Date::forge($item->bdate)->format("%B %d, %Y", true); ?></td>
		<td><?php echo Config::get('gender')[$item->gender]; ?></td>
		<td><?php echo $item->contact; ?></td>
		<!-- <td><?php //echo Date::forge($item->last_login)->format("%B %d, %Y", true); ?></td> -->
		<td>
			<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/view/'.$item->id, 'View'); ?> |
			<?php echo Html::anchor('admin/users/edit/'.$item->id, 'Edit'); ?> |
			<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

		</td>
		</tr>
	<?php endforeach; ?>	
	</tbody>
</table>

<?php else: ?>
<p>No Teacher(s).</p>
<?php endif; ?><p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/create', 'Add new Teacher', array('class' => 'btn btn-success')); ?>
</p>
