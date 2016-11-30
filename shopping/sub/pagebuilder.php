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
if (class_exists('WPO_PageBuilder_Base')) {
	class WPO_PageBuilder extends WPO_PageBuilder_Base{

		public function __construct(){
			parent::__construct();
			
			$this->loadThemeShortCode();
			
			//Edit Elements
			$this->elementTabItem();
			$this->elementButton();
			// $this->elementImageCarousel();
			$this->elementProgressBar();
			$this->elementMap();
			$this->elementColumn();
			// $this->elementRow();
			$this->elementTitle();

			// Set Template Folder
			// vc_set_template_dir(FRAMEWORK_TEMPLATES.'pagebuilder/');
		}
		
		private function loadThemeShortCode(){ 
			if( WPO_WOOCOMMERCE_ACTIVED ) {
				require_once( WPO_THEME_SUB_DIR.'vc_shortcodes/woocommerce.php');	
			}
			require_once( WPO_THEME_SUB_DIR.'vc_shortcodes/theme.php');		
		}
		
		private function elementTitle(){
			vc_add_param( 'vc_text_separator', array(
		         "type" => "textfield",
		         "heading" => $this->l("Icon"),
		         "param_name" => "icon",
		         "value" => '',
		         "description"=>"<a href='http://fortawesome.github.io/Font-Awesome/icons/'>follow that link to see more icon</a>" 
		    ));
		    vc_add_param( 'vc_text_separator', array(
		         "type" => "attach_image",
		         "heading" => $this->l("Icon Image"),
		         "param_name" => "icon_image"
		    ));
		    
			vc_add_param( 'vc_text_separator', array(
		         "type" => "textarea",
		         "heading" => $this->l("Description"),
		         "param_name" => "descript",
		         "value" => ''
		    ));

		    $this->deleteParam('vc_text_separator', array(
		    	'title_align',
		    	'color',
		    	'accent_color',
		    	'style',
		    	'el_width'
		    ));
		}

		private function elementRow(){
			vc_add_param( 'vc_row', array(
		         "type" => "checkbox",
		         "heading" => $this->l("Full Width"),
		         "param_name" => "fullwidth",
		         "value" => array(
		         				'Yes, please' => true
		         			)
		    ));

		    vc_add_param( 'vc_row', array(
		         "type" => "checkbox",
		         "heading" => $this->l("Parallax"),
		         "param_name" => "parallax",
		         "value" => array(
		         				'Yes, please' => true
		         			)
		    ));
		}

		private function elementColumn(){
			$add_css_animation = array(
				"type" => "dropdown",
				"heading" => __("CSS Animation", $this->textdomain),
				"param_name" => "css_animation",
				"admin_label" => true,
				"value" => $this->cssAnimation,
				"description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", $this->textdomain)
			);
			vc_add_param('vc_column',$add_css_animation);
			vc_add_param('vc_column_inner',$add_css_animation);
		}

		/**
		 * Google Map
		 */
		private function elementMap(){
			$param = WPBMap::getParam('vc_gmaps', 'title');
			$param['type'] = 'googlemap';
			$param['heading']='Position';
			$param['description']='';
			WPBMap::mutateParam('vc_gmaps', $param);

			$param = WPBMap::getParam('vc_gmaps', 'link');
			$param['type']='hidden';
			$param['value']='21.0173222,105.78405279999993';
			WPBMap::mutateParam('vc_gmaps', $param);

			$param = WPBMap::getParam('vc_gmaps', 'size');
			$param['value']=300;
			$param['description']='Enter map height in pixels. Example: 300.';
			WPBMap::mutateParam('vc_gmaps', $param);

			vc_add_param( 'vc_gmaps', array(
					"type" => "dropdown",
					"heading" => __("Map Type", $this->textdomain),
					"param_name" => "type",
					"value" => array(
								'roadmap'=>'ROADMAP',
								'hybrid'=>'HYBRID',
								'satellite'=>'SATELLITE',
								'terrain'=>'TERRAIN'
							),
					"admin_label" => true,
					"description" => __("Select Map Type.", $this->textdomain)
				)	
		    );

			$classparam = WPBMap::getParam('vc_gmaps', 'el_class');
			$this->deleteParam('vc_gmaps','el_class');

			vc_add_param( 'vc_gmaps', array(
		         "type" => "checkbox",
		         "heading" => $this->l("Remove Pan Control"),
		         "param_name" => "pancontrol",
		         "value" => array(
		         				 'Yes, please' => true
		         			)
		    ));

		    vc_add_param( 'vc_gmaps', array(
		         "type" => "checkbox",
		         "heading" => $this->l("Remove Zoom Control"),
		         "param_name" => "zoomcontrol",
		         "value" => array(
		         				 'Yes, please' => true
		         			)
		    ));

		    vc_add_param( 'vc_gmaps', array(
		         "type" => "checkbox",
		         "heading" => $this->l("Remove Maptype Control"),
		         "param_name" => "maptypecontrol",
		         "value" => array(
		         				'Yes, please' => true
		         			)
		    ));

		    vc_add_param( 'vc_gmaps', array(
		         "type" => "checkbox",
		         "heading" => $this->l("Remove Streets Control"),
		         "param_name" => "streetscontrol",
		         "value" => array(
		         				'Yes, please' => true
		         			)
		    ));

		    WPBMap::mutateParam('vc_gmaps', $classparam);
		}

		/**
		 * Tab Item
		 */
		private function elementTabItem(){
			vc_add_param( 'vc_tab', array(
		         "type" => "textfield",
		         "heading" => $this->l("Icon"),
		         "param_name" => "tabicon",
		         "value" => ''
		    ));
		}

		/**
		 * Button
		 */
		private function elementButton(){
			// color
			$param = WPBMap::getParam('vc_button', 'color');
			$param['value'] = array(
								'Default'=>'btn-default',
								'Primary'=>'btn-success',
								'Success'=>'btn-success',
								'Info'=>'btn-warning',
								'Danger'=>'btn-danger',
								'Link'=>'btn-link'
							);
			$param['heading']='Type';
			WPBMap::mutateParam('vc_button', $param);

			// icon
			$param = WPBMap::getParam('vc_button', 'icon');
			$param['type']='textfield';
			$param['value']='';
			WPBMap::mutateParam('vc_button', $param);

			// size
			$param = WPBMap::getParam('vc_button', 'size');
			$param['value']= array(
								'Default'=>'',
								'Large'=>'btn-lg',
								'Small'=>'btn-sm',
								'Extra small'=>'btn-xs'
							);
			WPBMap::mutateParam('vc_button', $param);
		}

		/**
		 * Image Carousel
		 */

		private function elementImageCarousel(){
			$this->deleteParam('vc_images_carousel',array(
														'img_size',
														'onclick',
														'mode',
														'slides_per_view',
														'wrap',
														'partial_view',
														'speed',
														'autoplay'
													));
		}

		/**
		 * Goole Map
		 */
		private function elementGoogleMap(){
			$this->deleteParam('vc_gmaps',array(
											'title',
											'link'
										));
		}

		private function elementProgressBar(){
			$this->deleteParam('vc_progress_bar',array(
											'title',
											'units',
											'bgcolor',
											'custombgcolor',
											'options'
										));
		}

	}

	add_action( 'init', 'wpo_init_pagebuilder' );
	function wpo_init_pagebuilder(){
		new WPO_PageBuilder();
	}

}