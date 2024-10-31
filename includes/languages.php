<?php 
function product_revenue_chart_textdomain($domain){
	    $locale = apply_filters('plugin_locale', get_locale(), $domain);
	
	    load_textdomain($domain, WP_LANG_DIR.'/'. PRC_TEXTDOMAIN .'-'.$locale.'.mo');
		load_plugin_textdomain(PRC_TEXTDOMAIN, FALSE, PRC_LANG_DIR.'/languages');
	}
add_action('init', 'product_revenue_chart_textdomain', 10, 2);