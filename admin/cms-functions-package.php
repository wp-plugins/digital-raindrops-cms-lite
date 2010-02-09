<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* Package and Deploy Functions */
function cms_get_functions_code(){
	$SideBarCount = cms_get_settings('sidebar_count');
	$ContentCount = cms_get_settings('content_count');
	$OptionsCount = cms_get_settings('option_count');
	$FooterCount = cms_get_settings('footer_count');
	$string = '/* Code created by Digital Raindrops CRM-Lite */' ."\n";
	

	if ($SideBarCount){
		$string = $string ."if (get_option('sidebar_count') !='".$SideBarCount."') update_option('sidebar_count','".$SideBarCount."');"."\n";
		for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
			$ItemID = 'cmssidebar'.$counter;
			$ItemFile = $ItemID.'file';
			if (!cms_get_settings($ItemFile)) {
				$ItemName = cms_get_settings($ItemID);
				$string = $string ."if (get_settings('".$ItemID."') !='".$ItemName."') update_option('".$ItemID."','".$ItemName."');"."\n";
			}
		}
	}



	if ($ContentCount){
		$string = $string ."if (get_option('content_count') !='".$ContentCount."') update_option('content_count','".$ContentCount."');"."\n";
		for ( $counter = 1; $counter <= $ContentCount; $counter += 1) {
			$ItemID = 'content'.$counter;
			$ItemName = cms_get_settings($ItemID);
			$string = $string ."if (get_option('".$ItemID."')!='".$ItemName."') update_option('".$ItemID."','".$ItemName."');"."\n";
			}
	}

	if ($OptionsCount){
		$string = $string ."if (get_option('option_count') !='".$OptionsCount."') update_option('option_count','".$OptionsCount."');"."\n";
		for ( $counter = 1; $counter <= $OptionsCount; $counter += 1) {
			$ItemID = 'option' .$counter;
			$ItemInput = $ItemID .'input';
			$ItemStyleID = $ItemID .'style';
			$ItemTextID = $ItemID .'text';
			$ItemDescID = $ItemID .'desc';
			if (cms_get_settings($ItemInput)) {
				$ItemName = cms_get_settings($ItemID);
				$Holder = cms_get_settings($ItemStyleID);
				if ($Holder){
					$ItemStyle = 'textarea';
				}else{
					$ItemStyle = 'text';
				}
				$ItemText = cms_get_settings($ItemTextID);
				$ItemDesc = cms_get_settings($ItemDescID);
				$string = $string ."if (get_option('".$ItemID."')!='".$ItemName."') update_option('".$ItemID."','".$ItemName."');"."\n";
				$ItemName = cms_get_settings($ItemStyle);
				$string = $string ."if (get_option('".$ItemStyleID."')!='".$ItemStyle."') update_option('".$ItemStyleID."','".$ItemStyle."');"."\n";
				$ItemName = cms_get_settings($ItemText);
				$string = $string ."if (get_option('".$ItemTextID."')!='".$ItemText."') update_option('".$ItemTextID."','".$ItemText."');"."\n";
				$ItemName = cms_get_settings($ItemDesc);
				$string = $string ."if (get_option('".$ItemDescID."') !='".$ItemDesc."') update_option('".$ItemDescID."','".$ItemDesc."');"."\n";
			}else{
				$string = $string ."if (get_option('".$ItemID."')) update_option('".$ItemID."','');"."\n";			
				$string = $string ."if (get_option('".$ItemStyleID."')) update_option('".$ItemStyleID."','');"."\n";			
				$string = $string ."if (get_option('".$ItemTextID."')) update_option('".$ItemTextID."','');"."\n";			
				$string = $string ."if (get_option('".$ItemDescID."')) update_option('".$ItemDescID."','');"."\n";			
				$string = $string ."if (get_option('".$ItemInput."')) update_option('".$ItemInput."','');"."\n";
			}
		}
	}

	if ($FooterCount){
		$string = $string ."if (get_option('footer_count') != ".$FooterCount.") update_option('footer_count','".$FooterCount."');";
	} 
	return $string;
}

function cms_get_footer_code(){
	if (!cms_get_settings('footer_count')){
		return 'Footer block not included no code to add';
	}else{
		$string = '/* Include Digital Raindrops CMS-Lite advanced Options */' ."\n";
		$string = $string ."include_once (TEMPLATEPATH. '/cms_inc/cms-footer.php');" ."\n";
		return $string;
	}
}

function cms_functions_code(){
	$string = '/* Include Digital Raindrops CMS-Lite advanced Options */' ."\n";
	$string = $string ."include_once (TEMPLATEPATH. '/cms_inc/cms-functions.php');" ."\n";
	$string = $string ."include_once (TEMPLATEPATH. '/cms_inc/cms-functions-widgets.php');";
	return $string;
}
?>