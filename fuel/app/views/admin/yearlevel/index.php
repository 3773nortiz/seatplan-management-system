<h2>Listing Yearlevels</h2>
<br>
<?php if ($yearlevels): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Level</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($yearlevels as $item): ?>		<tr>

			<td><?php echo $item->level; ?></td>
			<td>
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Yearlevels.</p>

<?php endif; ?><p>
	<?php echo Html::anchor(Controller_Base::get_prefix() . 'yearlevel/create', 'Add new Yearlevel', array('class' => 'btn btn-success')); ?>

</p>
