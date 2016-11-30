<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
extract(shortcode_atts(array(
    'title' => '',
    'grid_columns_count' => 2,
    'grid_teasers_count' => 8,
    'grid_layout' => 'title,thumbnail,text', // title_thumbnail_text, thumbnail_title_text, thumbnail_text, thumbnail_title, thumbnail, title_text
    'grid_link_target' => '_self',
    'filter' => '', //grid,
    'grid_thumb_size' => 'thumbnail',
    'grid_layout_mode' => 'fitRows',
    'el_class' => '',
    'teaser_width' => '12',
    'orderby' => NULL,
    'order' => 'DESC',
    'loop' => '',
), $atts));
if(empty($loop)) return;
$this->getLoop($loop);
$my_query = $this->query;
$args = $this->loop_args;
$teaser_blocks = vc_sorted_list_parse_value($grid_layout);

$columgrid = 12/$grid_columns_count;

?>

<section class="box recent-blog<?php echo (($el_class!='')?' '.$el_class:''); ?>">
    <div class="box-heading">
        <i class="fa fa-pencil"></i>
        <span><?php echo $title; ?></span>
    </div>
    <div class="box-content">
        <div class="row">
            <?php while ( $my_query->have_posts() ): $my_query->the_post(); ?>
            <div class="col-sm-<?php echo $columgrid; ?> col-md-<?php echo $columgrid; ?>">
                <div class="well no-margin">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <a href="<?php the_permalink(); ?>" title="">
                                <?php the_post_thumbnail('blog-thumbnails');?>
                            </a>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="blog-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <div class="blog-description"><?php echo wpo_excerpt(15,'...');; ?></div>
                            <p class="entry-meta">
                                <span class="published"><?php the_time( 'M d, Y' ); ?></span>
                                <span class="meta-sep"> | </span>
                                <span class="comment-count">
                                    <?php comments_popup_link(__(' 0 comment', TEXTDOMAIN), __(' 1 comment', TEXTDOMAIN), __(' % comments', TEXTDOMAIN)); ?>
                                </span>
                                <?php /*
                                <span class="meta-sep"> | </span>
                                <span class="author-link"><?php the_author_posts_link(); ?></span>
                                <?php if(is_tag()): ?>
                                <span class="meta-sep"> | </span>
                                <span class="tag-link"><?php the_tags('Tags: ',', '); ?></span>
                                <?php endif; ?>
                                */ ?>
                            </p>
                            <p class="readmore">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-theme-default btn-readmore">
                                    <span><?php echo __( 'read more',TEXTDOMAIN ); ?></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
wp_reset_query();