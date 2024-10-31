<?php

add_action('invelity_ajax_createchart','product_revenue_chart_create_chart');
add_action('wp_ajax_createchart','product_revenue_chart_create_chart');

function product_revenue_chart_create_chart(){
$executionStartTime = microtime(true);
$template = 'chart';
if (defined('DOING_AJAX') && DOING_AJAX) { check_ajax_referer( 'prc_nonce', 'security' ); }
$t = json_decode(get_option('prc_template'));
//print_r($t); die();
if(count($t)<>0){ $template = $t[0]; }

    $post_id = sanitize_text_field($_REQUEST['id']);

    if(!$post_id){ return; }

    $prcstatuses = json_decode(get_option('prc_order_statuses'));

    if(count($prcstatuses)==0){ $prcstatuses = array( 'wc-pending', "wc-processing", "wc-on-hold", "wc-completed" ); }

    $orders = product_revenue_chart_get_orders_ids_by_product_id( $post_id, $prcstatuses );

    $d = array();
    $months_number = 12;
    for ($i = 1; $i <= $months_number; $i++){ $d[$i]=0; }
if($orders){
    foreach($orders as $order_id){

        $order = new WC_Order( $order_id );

        //$d[intval(date('n',strtotime($order->get_date_created())))] += $order->get_total();

        $total_item = product_revenue_chart_get_product_price($order_id, $post_id);

        if(isset($d[intval(date('n',strtotime($order->get_date_created())))])){  } else { $d[intval(date('n',strtotime($order->get_date_created())))]=0; }

        $d[intval(date('n',strtotime($order->get_date_created())))] += $total_item['total'];

    }
}

$height_index = 30;

if($orders){ $max = max ( $d ) / $height_index; } else { $max = $height_index; }
$percento = $max / 100;

$colwidth = (100 / $months_number) - 2;

$months = array (1=>array(__('Jan',PRC_TEXTDOMAIN),'#FFFF00FF'),2=>array(__('Feb',PRC_TEXTDOMAIN),'#FF006EFF'),3=>array(__('Mar',PRC_TEXTDOMAIN),'#4800FFFF'),4=>array(__('Apr',PRC_TEXTDOMAIN),'#FF6A00FF'),5=>array(__('May',PRC_TEXTDOMAIN),'#00FF21FF'),6=>array(__('Jun',PRC_TEXTDOMAIN),'#B200FFFF'),7=>array(__('Jul',PRC_TEXTDOMAIN),'#B6FF00FF'),8=>array(__('Aug',PRC_TEXTDOMAIN),'#0094FFFF'),9=>array(__('Sep',PRC_TEXTDOMAIN),'#00137FFF'),10=>array(__('Oct',PRC_TEXTDOMAIN),'#FF006EFF'),11=>array(__('Nov',PRC_TEXTDOMAIN),'#B200FFFF'),12=>array(__('Dec',PRC_TEXTDOMAIN),'#FF0000FF'));

$nomonths = array();

$randomcolor = false;

include_once($template.'.php');
$executionEndTime = microtime(true);
$seconds = $executionEndTime - $executionStartTime;
//print $seconds;
if (defined('DOING_AJAX') && DOING_AJAX) {die(); }

} 