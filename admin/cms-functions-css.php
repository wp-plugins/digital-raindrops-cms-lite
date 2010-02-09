<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* Create the Style Sheet */
function cms_create_css(){
	/* Name the Sidebars into a variable to use later */
	$ContentArea = '.' .cms_get_settings('content_layout_name').' ';
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

	$cmsBlock = '{'."\n";
	$cmsBlock = $cmsBlock .'  position: relative;'."\n";
	$cmsBlock = $cmsBlock .'  margin: 0px;'."\n";
	$cmsBlock = $cmsBlock .'  padding: 0;'."\n";
	$cmsBlock = $cmsBlock .'  border: 0;'."\n";
	$cmsBlock = $cmsBlock .'  float: left;'."\n";
	$cmsBlock = $cmsBlock .'  overflow: hidden;'."\n";
	$cmsBlock = $cmsBlock .'  width: ';
	$cmsBlockClose = '}'."\n"."\n";

	$cmsInnerBlock = '{'."\n";
	$cmsInnerBlock = $cmsInnerBlock .'  margin: 0px;'."\n";
	$cmsInnerBlock = $cmsInnerBlock .'  padding: 0;'."\n";
	$cmsInnerBlock = $cmsInnerBlock .'  border: 0;'."\n";
	$cmsInnerBlock = $cmsInnerBlock .'  float: left;'."\n";

	$string = '/* Start with any left sidebars */'."\n";
	
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$contentleft = 'cmssidebar'.$counter.'left';
		$ItemFile = 'cmssidebar'.$counter.'file';
		$ItemWidthID = 'cmssidebar'.$counter.'width';
		$ItemWidth = cms_get_settings($ItemWidthID);
   		if (cms_get_settings($contentleft)) {
			if (!cms_get_settings($ItemFile)) {
				$string = $string .'/* Left Sidebar '.$counter.' layout */'."\n";	
				$string = $string .'.'.$SidebarName[$counter] ."\n";
				$string = $string .$cmsBlock .$ItemWidth.'px;'."\n" .$cmsBlockClose;
			}
		} 
	}


	$string = $string .'/* Start the Single Sidebar Layouts */'."\n";
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$ItemID = '.cms-templateInner'.$counter;
		$ItemWidth = 'cms-templateInner'.$counter;
		$ItemValue = cms_get_settings($ItemWidth);
		$string = $string .$ContentArea .$ItemID."\n";
		$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;
		for ( $counter3 = 1; $counter3 <= $SideBarCount; $counter3 += 1) {
			$ItemID2 = 'cmssidebar'.$counter3;	
			$ItemWidth = $ItemID2 .'outer';
			$ItemID2 = 'sidebar'.$counter3;
			$ItemValue = cms_get_settings($ItemWidth);
			$string = $string .$ContentArea .$ItemID.'-'.$ItemID2."\n";
			$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;
		}
	}
	
	$string = $string .'/* Start the Double Sidebar Layouts */'."\n";
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		for ( $counter2 = 1; $counter2 <= $SideBarCount; $counter2 += 1) {
			if ($counter < $counter2){
				$ItemID = '.cms-templateInner'.$counter.$counter2;
				$ItemID2 = 'cms-templateInner'.$counter.$counter2;
				$ItemValue = cms_get_settings($ItemID2);
				$string = $string .$ContentArea .$ItemID."\n";
				$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;
				for ( $counter3 = 1; $counter3 <= $SideBarCount; $counter3 += 1) {
					$ItemID2 = 'cmssidebar'.$counter3;	
					$ItemWidth = $ItemID2 .'outer';
					$ItemID2 = 'sidebar'.$counter3;
					$ItemValue = cms_get_settings($ItemWidth);
					$string = $string .$ContentArea .$ItemID.'-'.$ItemID2."\n";
					$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;
				}
			}	
		}
	}
	
	$string = $string .'/* Start the Triple Layouts */'."\n";
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		for ( $counter2 = 1; $counter2 <= $SideBarCount; $counter2 += 1) {
			for ( $counter3 = 1; $counter3 <= $SideBarCount; $counter3 += 1) {
				if ($counter < $counter2 && $counter2 < $counter3){
					$ItemID = '.cms-templateInner'.$counter.$counter2.$counter3;
					$ItemID2 = 'cms-templateInner'.$counter.$counter2.$counter3;
					$ItemValue = cms_get_settings($ItemID2);
					$string = $string .$ContentArea .$ItemID."\n";
					$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;
					$ItemID2 = 'cmssidebar'.$counter;	
					$ItemWidth = $ItemID2 .'outer';
					$ItemID2 = 'sidebar'.$counter;
					$ItemValue = cms_get_settings($ItemWidth);
					$string = $string .$ContentArea .$ItemID.'-'.$ItemID2."\n";
					$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;	
					$ItemID2 = 'cmssidebar'.$counter2;	
					$ItemWidth = $ItemID2 .'outer';
					$ItemID2 = 'sidebar'.$counter2;
					$ItemValue = cms_get_settings($ItemWidth);
					$string = $string .$ContentArea .$ItemID.'-'.$ItemID2."\n";
					$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;	
					$ItemID2 = 'cmssidebar'.$counter3;	
					$ItemWidth = $ItemID2 .'outer';
					$ItemID2 = 'sidebar'.$counter3;
					$ItemValue = cms_get_settings($ItemWidth);
					$string = $string .$ContentArea .$ItemID.'-'.$ItemID2."\n";
					$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose;	
				}
			}
		}
	}
	$ItemValue = cms_get_settings('cms-templateInner-wide');
	$string = $string .$ContentArea.'.cms-templateInner-wide'."\n";
	$string = $string .$cmsBlock .$ItemValue.'px;'."\n" .$cmsBlockClose."\n"."\n";
	$string = $string .'/* End the Layouts */'."\n"."\n";

	for ( $counter = 1; $counter <=$SideBarCount; $counter += 1) {
		$contentleft = 'cmssidebar'.$counter.'left';
		$ItemFile = 'cmssidebar'.$counter.'file';
		$ItemWidthID = 'cmssidebar'.$counter.'width';
		$ItemWidth = cms_get_settings($ItemWidthID);
   		if (!cms_get_settings($contentleft)) {
			if (!cms_get_settings($ItemFile)) {
				$string = $string .'/* Right Sidebar '.$counter.' layout */'."\n";	
				$string = $string .'.'.$SidebarName[$counter] ."\n";
				$string = $string .$cmsBlock .$ItemWidth.'px;'."\n" .$cmsBlockClose;
			}
		} 
	}
	
	for ( $counter = 1; $counter <= $ContentCount; $counter += 1) {
		$ItemID = 'content'.$counter;
		$ItemWidth = $ItemID .'width';
		$ItemValue = cms_get_settings($ItemWidth);
		$ItemName = cms_get_settings($ItemID);
		$string = $string .'/* Style Block for '.$ItemName.' */'."\n";
		$string = $string .$ContentArea .'.cms-'.$ItemID."\n";
		if ($ItemValue){
			$string = $string .$cmsBlock .$ItemValue .'px;'."\n" .$cmsBlockClose;
		}else{
			$string = $string .$cmsBlock .'100%;'."\n" .$cmsBlockClose;
		}
	}
	
	for ( $counter = 1; $counter <= $OptionsCount; $counter += 1) {
		$ItemID = 'option'.$counter;
		$ItemWidthID = $ItemID .'width';
		$ItemHeightID = $ItemID .'height';
		$ItemHeight = cms_get_settings($ItemHeightID);
		$ItemWidth = cms_get_settings($ItemWidthID);
		$ItemName = cms_get_settings($ItemID);
		$string = $string .'/* Option Panel layout '.$ItemName.'*/'."\n";
		$string = $string .'#cms-'.$ItemID ."\n";
		$string = $string .$cmsBlock;
		if ($ItemWidth){
			$string = $string .$ItemWidth .'px;'."\n";
		}else{
			$string = $string .'100%;'."\n" ;
		}
		if ($ItemHeight){
			$string = $string .'  height: '.$ItemHeight .'px;'."\n".$cmsBlockClose."\n";
		}else{
			$string = $string .$cmsBlockClose."\n";
		}
		$string = $string .'#cms-' .$ItemID .' .inner'."\n";
		$string = $string .$cmsInnerBlock.$cmsBlockClose ."\n";			
	}
	return $string;
}
?>