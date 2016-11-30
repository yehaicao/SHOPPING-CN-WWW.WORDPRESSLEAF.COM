<?php 

	$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
    $option_menu = array('---Select Menu---'=>'');
    foreach ($menus as $menu) {
    	$option_menu[$menu->name]=$menu->term_id;
    }
	vc_map( array(
	    "name" => __("WPO Vertical Menu",$this->textdomain),
	    "base" => "wpo_verticalmenu",
	    "class" => "",
	    "category" => $this->l('WPO Elements'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", $this->textdomain),
				"param_name" => "title",
				"value" => 'Vertical Menu'
			),
	    	array(
				"type" => "dropdown",
				"heading" => __("Menu", $this->textdomain),
				"param_name" => "menu",
				"value" => $option_menu,
				"admin_label" => true,
				"description" => __("Select menu.", $this->textdomain)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Position", $this->textdomain),
				"param_name" => "postion",
				"value" => array(
						'left'=>'left',
						'right'=>'right'
					),
				"admin_label" => true,
				"description" => __("Postion Menu Vertical.", $this->textdomain)
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", $this->textdomain),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", $this->textdomain)
			)
	   	)
	));
	add_shortcode( 'wpo_verticalmenu', ('wpo_vc_shortcode_render') );

	vc_map( array(
	    "name" => __("WPO Testimonials",$this->textdomain),
	    "base" => "wpo_testimonials",
	    "class" => "",
	    "category" => $this->l('WPO Elements'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", $this->textdomain),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", $this->textdomain),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", $this->textdomain)
			)
	   	)
	));
	add_shortcode( 'wpo_testimonials', ('wpo_vc_shortcode_render') );
	
	/*
	 *
	 */
	vc_map( array(
	    "name" => __("WPO Brands",$this->textdomain),
	    "base" => "wpo_brands",
	    "class" => "",
	    "category" => $this->l('WPO Elements'),
	    "params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Number of brands to show", $this->textdomain),
				"param_name" => "number",
				"value" => '6'
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon", $this->textdomain),
				"param_name" => "icon"
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", $this->textdomain),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", $this->textdomain)
			)
	   	)
	));
	add_shortcode( 'wpo_brands', ('wpo_vc_shortcode_render') );
?>