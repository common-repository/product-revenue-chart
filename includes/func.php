<?php
function product_revenue_chart_get_orders_ids_by_product_id( $product_id, $order_status = array( 'wc-completed' ), $year = 'Y', $yearstring = 'YEAR' ) {
    global $wpdb;

    $results = $wpdb->get_col("
        SELECT order_items.order_id
        FROM {$wpdb->prefix}woocommerce_order_items as order_items
        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
        WHERE posts.post_type = 'shop_order'
        AND ".$yearstring."(posts.post_date) = ".date($year)."
        AND posts.post_status IN ( '" . implode( "','", $order_status ) . "' )
        AND order_items.order_item_type = 'line_item'
        AND order_item_meta.meta_key = '_product_id'
        AND order_item_meta.meta_value = '$product_id'
    ");

    return $results;
}

function product_revenue_chart_randomHex() {
   $chars = 'ABCDEF0123456789';
   $color = '#';
   for ( $i = 0; $i < 6; $i++ ) {
      $color .= $chars[rand(0, strlen($chars) - 1)];
   }
   return $color;
}

function product_revenue_chart_get_product_price($order_id, $product_id){
	// Getting the order object "$order"
$order = wc_get_order( $order_id );
// Getting the items in the order
$order_items = $order->get_items();
// Iterating through each item in the order
$result = array();
foreach ($order_items as $item_id => $item_data) {
if($item_data['product_id']==$product_id){
    // Get the product name
    $product_name = $item_data['name'];
    // Get the item quantity
    $item_quantity = wc_get_order_item_meta($item_id, '_qty', true);
    // Get the item line total
    $item_total = wc_get_order_item_meta($item_id, '_line_total', true);
    //$item_total = $order->get_item_meta($item_id, '_line_subtotal', true);

$result = array('qty'=>$item_quantity,'total'=>$item_total);
}
}
return $result;
}