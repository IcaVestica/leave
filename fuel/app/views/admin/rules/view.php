<h2>Viewing #<?php echo $rule->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $rule->name; ?></p>
<p>
	<strong>Type:</strong>
	<?php echo $rule->type; ?></p>
<p>
	<strong>Required:</strong>
	<?php echo $rule->required ? 'yes' : 'no'; ?></p>
<p>
	<strong>Label:</strong>
	<?php echo $rule->label; ?></p>
<p>
	<strong>Has options:</strong>
	<?php echo $rule->has_options ? 'yes' : 'no'; ?></p>
<p>
	<strong>Options Type:</strong>
	<?php echo $rule->options_type; ?></p>
<?php echo Html::anchor('admin/rules/edit/'.$rule->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/rules', 'Back'); ?>