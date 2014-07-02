<h2>Listing Comments</h2>
<br>
<?php if ($comments): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Website</th>
			<th>Message</th>
			<th>Post id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($comments as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo $item->website; ?></td>
			<td><?php echo $item->message; ?></td>
			<td><?php echo $item->post_id; ?></td>
			<td>
				<?php echo Html::anchor('admin/comments/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/comments/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/comments/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Comments.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/comments/create', 'Add new Comment', array('class' => 'btn btn-success')); ?>

</p>
