<option value="">State</option>;
<?php 
	if ($states) :
	foreach ($states as $key => $state) : 
		if ($state_id == $state->id) :
?>
		<option value="<?= $state->id; ?>" selected><?= $state->name; ?></option>;
<?php 
	else :
?>
		<option value="<?= $state->id; ?>"><?= $state->name; ?></option>;
<?php 
	endif;
	endforeach;
	endif;
?>