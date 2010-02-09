<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* Create the Style Sheet */
function cms_style_css(){
	$catcherrors = cms_content_validate();
	if (count($catcherrors)> 1) {
		return 'Please Correct the Errors displayed';
		exit;
	}
	return $string;
}
?>