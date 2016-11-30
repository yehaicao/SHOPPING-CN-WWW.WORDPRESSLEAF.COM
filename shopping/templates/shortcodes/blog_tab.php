<?php
/* $Desc
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

$add_class = (esc_attr($atts['class'])=='')?'':' '.esc_attr( $atts['class'] );
$sub_cats = get_categories( array('parent'=>$atts['category']) );

?>

<div id="tab-blog-<?php echo $atts['id']; ?>" data-toggle="blog-tab" class="rows tab-blog<?php echo $add_class; ?>">
	<div class="col-sm-3 category-child">
	<?php foreach($sub_cats as $key => $cat ){ ?>
	    <a data-item="#cat-<?php echo $cat->slug.'-'.$cat->term_id; ?>" href="<?php echo get_category_link( $cat->term_id ); ?>">
	    	<?php echo $cat->name; ?>
	    </a>
	<?php } ?>
	</div>
	<div class="col-sm-9 category-content">
		<?php foreach($sub_cats as $key => $cat ){ ?>
		<div id="cat-<?php echo $cat->slug.'-'.$cat->term_id; ?>" class="recent-item row">
			<?php
				wp_reset_query();
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3,
					'cat'=>$cat->term_id
				);
				$query = new WP_Query( $args );
				if($query->have_posts()){
					while($query->have_posts()):$query->the_post();
			?>
				<article class="col-sm-4">
					<?php
						if(has_post_thumbnail()){
					?>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'full' ); ?>
					</a>
					<?php } ?>
					<h6>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h6>
                    <div class="content">
                        <?php echo wpo_excerpt(12,'...'); ?>
                    </div>
                    <div class="entry-meta">
                        <span class="published"><?php the_time( 'M d, Y' ); ?></span>
                        <span class="meta-sep"> | </span>
                    <span class="comment-count">
                        <i class="fa fa-comments-o"></i>
                        <?php comments_popup_link(__(' 0 ', TEXTDOMAIN), __(' 1 ', TEXTDOMAIN), __(' % ', TEXTDOMAIN)); ?>
                    </span>
                    <span clas="post-views">
                        <i class="fa fa-eye"></i>
                        <?php echo wpo_get_post_views(get_the_ID());?>
                    </span>
                    </div><!--END.Etry-Meta-->
				</article>
			<?php
					endwhile;
				}
				wp_reset_postdata();
			?>
		</div>
		<?php } ?>
	</div>
</div>
