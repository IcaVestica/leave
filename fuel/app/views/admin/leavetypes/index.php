<h2>Listing Leave types</h2>
<br>
<?php if ($leavetypes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			
		</tr>
	</thead>
	<tbody>
<?php foreach ($leavetypes as $leavetype): ?>		<tr>

			<td><?php echo $leavetype['name']; ?></td>
			
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rules.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/leavetype/create', 'Add new Rule', array('class' => 'btn btn-success')); ?>

</p>
