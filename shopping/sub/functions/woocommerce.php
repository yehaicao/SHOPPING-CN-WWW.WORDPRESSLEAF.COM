<?php

add_theme_support( 'woocommerce' );
/////
// Wishlist
// add_filter( 'yith_wcwl_button_label',		   'wpo_woocomerce_icon_wishlist'  );
//add_filter( 'yith-wcwl-browse-wishlist-label', 'wpo_woocomerce_icon_wishlist_add' );


add_filter('add_to_cart_fragments',				'wpo_woocommerce_header_add_to_cart_fragment' );
//add_filter( 'woocommerce_breadcrumb_defaults',  'wpo_woocommerce_breadcrumbs' );
//add_filter( 'woocommerce_breadcrumb_defaults',  'wpo_change_breadcrumb_delimiter' );


/////
// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);					// breadcrumbs
remove_action( 'woocommerce_sidebar', 			  'woocommerce_get_sidebar', 10);								// sidebar

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);		// content wrapper begin
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10);		// content wrapper end

add_action( 'woocommerce_before_main_content',    'wpo_woocommerce_output_content_wrapper', 10);		// content wrapper begin
add_action( 'woocommerce_after_main_content', 	  'wpo_woocommerce_output_content_wrapper_end', 10);	// content wrapper end

/// Remove Style Woocommerce
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function wpo_woocommerce_output_content_wrapper(){ ?>
    <!-- #Content -->
    <div id="wpo-mainbody" class="container wpo-mainbody">

<?php }


function wpo_woocommerce_output_content_wrapper_end(){
?>
    </div>
    <?php
}
/* ---------------------------------------------------------------------------
 * WooCommerce - Styles
 * --------------------------------------------------------------------------- */
// function wpo_woo_styles() {
// 	wp_enqueue_style( 'wpo-woocommerce', WPO_THEME_URI .'/css/woocommerce.css', 'woocommerce_frontend_styles-css', WPO_THEME_VERSION, 'all' );
// }
// add_action( 'wp_enqueue_scripts', 'wpo_woo_styles', 100 );



function wpo_woocomerce_icon_wishlist( $value='' ){
	return '<i class="fa fa-heart"></i><span>'._e('Add to wishlist').'</span>';
}

function wpo_woocomerce_icon_wishlist_add(){
	return '<i class="fa fa-check"></i><span>'._e('Add to wishlist').'</span>';
}


/*Customise the WooCommerce breadcrumb*/
function wpo_woocommerce_breadcrumbs() {
	return array(
		'delimiter' => ' &#47; ',
		'wrap_before' => '<nav class="breadcrumb container" itemprop="breadcrumb">',
		'wrap_after' => '</nav>',
		'before' => '',
		'after' => '',
		'home' => _x( 'Home', 'breadcrumb', 'woocommerce' )
	);
}

/**
 *
 */
 function wpo_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<a href="<?php echo $woocommerce->cart->get_cart_url()?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>" data-remote="true" data-toggle="modal" data-target="#wpo_modal_cart" class="icon-cart minicart-offcanvas">
		<i class="fa fa-shopping-cart"></i>
		<span class="number-item"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
	</a>
	<?php
	$fragments['a.icon-cart'] = ob_get_clean();
	return $fragments;
}



/*
 * Re-markup html for cart content with bootstrap dropdown
 */
function wpo_cartdropdown(){
	global $woocommerce; ?>
    <div class="dropdown">
        <!-- <h4>Shopping Cart</h4> -->
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" data-hover="dropdown" data-delay="0" href="#" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
            <i class="fa fa-shopping-cart"></i>
            <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
        </a>
        <div class="dropdown-menu">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
<?php }

/*
 *  Display list of navigations info with list of listin + total, info for woocommerce
 */
function wpo_woocommerce_pagination( $per_page,$total ){
    ?>
    <div class="clearfix">
        <?php wpo_pagination($prev = __('Previous',TEXTDOMAIN), $next = __('Next',TEXTDOMAIN), $pages=$blog->max_num_pages,array('class'=>'pull-left pagination-sm')); ?>
        <?php global  $wp_query; ?>
        <div class="result-count pull-right">
            <?php
            $paged    = max( 1, $wp_query->get( 'paged' ) );
            $first    = ( $per_page * $paged ) - $per_page + 1;
            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

            if ( 1 == $total ) {
                _e( 'Showing the single result', 'woocommerce' );
            } elseif ( $total <= $per_page || -1 == $per_page ) {
                printf( __( 'Showing all %d results', 'woocommerce' ), $total );
            } else {
                printf( _x( 'Showing %1$d–%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
            }
            ?>
        </div>
    </div>
<?php
}

/*
 *  Display list of navigations info with list of listin + total, info for woocommerce
 */
function wpo_woocommerce_custom_usermenutop() { ?>
    <ul class="setting-menu">
        <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                <?php _e('My Account',TEXTDOMAIN); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>">
                <?php _e('Checkout',TEXTDOMAIN); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
                <?php _e('Cart',TEXTDOMAIN); ?>
            </a>
        </li>
    </ul>
<?php }

/* ---------------------------------------------------------------------------
 * WooCommerce - Define image sizes
 * --------------------------------------------------------------------------- */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'wpo_woocommerce_image_dimensions', 1 );

function wpo_woocommerce_image_dimensions() {
	$catalog = array(
		'width' 	=> '200',	// px
		'height'	=> '200',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '500',	// px
		'height'	=> '500',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '75',	// px
		'height'	=> '65',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}


/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */
function wpo_woocommerce_query($type,$post_per_page=-1,$cat=''){
    global $woocommerce;
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish'
    );
    switch ($type) {
        case 'deals':
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            $args['meta_query'][] = array(
                'key' => '_sale_price_dates_to',
                'value' => '0',
                'compare' => '>');
            $args['post__in'] = woocommerce_get_product_ids_on_sale();
            break;
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts']=1;
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = array(
                'key' => '_featured',
                'value' => 'yes'
            );
            $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'top_rate':
            add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'recent_product':
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            break;
        case 'on_sale':
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'recent_review':
            if($number == -1) $_limit = 4;
            else $_limit = $number;
            global $wpdb;
            $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC LIMIT 0, ". $_limit;
            $results = $wpdb->get_results($query, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                $_pids[] = $re->comment_post_ID;
            }

            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            $args['post__in'] = $_pids;
            break;
    }

    if($cat!=''){
        $args['product_cat']= $cat;
    }
    return new WP_Query($args);
}



?>