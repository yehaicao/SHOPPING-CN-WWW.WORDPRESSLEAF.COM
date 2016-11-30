<?php 

$wpo = new WPO_SubTheme();

$protocol = is_ssl() ? 'https:' : 'http:';

/* add  post types support as default */
$wpo->addThemeSupport( 'post-formats',  array( 'link', 'gallery', 'image' , 'video' , 'audio' ) );

// Add size image
$wpo->addImagesSize('blog-thumbnail',190,190,true);
$wpo->addImagesSize('brand-logo',160,80,true);
$wpo->addImagesSize('category-image',873,220,true);
$wpo->addImagesSize('image-blog',753,310,true);

// Add Menus
$wpo->addMenu('mainmenu','Main Menu');
$wpo->addMenu('topmenu','Top Header Menu');
//$wpo->addThemeSupport( 'post-formats',  array( 'aside', 'link' , 'quote', 'image' ) );


// AddScript
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );
$wpo->addScript('countdown_js',WPO_THEME_URI.'/js/countdown.js',array(),false,true);
$wpo->addScript('main_js',get_template_directory_uri().'/js/main.js',array(),false,true);

// Add Google Font
$wpo->addStyle('theme-montserrat-font',$protocol.'//fonts.googleapis.com/css?family=Montserrat:400,700');
$wpo->addStyle('theme-lato-font',$protocol.'//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic');
$wpo->init();