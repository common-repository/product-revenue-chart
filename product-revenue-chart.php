<?php
/*
 * Plugin Name: Product revenue chart
 * Version: 1.0.7
 * Description: Create chart for product in edit product page.
 * Author: INVELITY
 * Author URI: https://invelity.com/
 * Plugin URI: https://www.invelity.com/sk/sluzby/
 *
 */

if (! defined( 'ABSPATH' ) ){ die('Plugin Product revenue chart can not run !!!'); }

function product_revenue_chart_plugin_wc_init() {
	if(! class_exists( 'woocommerce' ) ) { die('Plugin Product revenue chart require Woocommerce plugin !!!'); }
}
add_action( 'plugins_loaded', 'product_revenue_chart_plugin_wc_init' );

define('PRC_TEXTDOMAIN','product_revenue_chart_textdomain');
define('PRC_LANG_DIR',dirname(plugin_basename(__FILE__)));
define('PRC_AJAX_URL', plugin_dir_url( __FILE__ ) . 'inv-custom-ajax.php');

include_once(plugin_dir_path( __FILE__ ).'/includes/languages.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/func.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/metaboxes.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/ajax_func.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/admin_page.php');
include_once(plugin_dir_path( __FILE__ ).'/includes/plugins_own_links.php');