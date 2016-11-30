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
    'category' => '',
    'number'=>-1,
    'columns_count'=>'4',
    'icon' => '',
    'el_class' => '',
    'style' => 'grid'
), $atts ) );
// echo $atts['columns_count'];
// die;
switch ($columns_count) {
    case '4':
        $class_column='col-sm-3 col-md-3';
        break;
    case '3':
        $class_column='col-md-4 col-sm-4';
        break;
    case '2':
        $class_column='col-sm-6';
        break;
    case '6':
        $class_column='col-md-2 col-sm-4';
        break;
    default:
        $class_column='col-sm-12';
        break;
}
$_id = wpo_makeid();
if($category=='') return;
$_count = 1;
$args = array(
    'post_type' => 'product',
    'posts_per_page' => $number,
    'product_cat' => $category,
    'post_status' => 'publish'
);

$loop = new WP_Query( $args );
if ( $loop->have_posts() ) : ?>
    <?php $_total = $loop->found_posts; ?>
    <div class="woocommerce clearfix<?php echo (($el_class!='')?' '.$el_class:''); ?>">
            <?php if($style=='carousel'){ ?>
            <div class="box-content carousel">
                <div class="box-products slide" id="productcarouse-<?php echo $_id; ?>">
                    <?php if($number>$columns_count && $_total>$columns_count){ ?>
                        <div class="carousel-controls">
                            <a class="prev" href="#productcarouse-<?php echo $_id; ?>" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="next" href="#productcarouse-<?php echo $_id; ?>" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="carousel-inner">
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                            <?php if( $_count%$columns_count == 1 ) echo '<div class="list-product item'.(($_count==1)?" active":"").'">'; ?>
                                
                            <!-- Product Item -->
                            <div class="no-padding <?php echo $class_column ?>">
                                <?php wc_get_template_part( 'content', 'product-inner' ); ?>
                            </div>
                            <!-- End Product Item -->

                            <?php if( ($_count%$columns_count==0 && $_count!=1) || $_count== $number || $_count==$_total ) echo '</div>'; ?>
                            <?php $_count++; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <?php }else if($style=='list'){ ?>
                <div class="product_list_widget list">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                        <?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) ); ?>
                    <?php endwhile; ?>
                </div>
            <?php }else{ ?>
                <div class="box-content grid">
                    <div class="list-product ">
                        <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                            <!-- Product Item -->
                            <div class="no-padding <?php echo $class_column ?>">
                                <?php wc_get_template_part( 'content', 'product-inner' ); ?>
                            </div>
                            <!-- End Product Item -->
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php } ?>

    </div>
<?php endif; ?>

<?php wp_reset_query(); ?>