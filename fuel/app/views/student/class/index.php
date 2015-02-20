<h2>List of Class</h2>
<br>
<?php if ($classes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Class Name</th>
			<th>No. of Chairs</th>
			<th>Subject Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($classes as $item): ?>		<tr>

			<td><?php echo $item->class_name; ?></td>
			<td><?php echo $item->chairs; ?></td>
			<td><?php echo $item->getSubjectName();?></p></td>
			<!-- <td><?php //echo $item->user_id; ?></td> -->
			<td>
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'class/view/'.$item->id, 'View'); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Class Created</p>

<?php endif; ?>
