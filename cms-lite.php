<?php
/*
Plugin Name: Digital Raindrops CMS Lite
Version: 0.1
Plugin URI: http://www.digitalraindrops.net/Boards/Topic.aspx?TopicID=5/
Author: David Cox (email: david.cox@digitalraindrops.net)
Author URI: http://www.digitalraindrops.net/AboutUs.aspx/
Donation URI: http://www.digitalraindrops.net/Products/10-donate-to-adeptris.aspx/
Demo URI: http://digitalraindrops.net/demo/wordpress/style-swapper/
Description: This plugin gives additional sidebars, content panes and templates for your Artisteer Theme. 
Requires at least: 2.7
Tested up to: 2.9
*/

/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit(__( "Sorry, you are not allowed to access this file directly.",'Digital Raindrops'));
}

/* Global Update for our Options Table */
function cms_update_option($key, $value){
	cms_option_update($key, (get_magic_quotes_gpc()) ? stripslashes($value) : $value);
}

// Insert or update the page style record
function cms_option_update($cmsKey, $cmsValue){
	if (!$cmsKey) return;
	global $wpdb;
	$cmstablename = $wpdb->prefix . "drf_plugins";
	$pluginname = 'cms-lite';
	$themename = stripslashes(get_current_theme());
	$theid = $wpdb->get_var("SELECT id FROM {$cmstablename} WHERE option_name = '{$cmsKey}' AND theme_name = '{$themename}'");
	if ($theid) {				
		$wpdb->query("UPDATE {$cmstablename} SET option_value = '{$cmsValue}'  WHERE id='{$theid}'");	
	} else {
		$wpdb->query("INSERT INTO {$cmstablename}
			(blog_id, plugin_name, theme_name, option_name, option_value)
			VALUES ('0', '{$pluginname}', '{$themename}', '{$cmsKey}', '{$cmsValue}')"
		);
	}
}

function cms_delete_option($cmsKey){
	global $wpdb;
	$cmstablename = $wpdb->prefix . "drf_plugins";
	$themename = stripslashes(get_current_theme());
	$theid = $wpdb->get_var("SELECT id FROM {$cmstablename} WHERE option_name = '{$cmsKey}' AND theme_name = '{$themename}'");
	if ($theid) { 
		$wpdb->query("DELETE FROM {$cmstablename} WHERE id='{$theid}'");
			}
}

// Get the page style record
function cms_get_settings($cmsOption){
	global $wpdb;
	$cmstablename = $wpdb->prefix . "drf_plugins";
	$themename = stripslashes(get_current_theme());
	$thevalue = $wpdb->get_var("SELECT option_value FROM {$cmstablename} WHERE option_name = '{$cmsOption}' AND theme_name = '{$themename}'");
	if ($thevalue) {
		return $thevalue;
	}else{	
		return "";
	}
}


function cms_wrapper_header($values){
    ?> 
    <tr valign="top">
        <th scope="row" style="width:20%;white-space: nowrap; font-weight: normal; text-align:left; padding-right:20px;"><?php echo $values['name']; ?></th>
        <td>
    <?php
}

function cms_wrapper_footer($values){
    ?>
        </td>
    </tr>
    <tr valign="top">
        <td>&nbsp;</td><td><small><?php echo $values['desc']; ?></small></td>
    </tr>
    <?php
}

function cms_get_theme_images($folderPath) {
  $jpg_ext = 'jpg';
  $png_ext = 'png';
  $dirname = $dirname = get_theme_root().'/' .get_current_theme();
   $dirname =  $dirname .$folderPath;
   if (!file_exists($dirname)){
		$imagelist[]="";
		return $imagelist;
		exit;
   }
  $imagelist[]="";
  $dir = opendir($dirname); 

  while(false != ($file = readdir($dir))) 
  { 
    if(($file != ".") and ($file != "..")) 
    { 
      $fileChunks = explode(".", $file); 
      if($fileChunks[1] == $jpg_ext || $fileChunks[1] == $png_ext) 
      {       
        $imagelist[]=$file; 
      } 
    } 
  } 
  closedir($dir);
  return $imagelist;
}

//Install
function cms_options_install () {
	require_once(dirname(__FILE__).'/admin/cms-installer.php');
	$Holder = cms_get_settings('installed_ok');
	if (!$Holder) cms_update_option('installed_ok',true);
}
register_activation_hook(__FILE__,'cms_options_install');

