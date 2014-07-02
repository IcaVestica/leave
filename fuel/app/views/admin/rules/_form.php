<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<?php 
    if(isset($rule)):
        $post = $rule;
    endif;
?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Name', 'name', array('class'=>'control-label')); ?>

				<?php echo Form::input('name', Input::post('name', isset($post) ? $post->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Name')); ?>

		</div>
		<div class="form-group">
                     <?php echo Form::label('Type', 'type'); ?>
 
                            <div class="input">
                                <?php echo Form::select('type', Input::post('type', isset($post) ? $post->type : ''), $type, array('class' => 'span6')); ?>

                            </div>
			

		</div>
                <div class="form-group">
			<?php echo Form::label('Required', 'requiered', array('class'=>'control-label')); ?>

				<?php echo Form::checkbox('requiered', 'Required', Input::post('required', isset($post) ? $post->required : ''), array('class' => 'col-md-4 form-control')); ?>

		</div>
                <div class="form-group">
			<?php echo Form::label('Label', 'label', array('class'=>'control-label')); ?>

				<?php echo Form::input('label', Input::post('label', isset($post) ? $post->label : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Label')); ?>

		</div>
                <div class="form-group">
			<?php echo Form::label('Has options', 'has_options', array('class'=>'control-label')); ?>

				<?php echo Form::checkbox('has_options', 'Has options', Input::post('has_options', isset($post) ? $post->has_options : ''), array('class' => 'col-md-4 form-control', 'onclick' => "addOption();")); ?>

		</div>
                <div class="form-group" id="rule_option">
			<?php echo Form::label('Options', 'option_name[]', array('class'=>'control-label')); ?>

				<?php echo Form::input('option_name[]', '', array('class' => 'col-md-4 form-control')); ?>

		</div>
		<div class="form-group">
                     <?php echo Form::label('Options Type', 'options_type'); ?>
 
                            <div class="input">
                                <?php echo Form::select('options_type', Input::post('options_type', isset($post) ? $post->options_type : ''), $options_type, array('class' => 'span6')); ?>

                            </div>
			

		</div>
		
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
<script type="text/javascript">
    function addOption(){
        var new_option = $("input[name^='option_name']").parent().first().clone();
        $('#rule_option').append(new_option);
    }
</script>