<?php
/*		
'<!--- BEGIN Widget --->' => "<div class=\"cmss-Widgets\">\r\n    <div class=\"cmss-Widgets-body\">\r\n",
'<!--- BEGIN WidgetTitle --->' => "<div class=\"cmss-WidgetsHeader\">\r\n    <div class=\"l\"></div>\r\n    <div class=\"r\"></div>\r\n    <div class=\"cmss-header-tag-icon\">\r\n        <div class=\"t\">",
'<!--- END WidgetTitle --->' => "</div>\r\n    </div>\r\n</div>",
'<!--- BEGIN WidgetContent --->' => "<div class=\"cmss-WidgetsContent\">\r\n    <div class=\"cmss-WidgetsContent-tlc\"></div>\r\n    <div class=\"cmss-WidgetsContent-trc\"></div>\r\n    <div class=\"cmss-WidgetsContent-blc\"></div>\r\n    <div class=\"cmss-WidgetsContent-brc\"></div>\r\n    <div class=\"cmss-WidgetsContent-tb\"></div>\r\n    <div class=\"cmss-WidgetsContent-bb\"></div>\r\n    <div class=\"cmss-WidgetsContent-bl\"></div>\r\n    <div class=\"cmss-WidgetsContent-br\"></div>\r\n    <div class=\"cmss-WidgetsContent-cc\"></div>\r\n    <div class=\"cmss-WidgetsContent-body\">\r\n",
'<!--- END WidgetContent --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n",
'<!--- END Widget --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n"

*/