//Add the Admin Menus
if (is_admin()) {
	function cms_add_admin_menu() {
		add_menu_page(__("CMS-Lite", 'drcms'), __("CMS Lite", 'drcms'), 10, __FILE__, "cms_introduction_admin");
		add_submenu_page(__FILE__, __("Introduction", 'drcms'), __("Introduction", 'drcms'), 10, __FILE__, "cms_introduction_admin"); 
		add_submenu_page(__FILE__, __("Managment", 'drcms'), __("Manage Theme", 'drcms'), 10, 'cmsmanage', "cms_management_admin");
		add_submenu_page(__FILE__, __("Sidebars", 'drcms'), __("Sidebars", 'drcms'), 10, 'cmssidebars', "cms_sidebars_admin");
		add_submenu_page(__FILE__, __("Content", 'drcms'), __("Content Panes", 'drcms'), 10, 'cmscontent', "cms_content_admin");
		add_submenu_page(__FILE__, __("Options", 'drcms'), __("Option Panels", 'drcms'), 10, 'cmsoptions', "cms_options_admin");
		add_submenu_page(__FILE__, __("Style Sidebars", 'drcms'), __("Style Sidebars", 'drcms'), 10, 'cmssidebarstyle', "cms_sidebar_style_admin");
		add_submenu_page(__FILE__, __("Style Panes", 'drcms'), __("Style Panes", 'drcms'), 10, 'cmscontentstyle', "cms_content_style_admin");
		add_submenu_page(__FILE__, __("Style Footer", 'drcms'), __("Style Footer", 'drcms'), 10, 'cmsfooterstyle', "cms_footer_style_admin");
		add_submenu_page(__FILE__, __("Main Stylesheet", 'drcms'), __("Main Stylesheet", 'drcms'), 10, 'cmsstyle', "cms_style_admin");
		add_submenu_page(__FILE__, __("Templates", 'drcms'), __("Template Pages", 'drcms'), 10, 'cmstemplate', "cms_template_admin");
		add_submenu_page(__FILE__, __("Package", 'drcms'), __("Package", 'drcms'), 10, 'cmspackage', "cms_package_admin");
	}
	//Include functions and menus
	require_once(dirname(__FILE__).'/admin/cms-functions-validate.php');
	require_once(dirname(__FILE__).'/admin/cms-introduction-menu.php');
	require_once(dirname(__FILE__).'/admin/cms-management-menu.php');
	require_once(dirname(__FILE__).'/admin/cms-sidebars-menu.php');
	require_once(dirname(__FILE__).'/admin/cms-content-menu.php');
	require_once(dirname(__FILE__).'/admin/cms-options-menu.php');
	require_once(dirname(__FILE__).'/admin/cms-functions-template.php');
	require_once(dirname(__FILE__).'/admin/cms-template-menu.php');
	require_once(dirname(__FILE__).'/admin/cms-functions-css.php');
	require_once(dirname(__FILE__).'/admin/cms-css-menu.php');
	require_once(dirname(__FILE__).'/admin/cms-functions-package.php');
	require_once(dirname(__FILE__).'/admin/cms-package-menu.php'); 
	require_once(dirname(__FILE__).'/admin/css-sidebar-functions.php');
	require_once(dirname(__FILE__).'/admin/cms-style-sidebars-menu.php');
	require_once(dirname(__FILE__).'/admin/css-content-functions.php');
	require_once(dirname(__FILE__).'/admin/cms-style-contents-menu.php');
	require_once(dirname(__FILE__).'/admin/css-footer-functions.php');
	require_once(dirname(__FILE__).'/admin/cms-style-footer-menu.php');
	//Check the install is ok
	$Holder = cms_get_settings('installed_ok');
	if (!Holder){
		update_option("drf_wp_db_version", '');
		require_once(dirname(__FILE__).'/admin/cms-installer.php');
		$Holder = cms_get_settings('installed_ok');
		if (!Holder) cms_update_option('installed_ok',true);	
	}
}

if (is_admin()) { add_action('admin_menu', 'cms_add_admin_menu'); } //Admin pages

/*
Copyright 2010 David Cox (email: david.cox@digitalraindrops.net)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>