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
		<footer id="wpo-footer" class="wpo-footer">
            <section class="newsletter ">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="inner">
                                <?php dynamic_sidebar('newsletter'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			<section class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <div class="inner">
                                <?php dynamic_sidebar('footer-1'); ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="inner">
                                <?php dynamic_sidebar('footer-2'); ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="inner">
                                <?php dynamic_sidebar('footer-3'); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="inner">
                                <?php dynamic_sidebar('footer-4'); ?>
                            </div>
                        </div>
                    </div>
                </div>
			</section>

			<section class="wpo-copyright">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 copyright">
							<address class="wpo-add">
								<?php echo of_get_option('copyright','Copyright 2014 Powered by <a href="http://themeforest.net/user/Opal_WP/?ref=dancof">Opal Team</a> All Rights Reserved.').'   Logger中文版由<a rel="nofollow" target="_blank" href="http://themostspecialname.com">NAME</a> <a rel="nofollow" target="_blank" href="http://www.wordpressleaf.com">LEAF</a>联合出品'; ?>
							</address>
                            <?php 
                                $img_footer = of_get_option('image-footer','');
                                if($img_footer!=''){
                            ?>
							<div class="paypal">
								<img src="<?php echo $img_footer; ?>" alt="img-footer" />
							</div>
                            <?php } ?>
						</div>
					</div>
				</div>
			</section>
		</footer>
	</div>
	<!-- END Wrapper -->
	<?php wp_footer(); ?>
</body>
</html>
