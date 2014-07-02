<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<?php 
    if(isset($leavetypes)):
        $post = $leavetypes;
    endif;
?>
	<fieldset>
            <?php 
                if(count($installed_rules)): 
                    foreach($installed_rules as $installed_rule):
                ?>
                <div class="form-group">
			<?php echo base64_decode($installed_rule['element'])?>

		</div>
            <?php 
                    endforeach;
                endif; ?>
		
		
		
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
