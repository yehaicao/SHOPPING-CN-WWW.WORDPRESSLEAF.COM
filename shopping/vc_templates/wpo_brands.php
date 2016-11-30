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
	'title' => '',
	'icon'=>'',
	'el_class'=>''
), $atts ) );

$_id = wpo_makeid();
$args = array(
	'post_type' => 'brands',
	'posts_per_page'=>-1
);
$loop = new WP_Query($args);

if ( $loop->have_posts() ) : ?>
<?php
	$_count = 1;
	$columns_count=6;
	$_total = $loop->found_posts;
?>
	<section class="wpo-brands <?php echo (($el_class!='')?' '.$el_class:''); ?>">
		<div class="box-content">
			<div class=" no-margin slide" id="productcarouse-<?php echo $_id; ?>" data-ride="carousel">
				<?php if($_total>$columns_count){ ?>
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
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    	<?php 
							$meta = get_post_meta(get_the_ID(),'wpo_brand',true);
							$meta = wp_parse_args( $meta, array(
						        'link'   => '#'
						    ));
                    	?>
                        <?php if( $_count%$columns_count == 1 ) echo '<div class="item'.(($_count==1)?" active":"").'"><div class="row">'; ?>
                        <!-- Product Item -->
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="item-detail hover-border">
                                <div class="item-inner hover-border-inner">
                                    <a href="<?php echo $meta['link']; ?>"><?php the_post_thumbnail( 'brand-logo' ); ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Product Item -->
                        <?php if( ($_count%$columns_count==0 && $_count!=1) || $_count==$_total ) echo '</div></div>'; ?>
                        <?php $_count++; ?>
                    <?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>