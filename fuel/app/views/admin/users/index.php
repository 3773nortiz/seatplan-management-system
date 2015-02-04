<h2>Listing Users</h2>
<br>
<?php if ($users): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Fname</th>
			<th>Mname</th>
			<th>Lname</th>
			<th>Email</th>
			<th>Username</th>
			<th>Password</th>
			<th>Address</th>
			<th>Bdate</th>
			<th>Gender</th>
			<th>Contact</th>
			<th>Prof pic</th>
			<th>Group</th>
			<th>Last login</th>
			<th>Login hash</th>
			<th>Profile fields</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $item): ?>		<tr>

			<td><?php echo $item->fname; ?></td>
			<td><?php echo $item->mname; ?></td>
			<td><?php echo $item->lname; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo $item->username; ?></td>
			<td><?php echo $item->password; ?></td>
			<td><?php echo $item->address; ?></td>
			<td><?php echo $item->bdate; ?></td>
			<td><?php echo $item->gender; ?></td>
			<td><?php echo $item->contact; ?></td>
			<td><?php echo $item->prof_pic; ?></td>
			<td><?php echo $item->group; ?></td>
			<td><?php echo $item->last_login; ?></td>
			<td><?php echo $item->login_hash; ?></td>
			<td><?php echo $item->profile_fields; ?></td>
			<td>
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Users.</p>

<?php endif; ?><p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'users/create', 'Add new User', array('class' => 'btn btn-success')); ?>

</p>
