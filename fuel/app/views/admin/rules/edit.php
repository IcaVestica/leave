<h2>Editing Rule</h2>
<br>

<?php echo render('admin/rules/_form'); ?>
<p>
	<?php echo Html::anchor('admin/rules/view/'.$rule->id, 'View'); ?> |
	<?php echo Html::anchor('admin/rules', 'Back'); ?></p>
