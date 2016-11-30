<?php
 /**
 * Theme function
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <opalwordpress@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
 if( !defined("WPB_VC_VERSION") ){
	define("WPB_VC_VERSION",'4.3.3');	
}
define( 'WPO_THEME_DIR', get_template_directory() );
define( 'WPO_THEME_SUB_DIR', WPO_THEME_DIR.'/sub/' );
define( 'WPO_THEME_CSS_DIR', WPO_THEME_DIR.'/css/' );
define( 'WPO_THEME_URI', get_template_directory_uri() );

define( 'WPO_THEME_NAME', 'shopping' );
define( 'WPO_THEME_VERSION', '1.0' );
 
define( 'WPO_WOOCOMMERCE_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );


/*
 * Include list of files from Opal Framework.
 */ 
require_once( WPO_THEME_DIR . '/framework/loader.php' );
require_once( WPO_THEME_DIR . '/sub/theme.php' );
require_once( WPO_THEME_DIR . '/sub/startup.php' );

/* 
 * Localization
 */ 
 
 
$lang = WPO_THEME_DIR . '/languages' ;
load_theme_textdomain( TEXTDOMAIN, $lang );

/**
 * Create variant objects to modify and proccess actions of only theme.
 */
require_once( WPO_THEME_DIR . '/sub/pagebuilder.php' );

/*
 * Shortcodes
 */
require_once( WPO_THEME_DIR. '/shortcode.php' );

/*
 * Create & start up instance of framework in application.
 */


/// include list of functions to process logics of worpdress not support 3rd-plugins.
require_once( WPO_THEME_DIR . '/sub/functions/theme.php' );

/// WooCommerce specified functions
if( WPO_WOOCOMMERCE_ACTIVED ) {
    require_once( WPO_THEME_DIR . '/sub/functions/woocommerce.php' );
}

// Add save percent next to sale item prices.
//add_filter( 'woocommerce_sale_price_html', 'woocommerce_custom_sales_price', 10, 2 );
//function woocommerce_custom_sales_price( $price, $product ) {
//    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
//    return $price . sprintf( __(' Save %s', 'woocommerce' ), $percentage . '%' );
//}


