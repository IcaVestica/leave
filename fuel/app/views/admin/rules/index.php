<h2>Listing Rules</h2>
<br>
<?php if ($rules): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rules as $rule_name => $item): ?>		<tr>

			<td><?php echo $item['field_name']; ?></td>
			<td>
				<?php echo Html::anchor('admin/rules/install/'.$item['field_name'], 'Install'); ?> 
				

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rules.</p>

<?php endif; ?><p>

</p>
