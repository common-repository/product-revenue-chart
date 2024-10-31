<?php
add_action('add_meta_boxes','product_revenue_chart_woocommerce_add_metaboxes', 99);

function product_revenue_chart_woocommerce_add_metaboxes(){
remove_meta_box('woocommerce-product-items','product','normal');
add_meta_box( 'woocommerce-product-revenue-chart', __('Revenue from the product',PRC_TEXTDOMAIN), 'product_revenue_chart_create_meta_box_content', 'product', 'normal', 'high');
}

function product_revenue_chart_create_meta_box_content(){
global $post;
$pid = $post->ID;
?>
<style>
.loader{position:relative;margin:0 auto;width:30px}.loader:before{content:'';display:block;padding-top:100%}.circular{-webkit-animation:rotate 2s linear infinite;animation:rotate 2s linear infinite;height:100%;-webkit-transform-origin:center center;-ms-transform-origin:center center;transform-origin:center center;width:100%;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto}.path{stroke-dasharray:1,200;stroke-dashoffset:0;-webkit-animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;stroke-linecap:round}@-webkit-keyframes rotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}50%{stroke-dasharray:89,200;stroke-dashoffset:-35}100%{stroke-dasharray:89,200;stroke-dashoffset:-124}}@keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}50%{stroke-dasharray:89,200;stroke-dashoffset:-35}100%{stroke-dasharray:89,200;stroke-dashoffset:-124}}@-webkit-keyframes color{0%,100%{stroke:#d62d20}40%{stroke:#0057e7}66%{stroke:#008744}80%,90%{stroke:#ffa700}}@keyframes color{0%,100%{stroke:#d62d20}40%{stroke:#0057e7}66%{stroke:#008744}80%,90%{stroke:#ffa700}}
</style>
<div id="chart-ajax-container">
  <div class="loader"> <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg> </div> 
</div>
<?php include_once('logo.php'); ?>
<script type="text/javascript" >
   jQuery(document).ready(function($) {

        var data = {
            'action': 'createchart',
            'id': '<?php print trim($pid); ?>',
            'width': $('#woocommerce-product-revenue-chart').width(),
            'security': '<?php echo wp_create_nonce( "prc_nonce" ); ?>',
            };
var invajaxurl = '<?php print PRC_AJAX_URL; ?>';
        jQuery.post(ajaxurl, data, function(response) {
            $('#chart-ajax-container').html(response);
        });

    });
    </script>
<?php
}