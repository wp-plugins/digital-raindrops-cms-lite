<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* Templte Creation Functions */
function cms_create_template(){
	$ContentArea = cms_get_settings('content_layout_name').' ';
	$ContentWidth = cms_get_settings('content_layout_width').' ';
	$SideBarCount = cms_get_settings('sidebar_count');
	$ContentCount = cms_get_settings('content_count');
	$OptionsCount = cms_get_settings('option_count');
	$SidebarName[0]="";
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$cmscontenfile = 'cmssidebar'.$counter.'file';
		$cmscontendiv = 'cmssidebar'.$counter.'div';
		if (cms_get_settings($cmscontenfile)) {
			$SidebarName[$counter] = cms_get_settings($cmscontendiv);
		} else {
			$SidebarName[$counter] = 'cms-sidebar'.$counter;
		}
	}

	$string2 = "";
	if (cms_get_settings('template_name')) {
	$string2 = $string2 .'<?php'."\n".'/*'."\n".'Template Name: '.cms_get_settings('template_name')."\n".'*/'."\n".'?>'."\n";
	}
	$string2 = $string2 .'<?php get_header(); ?>'."\n";
	$string2 = $string2 .'<div class="'.cms_get_settings('content_layout_name').'">'."\n";
	$SideBarCount = cms_get_settings('sidebar_count');
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$ItemID = 'cmssidebar'.$counter.'left';
		$contentactive = 'cmssidebar'.$counter.'order';
		$ItemFile = 'cmssidebar'.$counter.'file';
   		if (cms_get_settings($ItemID) && cms_get_settings($contentactive)) {
			if (cms_get_settings($ItemFile)){
				$ItemFileName = "  <?php include (TEMPLATEPATH. '/'";
				$ItemFileName = $ItemFileName .cms_get_settings($ItemFile)."'); ?>";
				$string2 = $string2 .$ItemFileName."\n";
			}else{
				$ItemFileName = "  <?php include (TEMPLATEPATH. '/cms_inc/cmssidebar";
				$ItemFileName = $ItemFileName .$counter.".php'); ?>";
				$string2 = $string2 .$ItemFileName."\n";
			}
		}
	}

	$string2 = $string2 .'   <div class="'.cms_get_settings('template_inner').'">'."\n";
	
	$IncludeInner[]="";
	$ContentCount = cms_get_settings('content_count');	
	for ( $counter = 1; $counter <= $ContentCount; $counter += 1) {
		$ItemID = 'content'.$counter;
		$contentactive = 'content'.$counter.'order';
		$Order = cms_get_settings($contentactive);
   		if (cms_get_settings($ItemID) && $Order) {
			$ItemFileName = '      <?php include (TEMPLATEPATH. '."'/cms_inc/content";
			$ItemFileName = $ItemFileName .$counter.".php'); ?>";
		$IncludeInner['order'.$Order]=$ItemFileName;	
		}	
	}
	$OptionCount = cms_get_settings('option_count');	
	for ( $counter = 1; $counter <= $OptionCount; $counter += 1) {
		$ItemID = 'option'.$counter;
		$contentactive = 'option'.$counter.'order';
		$Order = cms_get_settings($contentactive);
   		if (cms_get_settings($ItemID) && $Order) {
			$ItemFileName = '      <?php include (TEMPLATEPATH. '."'/cms_inc/option";
			$ItemFileName = $ItemFileName .$counter.".php'); ?>";
		$IncludeInner['order'.$Order]=$ItemFileName;	
		}	
	}
	ksort($IncludeInner);
	foreach($IncludeInner as $key => $value)
	{
	if ($value){
			$string2 = $string2 .$value ."\n";
		}
	}

	$string2 = $string2 .'  </div>'."\n";
	
	$SideBarCount = cms_get_settings('sidebar_count');
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$ItemID = 'cmssidebar'.$counter.'left';
		$contentactive = 'cmssidebar'.$counter.'order';
		$ItemFile = 'cmssidebar'.$counter.'file';
   		if (!cms_get_settings($ItemID) && cms_get_settings($contentactive)) {
			if (cms_get_settings($ItemFile)){
				$ItemFileName = "  <?php include (TEMPLATEPATH. '/";
				$ItemFileName = $ItemFileName .cms_get_settings($ItemFile)."'); ?>";
				$string2 = $string2 .$ItemFileName."\n";
			}else{
				$ItemFileName = "  <?php include (TEMPLATEPATH. '/cms_inc/cmssidebar";
				$ItemFileName = $ItemFileName .$counter.".php'); ?>";
				$string2 = $string2 .$ItemFileName."\n";
			}
		}
	}
	$string2 = $string2 .'</div>'."\n";
	$string2 = $string2 .'<?php get_footer() ?>'."\n";
	return $string2;
}

?>