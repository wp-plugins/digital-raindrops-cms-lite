<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This CMS-Lite file sets the Sidebar, Content and Panes Styles */

function css_reset_tokens($content) {
	$BeginWidget = '<!--- BEGIN Widget --->';
	$BeginWidgett = '<!--- BEGIN WidgetTitle --->';
	$EndWidgetTitle = '<!--- END WidgetTitle --->';
	$BeginWidgetc = '<!--- BEGIN WidgetContent --->';
	$EndWidgetContent = '<!--- END WidgetContent --->';
	$EndWidget = '<!--- END Widget --->';
	$result = '';
	$startBlock = 0;
	$endBlock = 0;
	while (true) {
		$startBlock = strpos($content, $BeginWidget, $endBlock);
		if (false === $startBlock) {
			$result .= substr($content, $endBlock);
			break;
		}
		$result .= substr($content, $endBlock, $startBlock - $endBlock);
		$endBlock = strpos($content, $EndWidget, $startBlock);
		if (false === $endBlock) {
			$result .= substr($content, $endBlock);
			break;
		}
		$endBlock += strlen($EndWidget);
		$widgetContent = substr($content, $startBlock, $endBlock - $startBlock);
		$beginTitlePos = strpos($widgetContent, $BeginWidgett);
		$endTitlePos = strpos($widgetContent, $EndWidgetTitle);
		if ((false == $beginTitlePos) xor (false == $endTitlePos)) {
			$widgetContent = str_replace($BeginWidgett, '', $widgetContent);
			$widgetContent = str_replace($EndWidgetTitle, '', $widgetContent);
		} else {
			$beginTitleText = $beginTitlePos + strlen($BeginWidgett);
			$titleContent = substr($widgetContent, $beginTitleText, $endTitlePos - $beginTitleText);
			if ('&nbsp;' == $titleContent) {
				$widgetContent = substr($widgetContent, 0, $beginTitlePos)
					. substr($widgetContent, $endTitlePos + strlen($EndWidgetTitle));
			}
		}
		if (false === strpos($widgetContent, $BeginWidgett)) {
			$widgetContent = str_replace($BeginWidget, $BeginWidget . $BeginWidgetc, $widgetContent);
		} else {
			$widgetContent = str_replace($EndWidgetTitle, $EndWidgetTitle . $BeginWidgetc, $widgetContent);
		}
		$result .= str_replace($EndWidget, $EndWidgetContent . $EndWidget, $widgetContent);
	}
	return $result;
}

function cms_sidebar($index = 1)
{
	if (!function_exists('dynamic_sidebar')) return false;
	ob_start();
	$success = dynamic_sidebar($index);
	$content = ob_get_clean();
	if (!$success) return false;
	$content = art_normalize_widget_style_tokens($content);
	$replaces = array(
		'<!--- BEGIN Widget --->' => "<div class=\"cmss-Widgets\">\r\n    <div class=\"cmss-Widgets-body\">\r\n",
		'<!--- BEGIN WidgetTitle --->' => "<div class=\"cmss-WidgetsHeader\">\r\n    <div class=\"l\"></div>\r\n    <div class=\"r\"></div>\r\n    <div class=\"cmss-header-tag-icon\">\r\n        <div class=\"t\">",
		'<!--- END WidgetTitle --->' => "</div>\r\n    </div>\r\n</div>",
		'<!--- BEGIN WidgetContent --->' => "<div class=\"cmss-WidgetsContent\">\r\n    <div class=\"cmss-WidgetsContent-tlc\"></div>\r\n    <div class=\"cmss-WidgetsContent-trc\"></div>\r\n    <div class=\"cmss-WidgetsContent-blc\"></div>\r\n    <div class=\"cmss-WidgetsContent-brc\"></div>\r\n    <div class=\"cmss-WidgetsContent-tb\"></div>\r\n    <div class=\"cmss-WidgetsContent-bb\"></div>\r\n    <div class=\"cmss-WidgetsContent-bl\"></div>\r\n    <div class=\"cmss-WidgetsContent-br\"></div>\r\n    <div class=\"cmss-WidgetsContent-cc\"></div>\r\n    <div class=\"cmss-WidgetsContent-body\">\r\n",
		'<!--- END WidgetContent --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n",
		'<!--- END Widget --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n"
	);
	$BeginWidgett = '<!--- BEGIN WidgetTitle --->';
	$EndWidgetTitle = '<!--- END WidgetTitle --->';
	if ('' == $replaces[$BeginWidgett] && '' == $replaces[$EndWidgetTitle]) {
		$startTitle = 0;
		$endTitle = 0;
		$result = '';
		while (true) {
			$startTitle = strpos($content, $BeginWidgett, $endTitle);
			if (false == $startTitle) {
				$result .= substr($content, $endTitle);
				break;
			}
			$result .= substr($content, $endTitle, $startTitle - $endTitle);
			$endTitle = strpos($content, $EndWidgetTitle, $startTitle);
			if (false == $endTitle) {
				$result .= substr($content, $startTitle);
				break;
			}
			$endTitle += strlen($EndWidgetTitle);
		}
		$content = $result;
	}
	$content = str_replace(array_keys($replaces), array_values($replaces), $content);
	echo $content;
	return true;
}

