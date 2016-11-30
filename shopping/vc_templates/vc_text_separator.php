<?php
$output = $title = $title_align = $el_class = '';
extract(shortcode_atts(array(
    'title' => __("Title", "js_composer"),
    'el_class' => '',
    'descript' => '',
    'icon' =>'',
    'icon_image'=>''
), $atts));
$el_class = $this->getExtraClass($el_class);
$link_img ='';
if($icon_image!=''){
	$link_img = wp_get_attachment_image_src($icon_image,'full');
}

?>

<h3 class="title-header<?php echo $el_class; ?>">
	
	<?php if($icon!=''){
			echo '<span class="icon"><i class="fa '.$icon.'"  alt=""></i></span>';
		}else if($link_img!=''){
			echo '<span class="icon"><img src="'.$link_img[0].'"  alt=""></span>';
		} 
	?>
	
	<span><?php echo $title; ?></span>
</h3>
<?php if(trim($descript)!=''){ ?>
	<div class="descript">
		<?php echo $descript; ?>
	</div>
<?php } ?>
