<?php
/**
 * Product Categories Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPO_Widget_Product_Categories extends WC_Widget_Product_Categories {

	
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		global $wp_query, $post, $woocommerce;

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$c     = ( isset( $instance['count'] ) && $instance['count'] ) ? '1' : '0';
		$h     = $instance['hierarchical'] ? true : false;
		$s     = ( isset( $instance['show_children_only'] ) && $instance['show_children_only'] ) ? '1' : '0';
		$d     = ( isset( $instance['dropdown'] ) && $instance['dropdown'] ) ? '1' : '0';
		$o     = $instance['orderby'] ? $instance['orderby'] : 'order';

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		
		$dropdown_args = array();
		$cat_args = array( 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'product_cat' );

		// Menu Order
		$cat_args['menu_order'] = false;
		if ( $o == 'order' ) {
			$cat_args['menu_order'] = 'asc';
		} else {
			$cat_args['orderby']    = 'title';
		}
		
		// Setup Current Category
		$this->current_cat   = false;
		$this->cat_ancestors = array();

		if ( is_tax('product_cat') ) {

			$this->current_cat   = $wp_query->queried_object;
			$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

		} elseif ( is_singular('product') ) {

			$product_category = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent' ) );

			if ( $product_category ) {
				$this->current_cat   = end( $product_category );
				$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
			}

		}
		
		// Show Siblings and Children Only
		if ( $s && $this->current_cat ) {

			// Top level is needed
			//$top_level = get_terms( 'product_cat', array( 'fields' => 'ids', 'parent' => 0, 'hierarchical' => false, 'hide_empty' => false ) );

			// Direct children are wanted
			$direct_children = get_terms( 'product_cat', array( 'fields' => 'ids', 'parent' => $this->current_cat->term_id, 'hierarchical' => true, 'hide_empty' => false ) );
			
			// Gather siblings of ancestors
			$siblings  = array();
			if ( $this->cat_ancestors ) {
				foreach ( $this->cat_ancestors as $ancestor ) {
					$siblings = array_merge( $siblings, get_terms( 'product_cat', array( 'fields' => 'ids', 'parent' => $ancestor, 'hierarchical' => false, 'hide_empty' => false ) ) );
				}
			}

			$include                  = array_merge( $this->cat_ancestors, $siblings, $direct_children );
			
			$dropdown_args['include'] = implode( ',', $include );
			$cat_args['include']      = implode( ',', $include );
			
		} elseif ( $s ) {
			$chidrens = array();
			$top_level = get_terms( 'product_cat', array( 'fields' => 'ids', 'parent' => 0, 'hierarchical' => false, 'hide_empty' => false ) );
			foreach($top_level as $cat_parent){
				$chidrens = array_merge( $chidrens, get_terms( 'product_cat', array( 'fields' => 'ids', 'parent' => $cat_parent, 'hierarchical' => true, 'hide_empty' => false ) ));
			}
			$dropdown_args['depth']    = 1;
			$dropdown_args['child_of'] = 0;
			$cat_args['depth']         = 1;
			$cat_args['child_of']      = 0;
			$cat_args['include']      = implode( ',', $chidrens );
			$dropdown_args['include'] = implode( ',', $chidrens );
		}

		// Dropdown
		if ( $d ) {

			$dropdown_defaults = array(
				'show_counts'        => $c,
				'hierarchical'       => $h,
				'show_uncategorized' => 0,
				'orderby'            => $o,
				'selected'           => $this->current_cat ? $this->current_cat->slug : ''
			);
			$dropdown_args = wp_parse_args( $dropdown_args, $dropdown_defaults );

			// Stuck with this until a fix for http://core.trac.wordpress.org/ticket/13258
			wc_product_dropdown_categories( $dropdown_args );
			?>
			<script type='text/javascript'>
				/* <![CDATA[ */
				var product_cat_dropdown = document.getElementById("dropdown_product_cat");
				function onProductCatChange() {
					if ( product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value !=='' ) {
						location.href = "<?php echo home_url(); ?>/?product_cat="+product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value;
					}
				}
				product_cat_dropdown.onchange = onProductCatChange;
				/* ]]> */
			</script>
			<?php

		// List
		} else {

			include_once( get_template_directory().'/woocommerce/walkers/product-cat-list.php' );

			$cat_args['walker']                     = new WPO_Product_Cat_List_Walker;
			$cat_args['title_li']                   = '';
			$cat_args['pad_counts']                 = 1;
			$cat_args['show_option_none']           = __('No product categories exist.', 'woocommerce' );
			$cat_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
			$cat_args['current_category_ancestors'] = $this->cat_ancestors;

			echo '<ul class="product-categories highlighted">';

			wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $cat_args ) );

			echo '</ul>';
		}

		echo $after_widget;
	}
}

register_widget( 'WPO_Widget_Product_Categories' );
