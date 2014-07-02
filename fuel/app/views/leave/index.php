<h2>Create your leave</h2>
<?php echo Form::open(array("class"=>"form-horizontal")); 
 echo Asset::js(array(
		'//code.jquery.com/ui/1.11.0/jquery-ui.js',
		
	));
 echo Asset::css(array(
		'//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css',
		
	));
 ?>


<fieldset>
        <div class="form-group">
             <?php echo Form::label('Type', 'type'); ?>

                    <div class="input">
                        <?php echo Form::select('type', Input::post('type'), $leavetypes, array('class' => 'span6')); ?>

                    </div>


        </div>
        <div class="form-group">
             <?php echo Form::label('User', 'user'); ?>

                    <div class="input">
                        <?php echo Form::select('user', Input::post('user'), $users, array('class' => 'span6')); ?>

                    </div>


        </div>
        <div class="form-group">
			<?php echo Form::label('Start', 'start', array('class'=>'control-label')); ?>

			<?php echo Form::input('start', Input::post('start'), array('class' => 'col-md-4 form-control datepicker')); ?>

	</div>
        <div class="form-group">
			<?php echo Form::label('End', 'end', array('class'=>'control-label')); ?>

			<?php echo Form::input('end', Input::post('end'), array('class' => 'col-md-4 form-control datepicker')); ?>

	</div>
        <div class="form-group">
			<?php echo Form::label('Note', 'note', array('class'=>'control-label')); ?>

			<?php echo Form::textarea('note', Input::post('note'), array('class' => 'col-md-4 form-control')); ?>

	</div>
        <div class="form-group">
                <label class='control-label'>&nbsp;</label>
                <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>	
        </div>
</fieldset>
<?php echo Form::close(); ?>
<script type="text/javascript">
    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
</script>

