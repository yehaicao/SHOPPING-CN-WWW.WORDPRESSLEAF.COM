<div class="widget_deals_products">
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


    extract( shortcode_atts( array(
        'title'=>'',
    ), $atts ) );

    $deals = array();
    $p_deals = wpo_woocommerce_query('deals')->posts;
    $_id = wpo_makeid();

    foreach($p_deals as $product){
        $date_sale = get_post_meta( $product->ID, '_sale_price_dates_to', true );
        if( $date_sale > time() )
            $deals[] = $product;
    }
    
    $_total = count($deals);

    if( $deals && $_total > 0 ) {
        if($title!=''){ ?>
            <h3 class="widget-title">
                <span><?php echo $title; ?></span>
            </h3>
        <?php } ?>
        <div class="woocommerce widget woo-deals">
            <div class="widget-content widget-products slide" id="productcarouse-<?php echo $_id; ?>" data-ride="carousel">
                <?php if( $_total > 1 ) { ?>
                    <div class="carousel-controls pull-right">
                        <a class="prev" href="#productcarouse-<?php echo $_id; ?>" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="next" href="#productcarouse-<?php echo $_id; ?>" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                <?php } ?>
                <div class="carousel-inner">
                    <?php $_count = 0; ?>
                    <?php foreach($deals as $key=>$id ){
                        $product = new WC_Product( $id );
                        $time_sale = get_post_meta( $product->id, '_sale_price_dates_to', true );
                    ?>
                        <div class="item<?php echo ($key==0) ? ' active':''; ?>">
                            <div class="product-block product">
                                <div class="product-image">
                                    <?php echo $product->get_image('shop_catalog_image_size'); ?>
                                </div>

                                <div class="product-meta">
                                    <div class="name">
                                        <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo $product->get_title(); ?></a>
                                    </div>
                                    <div class="rating clearfix ">
                                        <?php if ( $rating_html = $product->get_rating_html() ) { ?>
                                            <div><?php echo $rating_html; ?></div>
                                        <?php }else{ ?>
                                            <div class="star-rating"></div>
                                        <?php } ?>
                                    </div>
                                    <div class="price"><?php echo $product->get_price_html(); ?></div>
                                </div>
                            </div>
                            <div class="pts-countdown clearfix" data-countdown="countdown"
                                 data-date="<?php echo date('m',$time_sale).'-'.date('d',$time_sale).'-'.date('Y',$time_sale).'-'. date('H',$time_sale) . '-' . date('i',$time_sale) . '-' .  date('s',$time_sale) ; ?>">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php wp_reset_query(); ?>
</div>