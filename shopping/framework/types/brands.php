<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author     Opal  Team <opalwordpressl@gmail.com >
  * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.wpopal.com
  * @support  http://www.wpopal.com/support/forum.html
  */

if(!function_exists('wpo_create_type_brand')){
  function wpo_create_type_brand(){
    $labels = array(
      'name' => __( 'Brand', TEXTDOMAIN ),
      'singular_name' => __( 'Brand', TEXTDOMAIN ),
      'add_new' => __( 'Add New Brand', TEXTDOMAIN ),
      'add_new_item' => __( 'Add New Brand', TEXTDOMAIN ),
      'edit_item' => __( 'Edit Brand', TEXTDOMAIN ),
      'new_item' => __( 'New Brand', TEXTDOMAIN ),
      'view_item' => __( 'View Brand', TEXTDOMAIN ),
      'search_items' => __( 'Search Brands', TEXTDOMAIN ),
      'not_found' => __( 'No Brands found', TEXTDOMAIN ),
      'not_found_in_trash' => __( 'No Brands found in Trash', TEXTDOMAIN ),
      'parent_item_colon' => __( 'Parent Brand:', TEXTDOMAIN ),
      'menu_name' => __( 'Brands', TEXTDOMAIN ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Brand',
        'supports' => array( 'title', 'thumbnail' ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'brands', $args );
  }

  add_action('init','wpo_create_type_brand');
}