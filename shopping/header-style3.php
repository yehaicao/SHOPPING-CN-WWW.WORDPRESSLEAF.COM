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
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- OFF-CANVAS MENU SIDEBAR -->
<div id="wpo-off-canvas" class="wpo-off-canvas">
    <div class="wpo-off-canvas-body">
        <div class="wpo-off-canvas-header">
            <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <nav  class="navbar navbar-offcanvas navbar-static" role="navigation">
            <?php
            $args = array(  'theme_location' => 'mainmenu',
                'container_class' => 'navbar-collapse',
                'menu_class' => 'wpo-menu-top nav navbar-nav',
                'fallback_cb' => '',
                'menu_id' => 'main-menu-offcanvas',
                'walker' => new Wpo_Megamenu_Offcanvas()
            );
            wp_nav_menu($args);
            ?>
        </nav>
    </div>
</div>
<!-- //OFF-CANVAS MENU SIDEBAR -->
<?php global $woocommerce; ?>
<!-- START Wrapper -->
<div class="wpo-wrapper">
    <!-- Top bar -->
    <section class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-6 user-login">
                    <?php if( !is_user_logged_in() ){ ?>
                        <span class="hidden-xs"><?php echo __('Welcome visitor you can',TEXTDOMAIN); ?></span>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('login or register','woothemes'); ?>"><?php _e(' login or register ','woothemes'); ?></a>
                    <?php }else{ ?>
                        <?php $current_user = wp_get_current_user(); ?>
                        <span class="hidden-xs"><?php echo __('Welcome ',TEXTDOMAIN); ?><?php echo $current_user->display_name; ?> !</span>
                    <?php } ?>
                </div>
                <?php
                $args = array(
                    'theme_location' => 'topmenu',
                    'container_class' => 'col-sm-6 col-xs-6 top-menu hidden-sm hidden-xs',
                    'menu_class' => 'menu pull-right',
                    'fallback_cb' => '',
                    'menu_id' => ''
                );
                wp_nav_menu($args);
                ?>
                <div class="col-sm-6 col-xs-6 hidden-lg hidden-md ">
                    <ul class="col-sm-6 col-xs-6 hidden-lg hidden-md nav navbar-nav navbar-right dropdown-phone">
                        <li class="dropdown pull-right">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-user"></i> <b class="caret"></b></a>
                            <?php
                            $args = array(
                                'theme_location' => 'topmenu',
                                'container' => false,
                                'menu_class' => 'dropdown-menu',
                            );
                            wp_nav_menu($args);
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- // Topbar -->
    <!-- HEADER -->
    <header id="wpo-header" class="wpo-header">
        <div id="header-top" class="header-top">
            <div class="container">
                <div class="row">
                    <!-- LOGO -->
                    <div class="logo-in-theme col-md-3 col-sm-4 ">
                        <div class="logo">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo of_get_option('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        </div>
                    </div>

                    <div class=" col-md-6 col-sm-8 banner-header hidden-xs ">
                        <div class="inner">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo of_get_option('banner-top'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        </div>
                    </div>
                    <!-- Setting cart -->
                    <div class="col-md-3 shop-cart hidden-sm hidden-xs">
                        <?php shopping_cartdropdown(); ?>
                    </div>
                    <!-- Setting cart -->

                    <div class="modal fade" id="wpo_modal_cart" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-min-width">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <h4 class="modal-title"><?php echo __('Cart',TEXTDOMAIN); ?></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="hide_cart_widget_if_empty"><div class="widget_shopping_cart_content"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="header-bottom" class="header-bottom header-3">
            <div class="container">
                <div class="row no-margin">
                    <div class="header-bottom-inner">
                        <div class="header-menu col-md-9 col-sm-9 ">
                            <nav id="wpo-mainnav" data-duration="<?php echo of_get_option('megamenu-duration',400); ?>" class="wpo-megamenu <?php echo of_get_option('magemenu-animation','slide'); ?> animate navbar navbar-default" role="navigation">
                                <div class="navbar-header">
                                    <?php wpo_renderButtonToggle(); ?>
                                </div><!-- //END #navbar-header -->
                                <?php
                                $args = array(  'theme_location' => 'mainmenu',
                                    'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',
                                    'menu_class' => 'nav navbar-nav megamenu',
                                    'fallback_cb' => '',
                                    'menu_id' => 'main-menu',
                                    'walker' => new Wpo_Megamenu());
                                wp_nav_menu($args);
                                ?>
                            </nav>
                        </div>
                        <div class="search-form col-md-3 col-sm-3">
                            <div class="search-form-inner">
                                <?php
                                get_search_form();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- //HEADER -->