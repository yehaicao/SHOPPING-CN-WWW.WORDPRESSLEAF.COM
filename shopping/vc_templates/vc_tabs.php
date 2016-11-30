<?php
global $wpo_tab_item;
$wpo_tab_item = array();
$output = $title = $interval = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => ''
), $atts));
$_id = wpo_makeid();
wpb_js_remove_wpautop($content);
$el_class = $this->getExtraClass($el_class);
$element = 'tabs-top';
if ( 'vc_tour' == $this->shortcode) $element = 'tabs-left';
?>

<section class="tour-tab tabbable <?php echo $element; ?><?php echo $el_class; ?> box">
	<ul class="nav nav-tabs">
		<?php foreach($wpo_tab_item as $key=>$tab){
                $class = 'pull-left';
            ?>
			<li <?php echo ($key==0)?' class="'.$class.' active"':'class="'.$class.'"'; ?>>
				<a href="#tab-<?php echo $tab['tab-id']; ?>" data-toggle="tab">
					<?php if($tab['tabicon']!=''){ ?>
						<icon class="<?php echo $tab['tabicon']; ?>"></icon>
					<?php } ?>
					<?php echo $tab['title']; ?>
				</a>
			</li>
		<?php } ?>
	</ul>

	<div class="tab-content">
		<?php foreach($wpo_tab_item as $key=>$tab){ ?>
			<div class="fade tab-pane<?php echo ($key==0)?' active in':''; ?>" id="tab-<?php echo $tab['tab-id']; ?>">
				<?php echo $tab['content']; ?>
			</div>
		<?php } ?>
	</div>
</section>