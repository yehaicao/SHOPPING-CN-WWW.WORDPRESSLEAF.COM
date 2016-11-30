<?php
    vc_map( array(
        "name" => __("WPO Product Deals",$this->textdomain),
        "base" => "wpo_product_deals",
        "class" => "",
        "category" => $this->l('WPO Elements'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => $this->l('Title'),
                "param_name" => "title",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", $this->textdomain),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", $this->textdomain)
            )
        )
    ));
    add_shortcode( 'wpo_product_deals', ('wpo_vc_shortcode_render') );
	/**
	 * wpo_productcategory
	 */
	global $wpdb;
	$sql = "SELECT a.name,a.slug,a.term_id FROM $wpdb->terms a JOIN  $wpdb->term_taxonomy b ON (a.term_id= b.term_id ) where b.count>0 and b.taxonomy = 'product_cat'";
	$results = $wpdb->get_results($sql);
	$value = array();
	foreach ($results as $vl) {
		$value[$vl->name] = $vl->slug;
	}
	vc_map( array(
	    "name" => __("WPO Product Category",$this->textdomain),
	    "base" => "wpo_productcategory",
	    "class" => "",
	    "category" => $this->l('WPO Elements'),
	    "params" => array(
	    	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => $this->l('Category'),
				"param_name" => "category",
				"value" =>$value,
				"admin_label" => true
			),
			array(
				"type" => "dropdown",
				"heading" => __("Style", $this->textdomain),
				"param_name" => "style",
				"value" => array('Grid'=>'grid','List'=>'list','Carousel'=>'carousel')
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show", $this->textdomain),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count", $this->textdomain),
				"param_name" => "columns_count",
				"value" => array(6 , 4, 3, 2, 1),
				"admin_label" => true,
				"description" => __("Select columns count.", $this->textdomain)
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
	add_shortcode( 'wpo_productcategory', ('wpo_vc_shortcode_render') );

	/**
	 * wpo_products
	 */
	vc_map( array(
	    "name" => __("WPO Products",$this->textdomain),
	    "base" => "wpo_products",
	    "class" => "",
	    "category" => $this->l('WPO Elements'),
	    "params" => array(
	    	array(
				"type" => "dropdown",
				"heading" => __("Type", $this->textdomain),
				"param_name" => "type",
				"value" => array('Best Selling'=>'best_selling','Featured Products'=>'featured_product','Top Rate'=>'top_rate','Recent Products'=>'recent_product','On Sale'=>'on_sale','Recent Review' => 'recent_review' ),
				"admin_label" => true,
				"description" => __("Select columns count.", $this->textdomain)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Style", $this->textdomain),
				"param_name" => "style",
				"value" => array('Grid'=>'grid','List'=>'list','Carousel'=>'carousel')
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show", $this->textdomain),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count", $this->textdomain),
				"param_name" => "columns_count",
				"value" => array(6 , 4, 3, 2, 1),
				"admin_label" => true,
				"description" => __("Select columns count.", $this->textdomain)
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
	add_shortcode( 'wpo_products', ('wpo_vc_shortcode_render')  );
?>