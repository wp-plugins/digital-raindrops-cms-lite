<?php
/*		
'<!--- BEGIN Widget --->' => "<div class=\"cmsf-Widgets\">\r\n    <div class=\"cmsf-Widgets-body\">\r\n",
'<!--- BEGIN WidgetTitle --->' => "<div class=\"cmsf-WidgetsHeader\">\r\n    <div class=\"l\"></div>\r\n    <div class=\"r\"></div>\r\n    <div class=\"cmsf-header-tag-icon\">\r\n        <div class=\"t\">",
'<!--- END WidgetTitle --->' => "</div>\r\n    </div>\r\n</div>",
'<!--- BEGIN WidgetContent --->' => "<div class=\"cmsf-WidgetsContent\">\r\n    <div class=\"cmsf-WidgetsContent-tlc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-trc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-blc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-brc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-tb\"></div>\r\n    <div class=\"cmsf-WidgetsContent-bb\"></div>\r\n    <div class=\"cmsf-WidgetsContent-bl\"></div>\r\n    <div class=\"cmsf-WidgetsContent-br\"></div>\r\n    <div class=\"cmsf-WidgetsContent-cc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-body\">\r\n",
'<!--- END WidgetContent --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n",
'<!--- END Widget --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n"

*/

function get_footer_styles(){
	$FooterCount = cms_get_settings('footer_count');
	if (!is_numeric($FooterCount) || $FooterCount<0) $FooterCount = 0;
	if ($FooterCount>4) $FooterCount = 4;
	cms_update_option('footer_count',$FooterCount);
	if(!$FooterCount) return 'Please enter the number of footer panes you require';

	$ClipHeaderPixels = cms_get_settings('cmsf-Widgets-header-clipping');
	if (!is_numeric($ClipHeaderPixels) || ($ClipHeaderPixels <0)) $ClipHeaderPixels = 1;
	$ClipPixels = cms_get_settings('cmsf-Widgets-corner-clipping');
	if (!is_numeric($ClipPixels) || ($ClipPixels <0)) $ClipPixels = 1;
	$BoxPadding = cms_get_settings('cmsf-Widgets-padding');
	if (!is_numeric($BoxPadding) || ($BoxPadding <0)) $BoxPadding = 0;

	$cmsfString = '/* Begin Styling of Footer Widgets */' ."\n" ."\n";
	$cmsfString = $cmsfString .'/* Start Widgets Container */' ."\n";
	$ItemHeight = cms_get_settings('footer_height');
	if (!is_numeric($ItemHeight) || ($ItemHeight <0)) $ItemHeight = 0;
	$cmsfString = $cmsfString .'/* Footer Panel layout */'."\n";
	$cmsfString = $cmsfString .'.cms-footer'."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	position: relative;'."\n";
	$cmsfString = $cmsfString .'	margin-top: 0;'."\n";
	$cmsfString = $cmsfString .'	padding: 0;'."\n";
	$cmsfString = $cmsfString .'	border: 0;'."\n";
	$cmsfString = $cmsfString .'	float: left;'."\n";
	$cmsfString = $cmsfString .'	overflow: hidden;'."\n";
	$cmsfString = $cmsfString .'	width: 100%;' ."\n";
	if ($ItemHeight) {
		$cmsfString = $cmsfString .'	height: '.$ItemHeight .'px;'."\n";
	}else{
		$cmsfString = $cmsfString .'	height: 100%;'."\n";
	}
	$Holder = cms_get_settings('cmsf-Widgets-background-color');
	if ($Holder) $cmsfString = $cmsfString .'	background-color: '.$Holder.' !important;' ."\n";
	$cmsfString = $cmsfString .'} ' ."\n" ."\n";
	
	$FooterWidth = (floor(100/$FooterCount));
	for ( $counter = 1; $counter <= $FooterCount; $counter += 1) {
		$cmsfString = $cmsfString .'.cms-footer .cms-footer'.$counter;
		$cmsfString = $cmsfString .'{'."\n";
		$cmsfString = $cmsfString .'	position: relative;'."\n";
		$cmsfString = $cmsfString .'	float: left;'."\n";
		$cmsfString = $cmsfString .'	margin: 0;'."\n";
		$cmsfString = $cmsfString .'	padding: 0;'."\n";
		$cmsfString = $cmsfString .'	border: 0;'."\n";
		$cmsfString = $cmsfString .'	overflow: hidden;'."\n";
		$cmsfString = $cmsfString .'	width: '.$FooterWidth .'%;'."\n";
		if ($ItemHeight) $cmsfString = $cmsfString .'	height: '.$ItemHeight .'px;'."\n";

		$Holder = cms_get_settings('cmsf-WidgetsContents-background-color');
		if ($Holder) $cmsfString = $cmsfString .'	background-color: '.$Holder.' !important;' ."\n";

		$cmsfString = $cmsfString .'} ' ."\n" ."\n";
	}

	/* Get the defaults and Style the Container */
	$FilePath = cms_get_settings('TemplateImageFolder');
	if (!$FilePath) $FilePath = '/';
	$ClipHeaderPixels = cms_get_settings('cmsf-Widgets-header-clipping');
	if (!is_numeric($ClipHeaderPixels) || ($ClipHeaderPixels <0)) $ClipHeaderPixels = 1;
	$ClipPixels =  cms_get_settings('cmsf-Widgets-corner-clipping');
	if (!is_numeric($ClipPixels) || ($ClipPixels <0)) $ClipPixels = 0;
	$BoxPadding = cms_get_settings('cmsf-Widgets-padding');
	if (!is_numeric($BoxPadding) || ($BoxPadding <0)) $BoxPadding = 0;
	
	$ImageWidth = 0;
	$ImageHeight = 0;
	$HeaderHeight = 0;

	$BorderHeight = $BoxPadding;
	$BorderWidth = $BoxPadding;
	$ThemeName = stripslashes(get_current_theme());

	/* Check if we want to use a header */
	$Height = cms_get_settings('cmsf-WidgetsHeader-height');
	if (is_numeric($Height)) $HeaderHeight = $Height;
	$Holder = cms_get_settings('cmsf-WidgetsHeader-background-image');
	if ($Holder) {
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
				$image = getimagesize($FileName1);
				$HeaderHeight = $image[1];
			}
			cms_update_option('cmsf-WidgetsHeader-height',$HeaderHeight);
		}
	}

	/* Check our image sizes are OK */
	$Holder = cms_get_settings('cmsf-Widgets-corner-image');
	if ($Holder){
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
   				$image = getimagesize($FileName1);
   				$BorderWidth = $image[0];
   				$BorderHeight = $image[1];
			}
		}

		/* check the horizontal and vertical images */
		$Holder = cms_get_settings('cmsf-Widgets-horizontal-image');
		if (!$Holder) return 'You must specify a horizontal border image if you have a corner image selected';
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
	  			$image = getimagesize($FileName1);
	  			$ImageHeight = $image[1];
			}
			if ($ImageHeight != $BorderHeight) return 'Horizontal image height '.$ImageHeight.'px must match the height of the corner image '.$BorderHeight.'px';
		}
	
		$Holder = cms_get_settings('cmsf-Widgets-vertical-image');
		if (!$Holder) return 'You must specify a vertical border image if you have a corner image selected';
		$FileName1 = get_theme_root() .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
	   			$image = getimagesize($FileName1);
	  			$ImageWidth = $image[0];
			}
		if ($ImageWidth != $BorderWidth) return 'Vertical image width '.$ImageWidth.' px must match the height of the corner image '.$BorderWidth.'px';
		}
	}
	if (!$BorderWidth) $BorderWidth = 1;
	if (!$BorderHeight) $BorderHeight = 1;
	
	$cmsfString = $cmsfString . '/* Begin Styling of Footer Widgets */' ."\n";
	$cmsfString = $cmsfString .'/* Start Widgets Container */' ."\n"."\n";
	
	/* Style the Outer Container */
	$cmsfString = $cmsfString .'.cmsf-Widgets' ."\n";
	$cmsfString = $cmsfString .'{'."\n";
	$cmsfString = $cmsfString .'	position:relative;' ."\n";
	$cmsfString = $cmsfString .'	z-index:0;' ."\n";
	$cmsfString = $cmsfString .'	margin: 0 auto;' ."\n";
	$cmsfString = $cmsfString .'	min-width:'.$BorderWidth.'px;' ."\n";
	$cmsfString = $cmsfString .'	min-height:'.$BorderHeight.'px;' ."\n";
	$cmsfString = $cmsfString .'} ' ."\n" ."\n";

	$cmsfString = $cmsfString .'.cmsf-Widgets-body' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	position: relative;' ."\n";
	$cmsfString = $cmsfString .'	z-index: 1;' ."\n";
	$cmsfString = $cmsfString .'	padding: 0px;' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$Holder = cms_get_settings('cmsf-Widgets-margin');
	if (is_numeric($Holder) && $Holder != 0) {
		$cmsfString = $cmsfString .'.cmsf-Widgets' ."\n";
		$cmsfString = $cmsfString .'{'."\n";
		$cmsfString = $cmsfString .'	margin: '.$Holder.'px;' ."\n";
		$cmsfString = $cmsfString .'} ' ."\n" ."\n";
	}

	$cmsfString = $cmsfString .'/* End Widgets Container */' ."\n"."\n";

	$cmsfString = $cmsfString .'/* Begin Widgets Header */' ."\n";
	if ($HeaderHeight) {
		$Holder2 = cms_get_settings('cmsf-WidgetsHeader-padding');
		if (!is_numeric($Holder2) || ($Holder2 <0)) $Holder2 = 0;
		$Holder3 = cms_get_settings('cmsf-WidgetsHeader-margin-bottom');
		if (!is_numeric($Holder3) || ($Holder3 <0)) $Holder3 = 0;

		$cmsfString = $cmsfString .'.cmsf-WidgetsHeader' ."\n";
		$cmsfString = $cmsfString .'{' ."\n";
		$cmsfString = $cmsfString .'	position:relative;' ."\n";
		$cmsfString = $cmsfString .'	z-index:0;' ."\n";
		$cmsfString = $cmsfString .'	overflow: hidden;'."\n";
		$cmsfString = $cmsfString .'	height: '.$HeaderHeight.'px;' ."\n";
		$cmsfString = $cmsfString .'	padding: 0 '.$Holder2.'px;' ."\n";
		$cmsfString = $cmsfString .'	margin-bottom: '.$Holder3.'px;' ."\n";	
		$cmsfString = $cmsfString .'}' ."\n" ."\n";

		$cmsfString = $cmsfString .'.cmsf-WidgetsHeader .t' ."\n";
		$cmsfString = $cmsfString .'{' ."\n";
		$cmsfString = $cmsfString .'	height: '.$HeaderHeight.'px;' ."\n";
		$Holder1 = cms_get_settings('cmsf-WidgetsHeader-text-color');
		if ($Holder1) $cmsfString = $cmsfString .'	color: '.$Holder1.';' ."\n";
		$Holder2 = cms_get_settings('cmsf-WidgetsHeader-font-family');
		if ($Holder2) $cmsfString = $cmsfString .'	font-family: '.$Holder2.';' ."\n";
		$Holder3 = cms_get_settings('cmsf-WidgetsHeader-font-size');
		if ($Holder3) $cmsfString = $cmsfString .'	font-size: '.$Holder3.'px;' ."\n";
		$Holder4 = cms_get_settings('cmsf-WidgetsHeader-font-weight');
		if ($Holder4) $cmsfString = $cmsfString .'	font-weight: bold;' ."\n";
		$cmsfString = $cmsfString .'	white-space : nowrap;' ."\n";
		$cmsfString = $cmsfString .'	padding: 0 1px;' ."\n";
		$cmsfString = $cmsfString .'	line-height: '.$HeaderHeight.'px;' ."\n";	
		$cmsfString = $cmsfString .'}' ."\n"."\n";

		$Holder = cms_get_settings('cmsf-WidgetsHeader-background-image');
		$Holder1 = "";
		if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
		$Holder2 = cms_get_settings('cmsf-WidgetsHeader-background-color');
		$cmsfString = $cmsfString .'.cmsf-WidgetsHeader .l, .cmsf-WidgetsHeader .r' ."\n";
		$cmsfString = $cmsfString .'{' ."\n";
		$cmsfString = $cmsfString .'	display:block;' ."\n";
		$cmsfString = $cmsfString .'	position:absolute;' ."\n";
		$cmsfString = $cmsfString .'	z-index:-1;' ."\n";
		$cmsfString = $cmsfString .'	height: '.$HeaderHeight.'px;' ."\n";
		if ($Holder2) $cmsfString = $cmsfString .'	background-color: '.$Holder2.';' ."\n";
		if ($Holder1) $cmsfString = $cmsfString ."	background-image: url('".$Holder1."');" ."\n";
		$cmsfString = $cmsfString .'}' ."\n" ."\n";

		$cmsfString = $cmsfString .'.cmsf-WidgetsHeader .l' ."\n";
		$cmsfString = $cmsfString .'{' ."\n";
		$cmsfString = $cmsfString .'	left: 0;' ."\n";
		if ($ClipHeaderPixels) $cmsfString = $cmsfString .'	right: '.$ClipHeaderPixels.'px;' ."\n";
		$cmsfString = $cmsfString .'}' ."\n" ."\n";
		
		$WideClip = cms_get_settings('content_layout_width');
		if ($ClipHeaderPixels) {
			$Holder = cms_get_settings('cmsf-WidgetsHeader-background-image');
			if ($Holder){
				$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
				if (file_exists($FileName1)){
					if ( function_exists('getimagesize') ) {
	  					$image = getimagesize($FileName1);
	  					$ImageWidth = $image[0];
					}
				}
				if ($ImageWidth){
					$WideClip = $ImageWidth;
				}	
			}
		}
		$cmsfString = $cmsfString .'.cmsf-WidgetsHeader .r' ."\n";
		$cmsfString = $cmsfString .'{' ."\n";
		$cmsfString = $cmsfString .'	width:'.$WideClip.'px;' ."\n";
		$cmsfString = $cmsfString .'	right:0;' ."\n";
		if ($ClipHeaderPixels) $WideClip = ($WideClip - $ClipHeaderPixels);
		if ($ClipHeaderPixels) $cmsfString = $cmsfString .'	clip: rect(auto, auto, auto, '.$WideClip.'px);' ."\n";
		$cmsfString = $cmsfString .'}' ."\n" ."\n";	
		
		$Holder = cms_get_settings('cmsf-Widgets-HeaderIcon-image');
		if ($Holder){
			$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
			if (file_exists($FileName1)){
				if ( function_exists('getimagesize') ) {
	  				$image = getimagesize($FileName1);
	  				$ImageHeight = $image[1];
				}
			}
			if ($ImageHeight > $HeaderHeight) return 'The height of the header icon cannt be geater than the hight of the header' ;
		}		
		$Holder1 = "";
		if ($Holder){
			$Holder1 = substr($FilePath, 1) .$Holder;
			$cmsfString = $cmsfString .'.cmsf-header-tag-icon' ."\n";
			$cmsfString = $cmsfString .'{' ."\n";
    		$cmsfString = $cmsfString .'	height: '.$HeaderHeight.'px;' ."\n";
			$cmsfString = $cmsfString .'	background-position:left top; ' ."\n";
			$cmsfString = $cmsfString ."	background-image: url('".$Holder1."');" ."\n";
			$Holder = cms_get_settings('cmsf-Widgets-HeaderIcon-padding');
			if (!is_numeric($Holder) || ($Holder <0)) $Holder = 0;
			if ($Holder) $cmsfString = $cmsfString .'padding:0 0 0 '.$Holder.'px;' ."\n";
			$cmsfString = $cmsfString .'	background-repeat: no-repeat;' ."\n";
			$cmsfString = $cmsfString .'	min-height: '.floor(($HeaderHeight/3)+2).'px;' ."\n";
			$Holder = cms_get_settings('cmsf-Widgets-HeaderIcon-margin');
			if (!is_numeric($Holder) || ($Holder <0)) $Holder = 0;
			$cmsfString = $cmsfString .'	margin: 0 0 0 5px;' ."\n";
			$cmsfString = $cmsfString .'}' ."\n" ."\n";	
		}
		$cmsfString = $cmsfString .' /* End Widget Header layout */' ."\n" ."\n";
	}

	/* Layout the content */
	$cmsfString = $cmsfString .'/* Begin Widgets Content Layout */' ."\n";
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	position:relative;' ."\n";
	$cmsfString = $cmsfString .'	z-index:0;' ."\n";
	$cmsfString = $cmsfString .'	margin:0 auto;' ."\n";
	$cmsfString = $cmsfString .'	min-width:13px;' ."\n";
	$cmsfString = $cmsfString .'	min-height:13px;' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-trc, .cmsf-WidgetsContent-tlc, .cmsf-WidgetsContent-brc, .cmsf-WidgetsContent-blc' ."\n"; 
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	position:absolute;' ."\n";
	$cmsfString = $cmsfString .'	z-index:-1;' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-tb, .cmsf-WidgetsContent-bb,.cmsf-WidgetsContent-br, .cmsf-WidgetsContent-bl' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	position:absolute;' ."\n";
	$cmsfString = $cmsfString .'	z-index:-1;' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$Holder2 = cms_get_settings('cmsf-WidgetsContent-padding');
	if (!is_numeric($Holder2) || ($Holder2 <0)) $Holder2 = 0;
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-body' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	position: relative;' ."\n";
	$cmsfString = $cmsfString .'	z-index: 1;' ."\n";
	$cmsfString = $cmsfString .'	padding: '.$Holder2.'px;' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmsf-Widgets-corner-image');
	$Holder1 = "";
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmsfString = $cmsfString .'/* Begin Widgets Container Borders */' ."\n";
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-trc, .cmsf-WidgetsContent-tlc, .cmsf-WidgetsContent-brc, .cmsf-WidgetsContent-blc' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	width: '.$BorderWidth.'px;' ."\n";
	$cmsfString = $cmsfString .'	height: '.$BorderHeight.'px;' ."\n";
	if ($Holder1) $cmsfString = $cmsfString ."	background-image: url('".$Holder1."');" ."\n";
	$cmsfString = $cmsfString .'}' ."\n";
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-tlc' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	top:0;' ."\n";
	$cmsfString = $cmsfString .'	left:0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect(auto, '.$ClipPixels.'px, '.$ClipPixels.'px, auto);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-trc' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	top: 0;' ."\n";
	$cmsfString = $cmsfString .'	right: 0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect(auto, auto, '.$ClipPixels.'px, '.$ClipPixels.'px);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";
		
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-blc' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	bottom: 0;' ."\n";
	$cmsfString = $cmsfString .'	left: 0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect('.$ClipPixels.'px, '.$ClipPixels.'px, auto, auto);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-brc' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	bottom: 0;' ."\n";
	$cmsfString = $cmsfString .'	right: 0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect('.$ClipPixels.'px, auto, auto, '.$ClipPixels.'px);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmsf-Widgets-horizontal-image');
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-tb, .cmsf-WidgetsContent-bb' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	left: '.floor($BorderWidth/2).'px;' ."\n";
	$cmsfString = $cmsfString .'	right: '.floor($BorderWidth/2).'px;' ."\n";
	$cmsfString = $cmsfString .'	height: '.$BorderHeight.'px;' ."\n";
	if ($Holder) $cmsfString = $cmsfString ."	background-image: url('".$Holder1."');" ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-tb' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	top: 0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect(auto, auto, '.$ClipPixels.'px, auto);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";
	
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-bb' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	bottom: 0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect('.$ClipPixels.'px, auto, auto, auto);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmsf-Widgets-vertical-image');
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-br, .cmsf-WidgetsContent-bl' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	top: '.floor($BorderHeight/2).'px;' ."\n";
	$cmsfString = $cmsfString .'	bottom: '.floor($BorderHeight/2).'px;' ."\n";
	$cmsfString = $cmsfString .'	width: '.$BorderWidth.'px;' ."\n";
	if ($Holder1) $cmsfString = $cmsfString ."	background-image: url('".$Holder1."');" ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-br' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	right:0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect(auto, auto, auto, '.$ClipPixels.'px);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-bl' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	left:0;' ."\n";
	if ($ClipPixels) $cmsfString = $cmsfString .'	clip: rect(auto, '.$ClipPixels.'px, auto, auto);' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$Holder = cms_get_settings('cmsf-WidgetsContents-background-image');
	$Holder1 = "";
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$Holder = cms_get_settings('cmsf-WidgetsContents-background-color');
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-cc' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	position:absolute;' ."\n";
	$cmsfString = $cmsfString .'	z-index:-1;' ."\n";
	$cmsfString = $cmsfString .'	top: '.floor($BorderHeight/2).'px;' ."\n";
	$cmsfString = $cmsfString .'	left: '.floor($BorderWidth/2).'px;' ."\n";
	$cmsfString = $cmsfString .'	right: '.floor($BorderWidth/2).'px;' ."\n";
	$cmsfString = $cmsfString .'	bottom: '.floor($BorderHeight/2).'px;' ."\n";
	if ($Holder) $cmsfString = $cmsfString .'	background-color: '.$Holder.';' ."\n";
	if ($Holder1) $cmsfString = $cmsfString ."	background-image: url('".$Holder1."');" ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ;
	$cmsfString = $cmsfString .'/* End Widgets Content Layout */' ."\n" ."\n";

	$cmsfString = $cmsfString .'/* Start Widgets Content Style */'."\n";
	$Holder1 = cms_get_settings('cmsf-WidgetsContent-text-color'); 
	$Holder2 = cms_get_settings('cmsf-WidgetsContent-font-family');
	$Holder3 = cms_get_settings('cmsf-WidgetsContent-font-size');
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-body' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	if ($Holder1) $cmsfString = $cmsfString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmsfString = $cmsfString .'	font-family: '.$Holder2.';' ."\n";
	if ($Holder2) $cmsfString = $cmsfString .'	font-size: '.$Holder3.'px;' ."\n";
	$cmsfString = $cmsfString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsf-WidgetsLink-text-color');
	$Holder2 = cms_get_settings('cmsf-WidgetsLink-font-family');
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-body a:link' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	if ($Holder1) $cmsfString = $cmsfString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmsfString = $cmsfString .'	font-family: '.$Holder2.';' ."\n";
	$cmsfString = $cmsfString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsf-WidgetsVisited-text-color');
	$Holder2 = cms_get_settings('cmsf-WidgetsVisited-font-family');
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-body a:visited, .cmsf-WidgetsContent-body a.visited' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	if ($Holder1) $cmsfString = $cmsfString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmsfString = $cmsfString .'	font-family: '.$Holder2.';' ."\n";
	$cmsfString = $cmsfString .'text-decoration: none;' ."\n";
	$cmsfString = $cmsfString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsf-WidgetsHover-text-color');
	$Holder2 = cms_get_settings('cmsf-WidgetsHover-font-family');
	$Holder3 = cms_get_settings('cmsf-WidgetsHover-background-color');
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-body a:hover, .cmsf-WidgetsContent-body a.hover' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	if ($Holder1) $cmsfString = $cmsfString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmsfString = $cmsfString .'	font-family: '.$Holder2.';' ."\n";
	$cmsfString = $cmsfString .'	text-decoration: none;' ."\n";
	if ($Holder3) $cmsfString = $cmsfString .'	background-color: '.$Holder3.';' ."\n";
	$cmsfString = $cmsfString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsf-WidgetsList-text-color');
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-body ul' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	$cmsfString = $cmsfString .'	list-style-type: none;' ."\n";
	if ($Holder1) $cmsfString = $cmsfString .'	color: '.$Holder1.';' ."\n";
	$cmsfString = $cmsfString .'	margin:0;' ."\n";
	$cmsfString = $cmsfString .'	padding:0;' ."\n";
	$cmsfString = $cmsfString .'}'  ."\n" ."\n";
	
	$Holder1 = "";
	$Holder = cms_get_settings('cmsf-Widgets-ListBullet-image');
	if ($Holder){
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
	  				$image = getimagesize($FileName1);
	  				$ImageWidth = $image[0];
				}
		}else{
			return 'The the list bullet image does not exist ' .$FileName1;
		}		
	}	
	if ($Holder) $Holder3 = substr($FilePath, 1) .$Holder;
	$Holder1 = cms_get_settings('cmsf-WidgetsList-font-family');
	$Holder2 = cms_get_settings('cmsf-WidgetsList-font-size');
	$cmsfString = $cmsfString .'.cmsf-WidgetsContent-body ul li' ."\n";
	$cmsfString = $cmsfString .'{' ."\n";
	if ($Holder1) $cmsfString = $cmsfString .'	font-family: '.$Holder1.';' ."\n";
	if ($Holder2) $cmsfString = $cmsfString .'	font-size: '.$Holder2.'px;' ."\n";
	$cmsfString = $cmsfString .'	line-height: 125%;' ."\n";
	$cmsfString = $cmsfString .'	line-height: 1.25em;' ."\n";
	if ($Holder3) $cmsfString = $cmsfString .'	 padding: 0px 0 0px '.($ImageWidth+$ImageWidth).'px;' ."\n";
	if ($Holder3) $cmsfString = $cmsfString ."	background-image: url('".$Holder3."');" ."\n";
	if ($Holder3) $cmsfString = $cmsfString .'	background-repeat: no-repeat;' ."\n";
	$cmsfString = $cmsfString .'}' ."\n" ."\n";

	$cmsfString = $cmsfString .'/* End Widgets Content */' ."\n";

	$cmsfString = $cmsfString .'.cleared' ."\n";
	$cmsfString = $cmsfString .' {' ."\n";
	$cmsfString = $cmsfString .'	float: none;' ."\n";
	$cmsfString = $cmsfString .'	clear: both;' ."\n";
	$cmsfString = $cmsfString .'	margin:0 auto;' ."\n";
	$cmsfString = $cmsfString .'	padding: 0;' ."\n";
	$cmsfString = $cmsfString .'	border: none;' ."\n";
	$cmsfString = $cmsfString .'	font-size:1px;' ."\n";
	$cmsfString = $cmsfString .'}' ."\n";
	$cmsfString = $cmsfString .'/* End Widgets Content Style */' ."\n";
	$cmsfString = $cmsfString .'/* End Widgets Footer Styles */' ."\n" ."\n";
	return $cmsfString;
}
?>