<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

function cms_content_validate(){
	$ErrArray[]='Notes:';
	if (!cms_get_settings('content_layout_name')){
		$ErrArray[]= 'Please enter a value for the content layout name';
	}
	$cmsValue[0] = cms_get_settings('content_layout_width'); 
	if ($cmsValue[0] <= '0') {
		$ErrArray[]= 'Please enter a value for the content layout width';
	}
	/* now check for the css and functions files */
	$ItemFileName = TEMPLATEPATH;
	if(!file_exists($ItemFileName.'/cms-layout.css')){
		$ErrArray[]= 'Please copy the file cms-layout.css to your theme into the root folder';
	}
	if(!file_exists($ItemFileName.'/cms-custom.css')){
		$ErrArray[]= 'Please copy the file cms-layout.css to your theme into the root folder';
	}
	if(!file_exists($ItemFileName.'/cms-style.css')){
		$ErrArray[]= 'Please copy the file cms-style.css to your theme into the root folder';
	}
	if(!file_exists($ItemFileName.'/functions.php')){
		$ErrArray[]= 'Please copy the file functions.php from /cms_inc/addons/ to your theme into the root folder';
	}

	if(!file_exists($ItemFileName.'/cms_inc/cms-functions.php')){
		$ErrArray[]= 'Please copy the cms-functions.php to your theme into the /cms_inc/ folder';
	}
	
	/* Check that the Sidebar files exist */
	$SideBarCount = cms_get_settings('sidebar_count');
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$ItemID = 'cmssidebar' .$counter;
		if (cms_get_settings($ItemID)){
			$ItemName = cms_get_settings($ItemID);
			$ItemWidth = $ItemID .'width';
			$ItemFile = $ItemID .'file';
			$ItemDiv = $ItemID .'div';
   			$cmsValue[$counter]= cms_get_settings($ItemWidth); 
			if ($cmsValue[$counter] <= '0'){
			$ErrArray[]= 'Please enter a value for '.$ItemName.' width';		
			}
			if ($cmsValue[$counter] > $cmsValue[0]) {
				$ErrArray[] = $ItemName.' width ' .$cmsValue[$counter] .' cannot be greater that the content layout width';
			}
			if (cms_get_settings($ItemFile)){
				$ItemFileName = TEMPLATEPATH;
				$ItemFileName = $ItemFileName .'/' .cms_get_settings($ItemFile);
				if (!file_exists($ItemFileName)){
					$ErrArray[]= 'Please enter a valid file name and extention for '.$ItemName;
				}
				if (!cms_get_settings($ItemFile)){
					$ErrArray[]= 'Please enter a value for the < div > '.$ItemName;
				}
			} else {
			   if (!content_file_exists($ItemID)){
					$ErrArray[]= 'Please copy the file ' .$ItemID .'.php to your theme into a folder /cms_inc/';
			   }
			}
		}
	}

	/* Check that the content files exist */
	for ( $counter = 1; $counter <= $ContentCount; $counter += 1) {
		$ItemID = 'content' .$counter;
		$ItemName = cms_get_settings($ItemID);
		$InnerWidth = cms_get_settings('template_inner_width');
		$ItemWidth = $ItemID.'width';
		if ($ItemName){
			if (!content_file_exists($ItemID)){
				$ErrArray[]= 'Please copy the file ' .$ItemID .'.php to your theme into a folder /cms_inc/';
			}
			$ItemWidthValue = cms_get_settings($ItemWidth);
			if ($ItemWidthValue > $InnerWidth) {
				$ErrArray[]= $ItemName.' width '.$ItemWidthValue .' cannot be greater that the content layout width';
			}
		}
	}

	/* Check that the options are setup correctly */
	$OptionCount = cms_get_settings('option_count');
	for ( $counter = 1; $counter <= $OptionCount; $counter += 1) {
		$ItemID = 'option' .$counter;
		$ItemName = cms_get_settings($ItemID);
		$ItemWidth = $ItemID.'width';
		$InnerWidth = cms_get_settings('template_inner_width');
		if ($ItemName){
			if (!content_file_exists($ItemID)){
				$ErrArray[]= 'Please copy the file ' .$ItemID .'.php to your theme into a folder /cms_inc/';
			}
			$ItemWidthValue = cms_get_settings($ItemWidth);
			if ($ItemWidthValue > $InnerWidth) {
				$ErrArray[]= $ItemName.' width '.$ItemWidthValue .' cannot be greater that the content layout width';
			}
		}
	} 

	/* Footer File */
	if (cms_get_settings('dynamic_footer')){
		if (!content_file_exists('footer')){
				$ErrArray[]= 'Please copy the file footer.php to your theme into a folder /cms_inc/';
		}
	} 
	return $ErrArray; 
}

/*Check if file exists */
function content_file_exists($whichfile){
	$ItemFileName = TEMPLATEPATH;
	$ItemFileName = $ItemFileName .'/cms_inc/' .$whichfile.".php";
	return file_exists($ItemFileName);
}
?>