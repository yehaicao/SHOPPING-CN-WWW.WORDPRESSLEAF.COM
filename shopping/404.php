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
 * @website  http:/wpopal.com
 * @support  http://wpopal.com
 */
?>

<?php get_header( get_header_layout() ); ?>

<section class="container">
	<div class="page_not_found text-center clearfix">
		<h1 class="title-page">
			<?php echo __('page not found',TEXTDOMAIN); ?>		
		</h1>
		<div class="bigtext-error">404</div>
		<div class="col-sm-6 col-sm-offset-3">
			<div class="bigtext">
                <?php echo of_get_option('404','Can\'t find what you need? Take a moment and do a search below!'); ?>
			</div>
			<?php get_search_form(); ?>
		</div>
	</div>
</section>

<?php get_footer( ); ?>