<?php
define( 'DOING_AJAX', true );
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}

if (!isset( $_REQUEST['action']))
	die('-1');
//treba upravit, podla toho, kde sa tento subor nachadza
require_once('../../../wp-load.php');

//nastavenie headers
header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
send_nosniff_header();
header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('X-Robots-Tag: noindex');

$action = esc_attr(trim($_REQUEST['action']));
//nastavenie len akcii, ktore su povolene
$allowed_actions = array(
	'createchart'
);
// Change DUMMY_ to something unique to your project.
if(in_array($action, $allowed_actions)) {
	if(is_user_logged_in())
		do_action('invelity_ajax_'.$action);
	else
		do_action('invelity_ajax_nopriv_'.$action);
} else {
	die('-1');
}