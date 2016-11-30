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
	'title'=>'Testimonials',
	'el_class' => ''
), $atts ) );

$_id = wpo_makeid();
$_count = 0;
$args = array(
	'post_type' => 'testimonial',
	'posts_per_page' => -1,
	'post_status' => 'publish'
);

$query = new WP_Query($args);
?>
<div class="wpo-testimonial">
    <div class="wpo-testimonial-inner">
        <?php if($query->have_posts()){ ?>
            <div id="carousel-<?php echo $_id; ?>" class="box-content carousel slide" data-ride="carousel">
                <div class="carousel-controls">
                    <a class="prev" href="#carousel-<?php echo $_id; ?>" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="next" href="#carousel-<?php echo $_id; ?>" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

                <div class="carousel-inner testimonial-carousel">
                    <?php while($query->have_posts()):$query->the_post(); ?>
                        <?php
                        $meta = get_post_meta(get_the_ID(), 'wpo_testimonial', TRUE);
                        $address = '';
                        if(isset($meta['address'])) $address = $meta['address'];
                        ?>
                        <div class="item<?php echo ($_count==0)?' active':''; ?>">
                            <?php if(has_post_thumbnail()){ ?>
                                <div class="testimonial-avatar pull-left">
                                    <?php the_post_thumbnail('blog-thumbnails'); ?>
                                </div>
                            <?php } ?>
                            <div class="testimonial-profile">
                                <div class="content">
                                    <i class="fa fa-quote-left fa-fw"></i>
                                    <?php echo strip_tags(get_the_content()); ?>
                                    <i class="fa fa-quote-right fa-fw"></i>
                                </div>
                            </div>
                            <p class="author"><span class="name"><?php the_title(); ?></span> <?php echo $address; ?></p>
                        </div>
                        <?php $_count++; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php wp_reset_query(); ?>