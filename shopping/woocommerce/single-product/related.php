<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( 6 );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> of_get_option('woo-number-product','4'),
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array( $product->id )
) );
$_id = wpo_makeid();
$_count =1;
$products = new WP_Query( $args );

$columns_count = of_get_option('woo-number-columns',4);
$class_column = 'col-sm-3 col-md-' . 12/$columns_count;

if ( $products->have_posts() ) : ?>

	<div class="box related ">

		<h3 class="title-related">
            <i class="fa fa-briefcase"></i>
			<span><?php _e( 'Related Products', 'woocommerce' ); ?></span>
		</h3>
		
		<div class="box-content">
			<div class="box-products slide" id="productcarouse-<?php echo $_id; ?>">
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
