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
$template = new WPO_Template();
$config = $template->configLayout(of_get_option('single-layout','0-1-0'));

?>
<?php get_header( get_header_layout() ); ?>


<section id="wpo-mainbody" class="container wpo-mainbody">
    <?php wpo_breadcrumb(); ?>
    <div class="row">
        <!-- MAIN CONTENT -->
        <div id="wpo-content" class="wpo-content col-sm-12">
            <?php  if ( have_posts() ) : ?>
                    <div class="well large-padding post-area">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'templates/blog/blog'); ?>
                        <?php endwhile; ?>
                    </div>
                    <?php global $wp_query; ?>
                    <?php shopping_pagination($wp_query->query_vars['posts_per_page'],$wp_query->found_posts); ?>
            <?php else : ?>
                <?php get_template_part( 'templates/none' ); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>