<h2>Listing Requested leaves</h2>
<br>
<?php if ($leaves): ?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>User</th>
                        <th>Type</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Note</th>
                        <th>Approve</th>
			
		</tr>
	</thead>
	<tbody>
<?php foreach ($leaves as $leave): ?>	<?php echo Form::open(array("class"=>"form-horizontal")); ?>	<tr>
        <input type="hidden" name="id" value="<?php echo $leave->id; ?>"/>
        <td><?php echo Model_User::find($leave->user)->username; ?><input type="hidden" name="user" value="<?php echo $leave->user; ?>"/></td>
        <td><?php echo Model_Leavetype::find($leave->type)->name; ?><input type="hidden" name="type" value="<?php echo $leave->type; ?>"/></td>
	<td><?php echo $leave->start; ?><input type="hidden" name="start" value="<?php echo $leave->start; ?>"/></td>
        <td><?php echo $leave->end; ?><input type="hidden" name="end" value="<?php echo $leave->end; ?>"/></td>
        <td><?php echo $leave->note; ?><input type="hidden" name="name" value="<?php echo $leave->note; ?>"/></td>
        <td><?php echo $leave->approved ? 'Approved' : "<div class='form-group'>
			<label class='control-label'>&nbsp;</label>
			 ".Form::submit('submit', 'Approve', array('class' => 'btn btn-primary'))."</div>"; ?></td>
		</tr><?php echo Form::close(); ?>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Requested Leaves.</p>

<?php endif; ?><p>
</p>
