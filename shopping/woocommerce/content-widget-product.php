<?php global $product; ?>
<div class="media">
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>" class="pull-left">
		<?php echo $product->get_image(); ?>		
	</a>
	<div class="media-body product-meta">
        <div class="name">
            <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo $product->get_title(); ?></a>
        </div>
        <div class="rating clearfix">
            <?php if ( $rating_html = $product->get_rating_html() ) { ?>
                <div class="pull-left"><?php echo $rating_html; ?></div>
            <?php }else{ ?>
                <div class="star-rating pull-left"></div>
            <?php } ?>
        </div>
		<div class="price"><?php echo $product->get_price_html(); ?></div>
	</div>	
</div>