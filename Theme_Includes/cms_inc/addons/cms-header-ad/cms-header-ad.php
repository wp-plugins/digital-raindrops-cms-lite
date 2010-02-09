<?php 
/* update your ad here between ' ' */
$cmsmyadtext = 'add your Ad code Here';

$cmsadtext = get_option('cms_banner_ad_text');
if ($cmsadtext != $cmsmyadtext) update_option('cms_banner_ad_text',$cmsmyadtext);

if(get_option('cms_banner_ad_text')){ ?>
	<div id="cms-header-ad">
		<?php echo stripslashes(get_option('cms_banner_ad_text')); ?>
	</div>
<?php } ?>
