<?php
/*		
'<!--- BEGIN Widget --->' => "<div class=\"cmsc-Widgets\">\r\n    <div class=\"cmsc-Widgets-body\">\r\n",
'<!--- BEGIN WidgetTitle --->' => "<div class=\"cmsc-WidgetsHeader\">\r\n    <div class=\"l\"></div>\r\n    <div class=\"r\"></div>\r\n    <div class=\"cmsc-header-tag-icon\">\r\n        <div class=\"t\">",
'<!--- END WidgetTitle --->' => "</div>\r\n    </div>\r\n</div>",
'<!--- BEGIN WidgetContent --->' => "<div class=\"cmsc-WidgetsContent\">\r\n    <div class=\"cmsc-WidgetsContent-tlc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-trc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-blc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-brc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-tb\"></div>\r\n    <div class=\"cmsc-WidgetsContent-bb\"></div>\r\n    <div class=\"cmsc-WidgetsContent-bl\"></div>\r\n    <div class=\"cmsc-WidgetsContent-br\"></div>\r\n    <div class=\"cmsc-WidgetsContent-cc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-body\">\r\n",
'<!--- END WidgetContent --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n",
'<!--- END Widget --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n"

*/

function get_content_styles(){
	/* Get the defaults and Style the Container */
	$FilePath = cms_get_settings('TemplateImageFolder');
	if (!$FilePath) $FilePath = '/';
	$ClipHeaderPixels = cms_get_settings('cmsc-Widgets-header-clipping');
	if (!is_numeric($ClipHeaderPixels) || ($ClipHeaderPixels <0)) $ClipHeaderPixels = 1;
	$ClipPixels =  cms_get_settings('cmsc-Widgets-corner-clipping');
	if (!is_numeric($ClipPixels) || ($ClipPixels <0)) $ClipPixels = 0;
	$BoxPadding = cms_get_settings('cmsc-Widgets-padding');
	if (!is_numeric($BoxPadding) || ($BoxPadding <0)) $BoxPadding = 0;
	
	$ImageWidth = 0;
	$ImageHeight = 0;
	$HeaderHeight = 0;

	$BorderHeight = $BoxPadding;
	$BorderWidth = $BoxPadding;
	$ThemeName = stripslashes(get_current_theme());

	/* Check if we want to use a header */
	$Height = cms_get_settings('cmsc-WidgetsHeader-height');
	if (is_numeric($Height)) $HeaderHeight = $Height;
	$Holder = cms_get_settings('cmsc-WidgetsHeader-background-image');
	if ($Holder) {
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
				$image = getimagesize($FileName1);
				$HeaderHeight = $image[1];
			}
			cms_update_option('cmsc-WidgetsHeader-height',$HeaderHeight);
		}
	}

	/* Check our image sizes are OK */
	$Holder = cms_get_settings('cmsc-Widgets-corner-image');
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
		$Holder = cms_get_settings('cmsc-Widgets-horizontal-image');
		if (!$Holder) return 'You must specify a horizontal border image if you have a corner image selected';
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
	  			$image = getimagesize($FileName1);
	  			$ImageHeight = $image[1];
			}
			if ($ImageHeight != $BorderHeight) return 'Horizontal image height '.$ImageHeight.'px must match the height of the corner image '.$BorderHeight.'px';
		}
	
		$Holder = cms_get_settings('cmsc-Widgets-vertical-image');
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
	
	$cmscString = $cmscString . '/* Begin Styling of Content Widgets */' ."\n";
	$cmscString = $cmscString .'/* Start Widgets Container */' ."\n"."\n";
	
	/* Style the Outer Container */
	$cmscString = $cmscString .'.cmsc-Widgets' ."\n";
	$cmscString = $cmscString .'{'."\n";
	$cmscString = $cmscString .'	position:relative;' ."\n";
	$cmscString = $cmscString .'	z-index:0;' ."\n";
	$cmscString = $cmscString .'	margin: 0 auto;' ."\n";
	$cmscString = $cmscString .'	min-width:'.$BorderWidth.'px;' ."\n";
	$cmscString = $cmscString .'	min-height:'.$BorderHeight.'px;' ."\n";
	$cmscString = $cmscString .'} ' ."\n" ."\n";

	$cmscString = $cmscString .'.cmsc-Widgets-body' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	position: relative;' ."\n";
	$cmscString = $cmscString .'	z-index: 1;' ."\n";
	$cmscString = $cmscString .'	padding: 0px;' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$Holder = cms_get_settings('cmsc-Widgets-margin');
	if (is_numeric($Holder) && $Holder != 0) {
		$cmscString = $cmscString .'.cmsc-Widgets' ."\n";
		$cmscString = $cmscString .'{'."\n";
		$cmscString = $cmscString .'	margin: '.$Holder.'px;' ."\n";
		$cmscString = $cmscString .'} ' ."\n" ."\n";
	}

	$cmscString = $cmscString .'/* End Widgets Container */' ."\n"."\n";

	$cmscString = $cmscString .'/* Begin Widgets Header */' ."\n";
	if ($HeaderHeight) {
		$Holder2 = cms_get_settings('cmsc-WidgetsHeader-padding');
		if (!is_numeric($Holder2) || ($Holder2 <0)) $Holder2 = 0;
		$Holder3 = cms_get_settings('cmsc-WidgetsHeader-margin-bottom');
		if (!is_numeric($Holder3) || ($Holder3 <0)) $Holder3 = 0;

		$cmscString = $cmscString .'.cmsc-WidgetsHeader' ."\n";
		$cmscString = $cmscString .'{' ."\n";
		$cmscString = $cmscString .'	position:relative;' ."\n";
		$cmscString = $cmscString .'	z-index:0;' ."\n";
		$cmscString = $cmscString .'	overflow: hidden;'."\n";
		$cmscString = $cmscString .'	height: '.$HeaderHeight.'px;' ."\n";
		$cmscString = $cmscString .'	padding: 0 '.$Holder2.'px;' ."\n";
		$cmscString = $cmscString .'	margin-bottom: '.$Holder3.'px;' ."\n";	
		$cmscString = $cmscString .'}' ."\n" ."\n";

		$cmscString = $cmscString .'.cmsc-WidgetsHeader .t' ."\n";
		$cmscString = $cmscString .'{' ."\n";
		$cmscString = $cmscString .'	height: '.$HeaderHeight.'px;' ."\n";
		$Holder1 = cms_get_settings('cmsc-WidgetsHeader-text-color');
		if ($Holder1) $cmscString = $cmscString .'	color: '.$Holder1.';' ."\n";
		$Holder2 = cms_get_settings('cmsc-WidgetsHeader-font-family');
		if ($Holder2) $cmscString = $cmscString .'	font-family: '.$Holder2.';' ."\n";
		$Holder3 = cms_get_settings('cmsc-WidgetsHeader-font-size');
		if ($Holder3) $cmscString = $cmscString .'	font-size: '.$Holder3.'px;' ."\n";
		$Holder4 = cms_get_settings('cmsc-WidgetsHeader-font-weight');
		if ($Holder4) $cmscString = $cmscString .'	font-weight: bold;' ."\n";
		$cmscString = $cmscString .'	white-space : nowrap;' ."\n";
		$cmscString = $cmscString .'	padding: 0 1px;' ."\n";
		$cmscString = $cmscString .'	line-height: '.$HeaderHeight.'px;' ."\n";	
		$cmscString = $cmscString .'}' ."\n"."\n";

		$Holder = cms_get_settings('cmsc-WidgetsHeader-background-image');
		$Holder1 = "";
		if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
		$Holder2 = cms_get_settings('cmsc-WidgetsHeader-background-color');
		$cmscString = $cmscString .'.cmsc-WidgetsHeader .l, .cmsc-WidgetsHeader .r' ."\n";
		$cmscString = $cmscString .'{' ."\n";
		$cmscString = $cmscString .'	display:block;' ."\n";
		$cmscString = $cmscString .'	position:absolute;' ."\n";
		$cmscString = $cmscString .'	z-index:-1;' ."\n";
		$cmscString = $cmscString .'	height: '.$HeaderHeight.'px;' ."\n";
		if ($Holder2) $cmscString = $cmscString .'	background-color: '.$Holder2.';' ."\n";
		if ($Holder1) $cmscString = $cmscString ."	background-image: url('".$Holder1."');" ."\n";
		$cmscString = $cmscString .'}' ."\n" ."\n";

		$cmscString = $cmscString .'.cmsc-WidgetsHeader .l' ."\n";
		$cmscString = $cmscString .'{' ."\n";
		$cmscString = $cmscString .'	left: 0;' ."\n";
		if ($ClipHeaderPixels) $cmscString = $cmscString .'	right: '.$ClipHeaderPixels.'px;' ."\n";
		$cmscString = $cmscString .'}' ."\n" ."\n";
		
		$WideClip = cms_get_settings('content_layout_width');
		if ($ClipHeaderPixels) {
			$Holder = cms_get_settings('cmsc-WidgetsHeader-background-image');
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
		$cmscString = $cmscString .'.cmsc-WidgetsHeader .r' ."\n";
		$cmscString = $cmscString .'{' ."\n";
		$cmscString = $cmscString .'	width:'.$WideClip.'px;' ."\n";
		$cmscString = $cmscString .'	right:0;' ."\n";
		if ($ClipHeaderPixels) $WideClip = ($WideClip - $ClipHeaderPixels);
		if ($ClipHeaderPixels) $cmscString = $cmscString .'	clip: rect(auto, auto, auto, '.$WideClip.'px);' ."\n";
		$cmscString = $cmscString .'}' ."\n" ."\n";	
		
		$Holder = cms_get_settings('cmsc-Widgets-HeaderIcon-image');
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
			$cmscString = $cmscString .'.cmsc-header-tag-icon' ."\n";
			$cmscString = $cmscString .'{' ."\n";
    		$cmscString = $cmscString .'	height: '.$HeaderHeight.'px;' ."\n";
			$cmscString = $cmscString .'	background-position:left top; ' ."\n";
			$cmscString = $cmscString ."	background-image: url('".$Holder1."');" ."\n";
			$Holder = cms_get_settings('cmsc-Widgets-HeaderIcon-padding');
			if (!is_numeric($Holder) || ($Holder <0)) $Holder = 0;
			if ($Holder) $cmscString = $cmscString .'padding:0 0 0 '.$Holder.'px;' ."\n";
			$cmscString = $cmscString .'	background-repeat: no-repeat;' ."\n";
			$cmscString = $cmscString .'	min-height: '.floor(($HeaderHeight/3)+2).'px;' ."\n";
			$Holder = cms_get_settings('cmsc-Widgets-HeaderIcon-margin');
			if (!is_numeric($Holder) || ($Holder <0)) $Holder = 0;
			$cmscString = $cmscString .'	margin: 0 0 0 5px;' ."\n";
			$cmscString = $cmscString .'}' ."\n" ."\n";	
		}
		$cmscString = $cmscString .' /* End Widget Header layout */' ."\n" ."\n";
	}

	/* Layout the content */
	$cmscString = $cmscString .'/* Begin Widgets Content Layout */' ."\n";
	$cmscString = $cmscString .'.cmsc-WidgetsContent' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	position:relative;' ."\n";
	$cmscString = $cmscString .'	z-index:0;' ."\n";
	$cmscString = $cmscString .'	margin:0 auto;' ."\n";
	$cmscString = $cmscString .'	min-width:13px;' ."\n";
	$cmscString = $cmscString .'	min-height:13px;' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$cmscString = $cmscString .'.cmsc-WidgetsContent-trc, .cmsc-WidgetsContent-tlc, .cmsc-WidgetsContent-brc, .cmsc-WidgetsContent-blc' ."\n"; 
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	position:absolute;' ."\n";
	$cmscString = $cmscString .'	z-index:-1;' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$cmscString = $cmscString .'.cmsc-WidgetsContent-tb, .cmsc-WidgetsContent-bb,.cmsc-WidgetsContent-br, .cmsc-WidgetsContent-bl' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	position:absolute;' ."\n";
	$cmscString = $cmscString .'	z-index:-1;' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$Holder2 = cms_get_settings('cmsc-WidgetsContent-padding');
	if (!is_numeric($Holder2) || ($Holder2 <0)) $Holder2 = 0;
	$cmscString = $cmscString .'.cmsc-WidgetsContent-body' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	position: relative;' ."\n";
	$cmscString = $cmscString .'	z-index: 1;' ."\n";
	$cmscString = $cmscString .'	padding: '.$Holder2.'px;' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmsc-Widgets-corner-image');
	$Holder1 = "";
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmscString = $cmscString .'/* Begin Widgets Container Borders */' ."\n";
	$cmscString = $cmscString .'.cmsc-WidgetsContent-trc, .cmsc-WidgetsContent-tlc, .cmsc-WidgetsContent-brc, .cmsc-WidgetsContent-blc' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	width: '.$BorderWidth.'px;' ."\n";
	$cmscString = $cmscString .'	height: '.$BorderHeight.'px;' ."\n";
	if ($Holder1) $cmscString = $cmscString ."	background-image: url('".$Holder1."');" ."\n";
	$cmscString = $cmscString .'}' ."\n";
	$cmscString = $cmscString .'.cmsc-WidgetsContent-tlc' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	top:0;' ."\n";
	$cmscString = $cmscString .'	left:0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect(auto, '.$ClipPixels.'px, '.$ClipPixels.'px, auto);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$cmscString = $cmscString .'.cmsc-WidgetsContent-trc' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	top: 0;' ."\n";
	$cmscString = $cmscString .'	right: 0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect(auto, auto, '.$ClipPixels.'px, '.$ClipPixels.'px);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";
		
	$cmscString = $cmscString .'.cmsc-WidgetsContent-blc' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	bottom: 0;' ."\n";
	$cmscString = $cmscString .'	left: 0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect('.$ClipPixels.'px, '.$ClipPixels.'px, auto, auto);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$cmscString = $cmscString .'.cmsc-WidgetsContent-brc' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	bottom: 0;' ."\n";
	$cmscString = $cmscString .'	right: 0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect('.$ClipPixels.'px, auto, auto, '.$ClipPixels.'px);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmsc-Widgets-horizontal-image');
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmscString = $cmscString .'.cmsc-WidgetsContent-tb, .cmsc-WidgetsContent-bb' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	left: '.floor($BorderWidth/2).'px;' ."\n";
	$cmscString = $cmscString .'	right: '.floor($BorderWidth/2).'px;' ."\n";
	$cmscString = $cmscString .'	height: '.$BorderHeight.'px;' ."\n";
	if ($Holder) $cmscString = $cmscString ."	background-image: url('".$Holder1."');" ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";
	$cmscString = $cmscString .'.cmsc-WidgetsContent-tb' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	top: 0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect(auto, auto, '.$ClipPixels.'px, auto);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";
	
	$cmscString = $cmscString .'.cmsc-WidgetsContent-bb' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	bottom: 0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect('.$ClipPixels.'px, auto, auto, auto);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmsc-Widgets-vertical-image');
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmscString = $cmscString .'.cmsc-WidgetsContent-br, .cmsc-WidgetsContent-bl' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	top: '.floor($BorderHeight/2).'px;' ."\n";
	$cmscString = $cmscString .'	bottom: '.floor($BorderHeight/2).'px;' ."\n";
	$cmscString = $cmscString .'	width: '.$BorderWidth.'px;' ."\n";
	if ($Holder1) $cmscString = $cmscString ."	background-image: url('".$Holder1."');" ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";
	$cmscString = $cmscString .'.cmsc-WidgetsContent-br' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	right:0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect(auto, auto, auto, '.$ClipPixels.'px);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$cmscString = $cmscString .'.cmsc-WidgetsContent-bl' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	left:0;' ."\n";
	if ($ClipPixels) $cmscString = $cmscString .'	clip: rect(auto, '.$ClipPixels.'px, auto, auto);' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$Holder = cms_get_settings('cmsc-WidgetsContents-background-image');
	$Holder1 = "";
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$Holder = cms_get_settings('cmsc-WidgetsContents-background-color');
	$cmscString = $cmscString .'.cmsc-WidgetsContent-cc' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	position:absolute;' ."\n";
	$cmscString = $cmscString .'	z-index:-1;' ."\n";
	$cmscString = $cmscString .'	top: '.floor($BorderHeight/2).'px;' ."\n";
	$cmscString = $cmscString .'	left: '.floor($BorderWidth/2).'px;' ."\n";
	$cmscString = $cmscString .'	right: '.floor($BorderWidth/2).'px;' ."\n";
	$cmscString = $cmscString .'	bottom: '.floor($BorderHeight/2).'px;' ."\n";
	if ($Holder) $cmscString = $cmscString .'	background-color: '.$Holder.';' ."\n";
	if ($Holder1) $cmscString = $cmscString ."	background-image: url('".$Holder1."');" ."\n";
	$cmscString = $cmscString .'}' ."\n" ;
	$cmscString = $cmscString .'/* End Widgets Content Layout */' ."\n" ."\n";

	$cmscString = $cmscString .'/* Start Widgets Content Style */'."\n";
	$Holder1 = cms_get_settings('cmsc-WidgetsContent-text-color'); 
	$Holder2 = cms_get_settings('cmsc-WidgetsContent-font-family');
	$Holder3 = cms_get_settings('cmsc-WidgetsContent-font-size');
	$cmscString = $cmscString .'.cmsc-WidgetsContent-body' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	if ($Holder1) $cmscString = $cmscString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmscString = $cmscString .'	font-family: '.$Holder2.';' ."\n";
	if ($Holder2) $cmscString = $cmscString .'	font-size: '.$Holder3.'px;' ."\n";
	$cmscString = $cmscString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsc-WidgetsLink-text-color');
	$Holder2 = cms_get_settings('cmsc-WidgetsLink-font-family');
	$cmscString = $cmscString .'.cmsc-WidgetsContent-body a:link' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	if ($Holder1) $cmscString = $cmscString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmscString = $cmscString .'	font-family: '.$Holder2.';' ."\n";
	$cmscString = $cmscString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsc-WidgetsVisited-text-color');
	$Holder2 = cms_get_settings('cmsc-WidgetsVisited-font-family');
	$cmscString = $cmscString .'.cmsc-WidgetsContent-body a:visited, .cmsc-WidgetsContent-body a.visited' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	if ($Holder1) $cmscString = $cmscString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmscString = $cmscString .'	font-family: '.$Holder2.';' ."\n";
	$cmscString = $cmscString .'text-decoration: none;' ."\n";
	$cmscString = $cmscString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsc-WidgetsHover-text-color');
	$Holder2 = cms_get_settings('cmsc-WidgetsHover-font-family');
	$Holder3 = cms_get_settings('cmsc-WidgetsHover-background-color');
	$cmscString = $cmscString .'.cmsc-WidgetsContent-body a:hover, .cmsc-WidgetsContent-body a.hover' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	if ($Holder1) $cmscString = $cmscString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmscString = $cmscString .'	font-family: '.$Holder2.';' ."\n";
	$cmscString = $cmscString .'	text-decoration: none;' ."\n";
	if ($Holder3) $cmscString = $cmscString .'	background-color: '.$Holder3.';' ."\n";
	$cmscString = $cmscString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmsc-WidgetsList-text-color');
	$cmscString = $cmscString .'.cmsc-WidgetsContent-body ul' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	$cmscString = $cmscString .'	list-style-type: none;' ."\n";
	if ($Holder1) $cmscString = $cmscString .'	color: '.$Holder1.';' ."\n";
	$cmscString = $cmscString .'	margin:0;' ."\n";
	$cmscString = $cmscString .'	padding:0;' ."\n";
	$cmscString = $cmscString .'}'  ."\n" ."\n";
	
	$Holder1 = "";
	$Holder = cms_get_settings('cmsc-Widgets-ListBullet-image');
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
	$Holder1 = cms_get_settings('cmsc-WidgetsList-font-family');
	$Holder2 = cms_get_settings('cmsc-WidgetsList-font-size');
	$cmscString = $cmscString .'.cmsc-WidgetsContent-body ul li' ."\n";
	$cmscString = $cmscString .'{' ."\n";
	if ($Holder1) $cmscString = $cmscString .'	font-family: '.$Holder1.';' ."\n";
	if ($Holder2) $cmscString = $cmscString .'	font-size: '.$Holder2.'px;' ."\n";
	$cmscString = $cmscString .'	line-height: 125%;' ."\n";
	$cmscString = $cmscString .'	line-height: 1.25em;' ."\n";
	if ($Holder3) $cmscString = $cmscString .'	 padding: 0px 0 0px '.($ImageWidth+$ImageWidth).'px;' ."\n";
	if ($Holder3) $cmscString = $cmscString ."	background-image: url('".$Holder3."');" ."\n";
	if ($Holder3) $cmscString = $cmscString .'	background-repeat: no-repeat;' ."\n";
	$cmscString = $cmscString .'}' ."\n" ."\n";

	$cmscString = $cmscString .'/* End Widgets Content */' ."\n";

	$cmscString = $cmscString .'.cleared' ."\n";
	$cmscString = $cmscString .' {' ."\n";
	$cmscString = $cmscString .'	float: none;' ."\n";
	$cmscString = $cmscString .'	clear: both;' ."\n";
	$cmscString = $cmscString .'	margin:0 auto;' ."\n";
	$cmscString = $cmscString .'	padding: 0;' ."\n";
	$cmscString = $cmscString .'	border: none;' ."\n";
	$cmscString = $cmscString .'	font-size:1px;' ."\n";
	$cmscString = $cmscString .'}' ."\n";
	$cmscString = $cmscString .'/* End Widgets Content Style */' ."\n";
	$cmscString = $cmscString .'/* End Widgets Content Styles */' ."\n" ."\n";
	return $cmscString;
}
?>