function cms_content($index = 1)
{
	if (!function_exists('dynamic_sidebar')) return false;
	ob_start();
	$success = dynamic_sidebar($index);
	$content = ob_get_clean();
	if (!$success) return false;
	$content = art_normalize_widget_style_tokens($content);
	$replaces = array(
		'<!--- BEGIN Widget --->' => "<div class=\"cmsc-Widgets\">\r\n    <div class=\"cmsc-Widgets-body\">\r\n",
		'<!--- BEGIN WidgetTitle --->' => "<div class=\"cmsc-WidgetsHeader\">\r\n    <div class=\"l\"></div>\r\n    <div class=\"r\"></div>\r\n    <div class=\"cmsc-header-tag-icon\">\r\n        <div class=\"t\">",
		'<!--- END WidgetTitle --->' => "</div>\r\n    </div>\r\n</div>",
		'<!--- BEGIN WidgetContent --->' => "<div class=\"cmsc-WidgetsContent\">\r\n    <div class=\"cmsc-WidgetsContent-tlc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-trc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-blc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-brc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-tb\"></div>\r\n    <div class=\"cmsc-WidgetsContent-bb\"></div>\r\n    <div class=\"cmsc-WidgetsContent-bl\"></div>\r\n    <div class=\"cmsc-WidgetsContent-br\"></div>\r\n    <div class=\"cmsc-WidgetsContent-cc\"></div>\r\n    <div class=\"cmsc-WidgetsContent-body\">\r\n",
		'<!--- END WidgetContent --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n",
		'<!--- END Widget --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n"
	);
	$BeginWidgett = '<!--- BEGIN WidgetTitle --->';
	$EndWidgetTitle = '<!--- END WidgetTitle --->';
	if ('' == $replaces[$BeginWidgett] && '' == $replaces[$EndWidgetTitle]) {
		$startTitle = 0;
		$endTitle = 0;
		$result = '';
		while (true) {
			$startTitle = strpos($content, $BeginWidgett, $endTitle);
			if (false == $startTitle) {
				$result .= substr($content, $endTitle);
				break;
			}
			$result .= substr($content, $endTitle, $startTitle - $endTitle);
			$endTitle = strpos($content, $EndWidgetTitle, $startTitle);
			if (false == $endTitle) {
				$result .= substr($content, $startTitle);
				break;
			}
			$endTitle += strlen($EndWidgetTitle);
		}
		$content = $result;
	}
	$content = str_replace(array_keys($replaces), array_values($replaces), $content);
	echo $content;
	return true;
}

function cms_footer($index = 1)
{
	if (!function_exists('dynamic_sidebar')) return false;
	ob_start();
	$success = dynamic_sidebar($index);
	$content = ob_get_clean();
	if (!$success) return false;
	$content = art_normalize_widget_style_tokens($content);
	$replaces = array(
		'<!--- BEGIN Widget --->' => "<div class=\"cmsf-Widgets\">\r\n    <div class=\"cmsf-Widgets-body\">\r\n",
		'<!--- BEGIN WidgetTitle --->' => "<div class=\"cmsf-WidgetsHeader\">\r\n    <div class=\"l\"></div>\r\n    <div class=\"r\"></div>\r\n    <div class=\"cmsf-header-tag-icon\">\r\n        <div class=\"t\">",
		'<!--- END WidgetTitle --->' => "</div>\r\n    </div>\r\n</div>",
		'<!--- BEGIN WidgetContent --->' => "<div class=\"cmsf-WidgetsContent\">\r\n    <div class=\"cmsf-WidgetsContent-tlc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-trc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-blc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-brc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-tb\"></div>\r\n    <div class=\"cmsf-WidgetsContent-bb\"></div>\r\n    <div class=\"cmsf-WidgetsContent-bl\"></div>\r\n    <div class=\"cmsf-WidgetsContent-br\"></div>\r\n    <div class=\"cmsf-WidgetsContent-cc\"></div>\r\n    <div class=\"cmsf-WidgetsContent-body\">\r\n",
		'<!--- END WidgetContent --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n",
		'<!--- END Widget --->' => "\r\n		<div class=\"cleared\"></div>\r\n    </div>\r\n</div>\r\n"
	);
	$BeginWidgett = '<!--- BEGIN WidgetTitle --->';
	$EndWidgetTitle = '<!--- END WidgetTitle --->';
	if ('' == $replaces[$BeginWidgett] && '' == $replaces[$EndWidgetTitle]) {
		$startTitle = 0;
		$endTitle = 0;
		$result = '';
		while (true) {
			$startTitle = strpos($content, $BeginWidgett, $endTitle);
			if (false == $startTitle) {
				$result .= substr($content, $endTitle);
				break;
			}
			$result .= substr($content, $endTitle, $startTitle - $endTitle);
			$endTitle = strpos($content, $EndWidgetTitle, $startTitle);
			if (false == $endTitle) {
				$result .= substr($content, $startTitle);
				break;
			}
			$endTitle += strlen($EndWidgetTitle);
		}
		$content = $result;
	}
	$content = str_replace(array_keys($replaces), array_values($replaces), $content);
	echo $content;
	return true;
}

?>