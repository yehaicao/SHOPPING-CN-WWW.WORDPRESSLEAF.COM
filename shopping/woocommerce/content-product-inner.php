<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
global $product;
?>
<div class="product-block product ">
	<div class="product-image">
        <?php if(of_get_option('is-quickview',true)){ ?>
            <div class="quick-view ">
                <a href="#" class="bt-view btn btn-quickview quickview"
                   data-productslug="<?php echo $product->post->post_name; ?>"
                   data-toggle="modal"
                   data-target="#wpo_modal_quickview"
                    >
                    <span><?php echo __('<i class="fa fa-plus"></i>',TEXTDOMAIN); ?></span>
                </a>
            </div>
        <?php } ?>
		<div class="image">
            <a href="<?php the_permalink(); ?>">
                <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );

                ?>
    		</a>
		</div>
	</div>
    <div class="button-groups">

        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        <?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
            <?php
            $action_add = 'yith-woocompare-add-product';
            $url_args = array(
                'action' => $action_add,
                'id' => $product->id
            );
            ?>
            <div class="wpo-compare">
                <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>"
                   class="btn btn-compare"
                   data-product_id="<?php echo $product->id; ?>">
                    <i class="fa fa-copy"></i>
                    <span><?php echo __('add to compare',TEXTDOMAIN); ?></span>
                </a>
            </div>
        <?php } ?>
        <?php if( class_exists( 'YITH_WCWL' ) ) { ?>
            <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
        <?php } ?>
    </div>
	<div class="product-meta">

		<?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
	</div>
</div>