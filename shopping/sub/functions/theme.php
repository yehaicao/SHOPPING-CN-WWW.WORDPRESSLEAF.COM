<?php

function wpo_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() ) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title = "$title $sep " . sprintf( __( 'Page %s', TEXTDOMAIN ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'wpo_wp_title', 10, 2 );

///// Define  list of function processing theme logics.
function wpo_vc_shortcode_render( $atts, $m='' , $tag='' ){
	$output = ''; 
	if(is_file( WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER. $tag.'.php')){
		ob_start();
		require( WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER.$tag.'.php' );
		$output .= ob_get_clean();
	}
	return $output;
}
/// // 
if(of_get_option('is-effect-scroll','1')=='1'){
    add_filter('body_class', 'wpo_animate_scroll');
    function wpo_animate_scroll($classes){
    $classes[] = 'wpo-animate-scroll';
        return $classes;
    }
}

function get_header_layout(){
    global $wp_query;
    $layout = get_post_meta($wp_query->get_queried_object_id(),'wpo_template',true);
    $layout = wp_parse_args( $layout, array(
        'header_skin'   => '1'
    ) );
    switch ($layout['header_skin']) {
        case '1':
            return of_get_option('header','');
        case '2':
            return '';
        case '3':
            return 'style2';
        case '4':
            return 'style3';
    }
}

if(!function_exists('shopping_cartdropdown')){
    function shopping_cartdropdown(){
        if(class_exists('WooCommerce')){
            global $woocommerce; ?>
            <div class="top-cart dropdown text-right">
                <i class="pull-right fa fa-shopping-cart"></i>
                <h3 class="wpo-shopping-cart">
                    <?php echo __('Shopping Cart',TEXTDOMAIN); ?>
                </h3>
                <a class="dropdown-toggle cart-contents" href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                    <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
                </a>
                <div class="dropdown-menu">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        <?php
        }
    }
}

if(!function_exists('shopping_pagination')){
	function shopping_pagination($per_page,$total,$max_num_pages=''){
		?>
		<div class="well small-padding clearfix">
	        <?php wpo_pagination($prev = __('Previous',TEXTDOMAIN), $next = __('Next',TEXTDOMAIN), $pages=$max_num_pages,array('class'=>'pull-left pagination-sm')); ?>
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
}
?>
<?php
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );

?>
<?php
add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);

function custom_get_availability( $availability, $_product ) {
    //change text "In Stock' to 'SPECIAL ORDER'
    if ( $_product->is_in_stock() ) $availability['availability'] = __('Availability: In Stock', 'woocommerce');
    //change text "Out of Stock' to 'SOLD OUT'
    if ( !$_product->is_in_stock() ) $availability['availability'] = __('Availability: Out of Stock', 'woocommerce');
    return $availability;
}

function shopping_product_title(){
?>
    <div class="name">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </div>
<?php
}
add_action('woocommerce_after_shop_loop_item_title','shopping_product_title',4);

if(!function_exists('shopping_searchform')){
    function shopping_searchform(){
        if(class_exists('WooCommerce')){
        	global $wpdb;
			$dropdown_args = array(
                'show_counts'        => false,
                'hierarchical'       => true,
                'show_uncategorized' => 0
            );
        ?>
			<form role="search" method="get" class="searchform-categoris" action="<?php echo home_url('/'); ?>">
	            <div class="wpo-search">
	                <div class="wpo-search-inner">
                        <div class="select-categories">
                            <?php wc_product_dropdown_categories( $dropdown_args ); ?>
                        </div>
                        <div class="input-group">
                            <input name="s" id="s" maxlength="40"
                                   class="form-control input-search" type="text" size="20"
                                   placeholder="Enter search...">
                            <span class="input-group-addon">
                                <input type="submit" id="searchsubmit" class="fa" value="&#xf002;"/>
                                <input type="hidden" name="post_type" value="product"/>
                            </span>
                        </div>
	                </div>
	            </div>
	        </form>
        <?php
        }else{
        	get_search_form();
        }
    }
}