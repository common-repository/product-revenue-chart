<?php
add_action( 'admin_menu', 'product_revenue_chart_plugin_menu' );

function product_revenue_chart_plugin_menu() {
	add_options_page( 
		__('Product revenue chart Options',PRC_TEXTDOMAIN),
		__('Product revenue chart',PRC_TEXTDOMAIN),
		'manage_options',
		'product_revenue_chart_settings_page',
		'product_revenue_chart_plugin_settings_page_func'
	);
}

function product_revenue_chart_plugin_settings_page_func(){
if(isset($_POST['prc_submit'])){
	$select = array();
if(isset($_POST['prc_select'])){
foreach($_POST['prc_select'] as $key=>$value){ $select = array();
foreach($value as $v){ if(trim($v)<>''){ $select[] = sanitize_text_field($v); } }
update_option(sanitize_text_field($key),json_encode($select));
}
}
}
?>
<style>
	.postbox{ width:98%; max-width:600px; margin-top:2em; margin-left:auto; margin-right:auto; }
	.postbox div{ padding:1em; }
	.postbox input[type="text"], .postbox input[type="number"]{ width:100%; }
	.postbox label{ padding:3px; font-weight:bold; display:block; }
</style>
<div style="padding:1em;">
<h1 style="text-align:center;"><?php _e('Product revenue chart Options',PRC_TEXTDOMAIN); ?></h1>	
</div>
<div class="postbox">
<form action="" method="post">
<div><label for=""><?php $array = wc_get_order_statuses(); _e('Order statuses',PRC_TEXTDOMAIN); ?></label>
	<select style="width:100%; height:100%;" size="<?php print count($array) + 1; ?>" multiple="multiple" name="prc_select[prc_order_statuses][]"><option></option>
		<?php $prcstatuses = json_decode(get_option('prc_order_statuses')); foreach($array as $key=>$value){ if(in_array($key,$prcstatuses)){ $active = 'selected="selected"';} else{ $active = ''; } print '<option '.$active.' value="'.$key.'">'.$value.'</option>'; } ?>
	</select>
	<br><br>
	<label for=""><?php $array = array('chart'=>__('Bar chart',PRC_TEXTDOMAIN),'graph'=>__('Line graph',PRC_TEXTDOMAIN)); _e('Template',PRC_TEXTDOMAIN); ?></label>
	<select style="width:100%; height:100%;" size="<?php print count($array) + 0; ?>"  name="prc_select[prc_template][]">
		<?php $prcstatuses = json_decode(get_option('prc_template')); foreach($array as $key=>$value){ if(in_array($key,$prcstatuses)){ $active = 'selected="selected"';} else{ $active = ''; } print '<option '.$active.' value="'.$key.'">'.$value.'</option>'; } ?>
	</select>
<div id="publishing-action"><input name="prc_submit" class="button button-primary button-large" type="submit" value="<?php _e('Save'); ?>"></div>
</form>
</div>
<div style="padding:1em;"><br>
<?php include_once('logo.php'); ?>
</div>
<?php
}