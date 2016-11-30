<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop,$wp_query;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);
$_count =1;
$products = new WP_Query( $args );

$columns_count = of_get_option('woo-number-columns',4);
$class_column = 'col-sm-3 col-md-' . 12/$columns_count;
$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="box upsells ">

		<h3 class="title-upsells">
            <i class="fa fa-briefcase"></i>
			<span><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></span>
		</h3>
		
		<div class="box-content">
			<div class="box-products slide" id="productcarouse-<?php echo $_id; ?>" data-ride="carousel">
				<?php if(of_get_option('woo-number-columns',4)!==of_get_option('woo-number-product','4')){ ?>
					<div class="carousel-controls">
						<a href="#productcarouse-<?php echo $_id; ?>" data-slide="prev">
							<span class="conner"><i class="fa fa-angle-left"></i></span>
						</a>
						<a href="#productcarouse-<?php echo $_id; ?>" data-slide="next">
							<span class="conner"><i class="fa fa-angle-right"></i></span>
						</a>
					</div>
				<?php } ?>
				<div class="carousel-inner products">
				<?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
					<?php //echo $products->found_posts; ?>
					<?php if( $_count%$columns_count == 1 ) echo '<div class="row item'.(($_count==1)?" active":"").'">'; ?>
						<!-- Product Item -->
						<div class="<?php echo $class_column ?>">
							<?php wc_get_template_part( 'content', 'product-inner' ); ?>
						</div>
						<!-- End Product Item -->

					<?php if( ($_count%$columns_count==0 && $_count!=1) || $_count== $products->post_count ) echo '</div>'; ?>
					<?php $_count++; ?>
				<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
