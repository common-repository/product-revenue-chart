<?php add_filter( 'plugin_action_links', 'product_revenue_chart_add_action_plugin', 10, 5 );
function product_revenue_chart_add_action_plugin( $actions, $plugin_file ) 
{
	static $plugin;

	if (!isset($plugin))
		$plugin = 'product-revenue-chart/product-revenue-chart.php';
	if ($plugin == $plugin_file) {

			$settings = array('settings' => '<a style="color:#7ad03a;" href="'.site_url().'/wp-admin/options-general.php?page=product_revenue_chart_settings_page"></span>' . __('Settings', PRC_TEXTDOMAIN) . '</a>');
			$site_link = array('support' => '<a style="color:#a00;" href="'.esc_url('https://invelity.com/kontakt').'" target="_blank">'.__('Support',PRC_TEXTDOMAIN).'</a>');
		
    			$actions = array_merge($settings, $actions);
				$actions = array_merge($site_link, $actions);
			
		}
		
		return $actions;
}