function get_sidebar_styles(){
	/* Get the defaults and Style the Container */
	$FilePath = cms_get_settings('TemplateImageFolder');
	if (!$FilePath) $FilePath = '/';
	$ClipHeaderPixels = cms_get_settings('cmss-Widgets-header-clipping');
	if (!is_numeric($ClipHeaderPixels) || ($ClipHeaderPixels <0)) $ClipHeaderPixels = 1;
	$ClipPixels =  cms_get_settings('cmss-Widgets-corner-clipping');
	if (!is_numeric($ClipPixels) || ($ClipPixels <0)) $ClipPixels = 0;
	$BoxPadding = cms_get_settings('cmss-Widgets-padding');
	if (!is_numeric($BoxPadding) || ($BoxPadding <0)) $BoxPadding = 0;
	
	$ImageWidth = 0;
	$ImageHeight = 0;
	$HeaderHeight = 0;

	$BorderHeight = $BoxPadding;
	$BorderWidth = $BoxPadding;
	$ThemeName = stripslashes(get_current_theme());

	/* Check if we want to use a header */
	$Height = cms_get_settings('cmss-WidgetsHeader-height');
	if (is_numeric($Height)) $HeaderHeight = $Height;
	$Holder = cms_get_settings('cmss-WidgetsHeader-background-image');
	if ($Holder) {
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
				$image = getimagesize($FileName1);
				$HeaderHeight = $image[1];
			}
			cms_update_option('cmss-WidgetsHeader-height',$HeaderHeight);
		}
	}

	/* Check our image sizes are OK */
	$Holder = cms_get_settings('cmss-Widgets-corner-image');
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
		$Holder = cms_get_settings('cmss-Widgets-horizontal-image');
		if (!$Holder) return 'You must specify a horizontal border image if you have a corner image selected';
		$FileName1 = get_theme_root() .'/' .$ThemeName .$FilePath .$Holder;
		if (file_exists($FileName1)){
			if ( function_exists('getimagesize') ) {
	  			$image = getimagesize($FileName1);
	  			$ImageHeight = $image[1];
			}
			if ($ImageHeight != $BorderHeight) return 'Horizontal image height '.$ImageHeight.'px must match the height of the corner image '.$BorderHeight.'px';
		}
	
		$Holder = cms_get_settings('cmss-Widgets-vertical-image');
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
	
	$cmssString = $cmssString . '/* Begin Styling of Sidebars Widgets */' ."\n";
	$cmssString = $cmssString .'/* Start Widgets Container */' ."\n"."\n";
	
	/* Style the Outer Container */
	$cmssString = $cmssString .'.cmss-Widgets' ."\n";
	$cmssString = $cmssString .'{'."\n";
	$cmssString = $cmssString .'	position:relative;' ."\n";
	$cmssString = $cmssString .'	z-index:0;' ."\n";
	$cmssString = $cmssString .'	margin: 0 auto;' ."\n";
	$cmssString = $cmssString .'	min-width:'.$BorderWidth.'px;' ."\n";
	$cmssString = $cmssString .'	min-height:'.$BorderHeight.'px;' ."\n";
	$cmssString = $cmssString .'} ' ."\n" ."\n";

	$cmssString = $cmssString .'.cmss-Widgets-body' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	position: relative;' ."\n";
	$cmssString = $cmssString .'	z-index: 1;' ."\n";
	$cmssString = $cmssString .'	padding: 0px;' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$Holder = cms_get_settings('cmss-Widgets-margin');
	if (is_numeric($Holder) && $Holder != 0) {
		$cmssString = $cmssString .'.cmss-Widgets' ."\n";
		$cmssString = $cmssString .'{'."\n";
		$cmssString = $cmssString .'	margin: '.$Holder.'px;' ."\n";
		$cmssString = $cmssString .'} ' ."\n" ."\n";
	}

	$cmssString = $cmssString .'/* End Widgets Container */' ."\n"."\n";

	$cmssString = $cmssString .'/* Begin Widgets Header */' ."\n";
	if ($HeaderHeight) {
		$Holder2 = cms_get_settings('cmss-WidgetsHeader-padding');
		if (!is_numeric($Holder2) || ($Holder2 <0)) $Holder2 = 0;
		$Holder3 = cms_get_settings('cmss-WidgetsHeader-margin-bottom');
		if (!is_numeric($Holder3) || ($Holder3 <0)) $Holder3 = 0;

		$cmssString = $cmssString .'.cmss-WidgetsHeader' ."\n";
		$cmssString = $cmssString .'{' ."\n";
		$cmssString = $cmssString .'	position:relative;' ."\n";
		$cmssString = $cmssString .'	z-index:0;' ."\n";
		$cmssString = $cmssString .'	overflow: hidden;'."\n";
		$cmssString = $cmssString .'	height: '.$HeaderHeight.'px;' ."\n";
		$cmssString = $cmssString .'	padding: 0 '.$Holder2.'px;' ."\n";
		$cmssString = $cmssString .'	margin-bottom: '.$Holder3.'px;' ."\n";	
		$cmssString = $cmssString .'}' ."\n" ."\n";

		$cmssString = $cmssString .'.cmss-WidgetsHeader .t' ."\n";
		$cmssString = $cmssString .'{' ."\n";
		$cmssString = $cmssString .'	height: '.$HeaderHeight.'px;' ."\n";
		$Holder1 = cms_get_settings('cmss-WidgetsHeader-text-color');
		if ($Holder1) $cmssString = $cmssString .'	color: '.$Holder1.';' ."\n";
		$Holder2 = cms_get_settings('cmss-WidgetsHeader-font-family');
		if ($Holder2) $cmssString = $cmssString .'	font-family: '.$Holder2.';' ."\n";
		$Holder3 = cms_get_settings('cmss-WidgetsHeader-font-size');
		if ($Holder3) $cmssString = $cmssString .'	font-size: '.$Holder3.'px;' ."\n";
		$Holder4 = cms_get_settings('cmss-WidgetsHeader-font-weight');
		if ($Holder4) $cmssString = $cmssString .'	font-weight: bold;' ."\n";
		$cmssString = $cmssString .'	white-space : nowrap;' ."\n";
		$cmssString = $cmssString .'	padding: 0 1px;' ."\n";
		$cmssString = $cmssString .'	line-height: '.$HeaderHeight.'px;' ."\n";	
		$cmssString = $cmssString .'}' ."\n"."\n";

		$Holder = cms_get_settings('cmss-WidgetsHeader-background-image');
		$Holder1 = "";
		if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
		$Holder2 = cms_get_settings('cmss-WidgetsHeader-background-color');
		$cmssString = $cmssString .'.cmss-WidgetsHeader .l, .cmss-WidgetsHeader .r' ."\n";
		$cmssString = $cmssString .'{' ."\n";
		$cmssString = $cmssString .'	display:block;' ."\n";
		$cmssString = $cmssString .'	position:absolute;' ."\n";
		$cmssString = $cmssString .'	z-index:-1;' ."\n";
		$cmssString = $cmssString .'	height: '.$HeaderHeight.'px;' ."\n";
		if ($Holder2) $cmssString = $cmssString .'	background-color: '.$Holder2.';' ."\n";
		if ($Holder1) $cmssString = $cmssString ."	background-image: url('".$Holder1."');" ."\n";
		$cmssString = $cmssString .'}' ."\n" ."\n";

		$cmssString = $cmssString .'.cmss-WidgetsHeader .l' ."\n";
		$cmssString = $cmssString .'{' ."\n";
		$cmssString = $cmssString .'	left: 0;' ."\n";
		if ($ClipHeaderPixels) $cmssString = $cmssString .'	right: '.$ClipHeaderPixels.'px;' ."\n";
		$cmssString = $cmssString .'}' ."\n" ."\n";
		
		$WideClip = cms_get_settings('content_layout_width');
		if ($ClipHeaderPixels) {
			$Holder = cms_get_settings('cmss-WidgetsHeader-background-image');
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
		$cmssString = $cmssString .'.cmss-WidgetsHeader .r' ."\n";
		$cmssString = $cmssString .'{' ."\n";
		$cmssString = $cmssString .'	width:'.$WideClip.'px;' ."\n";
		$cmssString = $cmssString .'	right:0;' ."\n";
		if ($ClipHeaderPixels) $WideClip = ($WideClip - $ClipHeaderPixels);
		if ($ClipHeaderPixels) $cmssString = $cmssString .'	clip: rect(auto, auto, auto, '.$WideClip.'px);' ."\n";
		$cmssString = $cmssString .'}' ."\n" ."\n";	
		
		$Holder = cms_get_settings('cmss-Widgets-HeaderIcon-image');
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
			$cmssString = $cmssString .'.cmss-header-tag-icon' ."\n";
			$cmssString = $cmssString .'{' ."\n";
    		$cmssString = $cmssString .'	height: '.$HeaderHeight.'px;' ."\n";
			$cmssString = $cmssString .'	background-position:left top; ' ."\n";
			$cmssString = $cmssString ."	background-image: url('".$Holder1."');" ."\n";
			$Holder = cms_get_settings('cmss-Widgets-HeaderIcon-padding');
			if (!is_numeric($Holder) || ($Holder <0)) $Holder = 0;
			if ($Holder) $cmssString = $cmssString .'padding:0 0 0 '.$Holder.'px;' ."\n";
			$cmssString = $cmssString .'	background-repeat: no-repeat;' ."\n";
			$cmssString = $cmssString .'	min-height: '.floor(($HeaderHeight/3)+2).'px;' ."\n";
			$Holder = cms_get_settings('cmss-Widgets-HeaderIcon-margin');
			if (!is_numeric($Holder) || ($Holder <0)) $Holder = 0;
			$cmssString = $cmssString .'	margin: 0 0 0 5px;' ."\n";
			$cmssString = $cmssString .'}' ."\n" ."\n";	
		}
		$cmssString = $cmssString .' /* End Widget Header layout */' ."\n" ."\n";
	}

	/* Layout the content */
	$cmssString = $cmssString .'/* Begin Widgets Content Layout */' ."\n";
	$cmssString = $cmssString .'.cmss-WidgetsContent' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	position:relative;' ."\n";
	$cmssString = $cmssString .'	z-index:0;' ."\n";
	$cmssString = $cmssString .'	margin:0 auto;' ."\n";
	$cmssString = $cmssString .'	min-width:13px;' ."\n";
	$cmssString = $cmssString .'	min-height:13px;' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$cmssString = $cmssString .'.cmss-WidgetsContent-trc, .cmss-WidgetsContent-tlc, .cmss-WidgetsContent-brc, .cmss-WidgetsContent-blc' ."\n"; 
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	position:absolute;' ."\n";
	$cmssString = $cmssString .'	z-index:-1;' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$cmssString = $cmssString .'.cmss-WidgetsContent-tb, .cmss-WidgetsContent-bb,.cmss-WidgetsContent-br, .cmss-WidgetsContent-bl' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	position:absolute;' ."\n";
	$cmssString = $cmssString .'	z-index:-1;' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$Holder2 = cms_get_settings('cmss-WidgetsContent-padding');
	if (!is_numeric($Holder2) || ($Holder2 <0)) $Holder2 = 0;
	$cmssString = $cmssString .'.cmss-WidgetsContent-body' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	position: relative;' ."\n";
	$cmssString = $cmssString .'	z-index: 1;' ."\n";
	$cmssString = $cmssString .'	padding: '.$Holder2.'px;' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmss-Widgets-corner-image');
	$Holder1 = "";
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmssString = $cmssString .'/* Begin Widgets Container Borders */' ."\n";
	$cmssString = $cmssString .'.cmss-WidgetsContent-trc, .cmss-WidgetsContent-tlc, .cmss-WidgetsContent-brc, .cmss-WidgetsContent-blc' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	width: '.$BorderWidth.'px;' ."\n";
	$cmssString = $cmssString .'	height: '.$BorderHeight.'px;' ."\n";
	if ($Holder1) $cmssString = $cmssString ."	background-image: url('".$Holder1."');" ."\n";
	$cmssString = $cmssString .'}' ."\n";
	$cmssString = $cmssString .'.cmss-WidgetsContent-tlc' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	top:0;' ."\n";
	$cmssString = $cmssString .'	left:0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect(auto, '.$ClipPixels.'px, '.$ClipPixels.'px, auto);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$cmssString = $cmssString .'.cmss-WidgetsContent-trc' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	top: 0;' ."\n";
	$cmssString = $cmssString .'	right: 0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect(auto, auto, '.$ClipPixels.'px, '.$ClipPixels.'px);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";
		
	$cmssString = $cmssString .'.cmss-WidgetsContent-blc' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	bottom: 0;' ."\n";
	$cmssString = $cmssString .'	left: 0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect('.$ClipPixels.'px, '.$ClipPixels.'px, auto, auto);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$cmssString = $cmssString .'.cmss-WidgetsContent-brc' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	bottom: 0;' ."\n";
	$cmssString = $cmssString .'	right: 0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect('.$ClipPixels.'px, auto, auto, '.$ClipPixels.'px);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmss-Widgets-horizontal-image');
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmssString = $cmssString .'.cmss-WidgetsContent-tb, .cmss-WidgetsContent-bb' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	left: '.floor($BorderWidth/2).'px;' ."\n";
	$cmssString = $cmssString .'	right: '.floor($BorderWidth/2).'px;' ."\n";
	$cmssString = $cmssString .'	height: '.$BorderHeight.'px;' ."\n";
	if ($Holder) $cmssString = $cmssString ."	background-image: url('".$Holder1."');" ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";
	$cmssString = $cmssString .'.cmss-WidgetsContent-tb' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	top: 0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect(auto, auto, '.$ClipPixels.'px, auto);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";
	
	$cmssString = $cmssString .'.cmss-WidgetsContent-bb' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	bottom: 0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect('.$ClipPixels.'px, auto, auto, auto);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";
	
	$Holder = cms_get_settings('cmss-Widgets-vertical-image');
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$cmssString = $cmssString .'.cmss-WidgetsContent-br, .cmss-WidgetsContent-bl' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	top: '.floor($BorderHeight/2).'px;' ."\n";
	$cmssString = $cmssString .'	bottom: '.floor($BorderHeight/2).'px;' ."\n";
	$cmssString = $cmssString .'	width: '.$BorderWidth.'px;' ."\n";
	if ($Holder1) $cmssString = $cmssString ."	background-image: url('".$Holder1."');" ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";
	$cmssString = $cmssString .'.cmss-WidgetsContent-br' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	right:0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect(auto, auto, auto, '.$ClipPixels.'px);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$cmssString = $cmssString .'.cmss-WidgetsContent-bl' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	left:0;' ."\n";
	if ($ClipPixels) $cmssString = $cmssString .'	clip: rect(auto, '.$ClipPixels.'px, auto, auto);' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$Holder = cms_get_settings('cmss-WidgetsContents-background-image');
	$Holder1 = "";
	if ($Holder) $Holder1 = substr($FilePath, 1) .$Holder;
	$Holder = cms_get_settings('cmss-WidgetsContents-background-color');
	$cmssString = $cmssString .'.cmss-WidgetsContent-cc' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	position:absolute;' ."\n";
	$cmssString = $cmssString .'	z-index:-1;' ."\n";
	$cmssString = $cmssString .'	top: '.floor($BorderHeight/2).'px;' ."\n";
	$cmssString = $cmssString .'	left: '.floor($BorderWidth/2).'px;' ."\n";
	$cmssString = $cmssString .'	right: '.floor($BorderWidth/2).'px;' ."\n";
	$cmssString = $cmssString .'	bottom: '.floor($BorderHeight/2).'px;' ."\n";
	if ($Holder) $cmssString = $cmssString .'	background-color: '.$Holder.';' ."\n";
	if ($Holder1) $cmssString = $cmssString ."	background-image: url('".$Holder1."');" ."\n";
	$cmssString = $cmssString .'}' ."\n" ;
	$cmssString = $cmssString .'/* End Widgets Content Layout */' ."\n" ."\n";

	$cmssString = $cmssString .'/* Start Widgets Content Style */'."\n";
	$Holder1 = cms_get_settings('cmss-WidgetsContent-text-color'); 
	$Holder2 = cms_get_settings('cmss-WidgetsContent-font-family');
	$Holder3 = cms_get_settings('cmss-WidgetsContent-font-size');
	$cmssString = $cmssString .'.cmss-WidgetsContent-body' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	if ($Holder1) $cmssString = $cmssString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmssString = $cmssString .'	font-family: '.$Holder2.';' ."\n";
	if ($Holder2) $cmssString = $cmssString .'	font-size: '.$Holder3.'px;' ."\n";
	$cmssString = $cmssString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmss-WidgetsLink-text-color');
	$Holder2 = cms_get_settings('cmss-WidgetsLink-font-family');
	$cmssString = $cmssString .'.cmss-WidgetsContent-body a:link' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	if ($Holder1) $cmssString = $cmssString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmssString = $cmssString .'	font-family: '.$Holder2.';' ."\n";
	$cmssString = $cmssString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmss-WidgetsVisited-text-color');
	$Holder2 = cms_get_settings('cmss-WidgetsVisited-font-family');
	$cmssString = $cmssString .'.cmss-WidgetsContent-body a:visited, .cmss-WidgetsContent-body a.visited' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	if ($Holder1) $cmssString = $cmssString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmssString = $cmssString .'	font-family: '.$Holder2.';' ."\n";
	$cmssString = $cmssString .'text-decoration: none;' ."\n";
	$cmssString = $cmssString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmss-WidgetsHover-text-color');
	$Holder2 = cms_get_settings('cmss-WidgetsHover-font-family');
	$Holder3 = cms_get_settings('cmss-WidgetsHover-background-color');
	$cmssString = $cmssString .'.cmss-WidgetsContent-body a:hover, .cmss-WidgetsContent-body a.hover' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	if ($Holder1) $cmssString = $cmssString .'	color: '.$Holder1.';' ."\n";
	if ($Holder2) $cmssString = $cmssString .'	font-family: '.$Holder2.';' ."\n";
	$cmssString = $cmssString .'	text-decoration: none;' ."\n";
	if ($Holder3) $cmssString = $cmssString .'	background-color: '.$Holder3.';' ."\n";
	$cmssString = $cmssString .'}'  ."\n"."\n";

	$Holder1 = cms_get_settings('cmss-WidgetsList-text-color');
	$cmssString = $cmssString .'.cmss-WidgetsContent-body ul' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	$cmssString = $cmssString .'	list-style-type: none;' ."\n";
	if ($Holder1) $cmssString = $cmssString .'	color: '.$Holder1.';' ."\n";
	$cmssString = $cmssString .'	margin:0;' ."\n";
	$cmssString = $cmssString .'	padding:0;' ."\n";
	$cmssString = $cmssString .'}'  ."\n" ."\n";
	
	$Holder1 = "";
	$Holder = cms_get_settings('cmss-Widgets-ListBullet-image');
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
	$Holder1 = cms_get_settings('cmss-WidgetsList-font-family');
	$Holder2 = cms_get_settings('cmss-WidgetsList-font-size');
	$cmssString = $cmssString .'.cmss-WidgetsContent-body ul li' ."\n";
	$cmssString = $cmssString .'{' ."\n";
	if ($Holder1) $cmssString = $cmssString .'	font-family: '.$Holder1.';' ."\n";
	if ($Holder2) $cmssString = $cmssString .'	font-size: '.$Holder2.'px;' ."\n";
	$cmssString = $cmssString .'	line-height: 125%;' ."\n";
	$cmssString = $cmssString .'	line-height: 1.25em;' ."\n";
	if ($Holder3) $cmssString = $cmssString .'	 padding: 0px 0 0px '.($ImageWidth+$ImageWidth).'px;' ."\n";
	if ($Holder3) $cmssString = $cmssString ."	background-image: url('".$Holder3."');" ."\n";
	if ($Holder3) $cmssString = $cmssString .'	background-repeat: no-repeat;' ."\n";
	$cmssString = $cmssString .'}' ."\n" ."\n";

	$cmssString = $cmssString .'/* End Widgets Content */' ."\n";

	$cmssString = $cmssString .'.cleared' ."\n";
	$cmssString = $cmssString .' {' ."\n";
	$cmssString = $cmssString .'	float: none;' ."\n";
	$cmssString = $cmssString .'	clear: both;' ."\n";
	$cmssString = $cmssString .'	margin:0 auto;' ."\n";
	$cmssString = $cmssString .'	padding: 0;' ."\n";
	$cmssString = $cmssString .'	border: none;' ."\n";
	$cmssString = $cmssString .'	font-size:1px;' ."\n";
	$cmssString = $cmssString .'}' ."\n";
	$cmssString = $cmssString .'/* End Widgets Content Style */' ."\n";
	$cmssString = $cmssString .'/* End Widgets Sidebar Styles */' ."\n" ."\n";
	return $cmssString;
}
?>