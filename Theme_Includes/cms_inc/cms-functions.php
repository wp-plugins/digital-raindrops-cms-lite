<?php
/*	
This file is part of the Digital Raindrops Template Pages for WordPress Plugin
Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) 

The CSS, XHTML and design is released under GPL:
http://www.opensource.org/licenses/gpl-license.php

Instructions:
Open your functions.php file and add this line after the tag <?php

include_once(TEMPLATEPATH. '/cms-inc/cms-functions.php');

If you do not have a functions.php copy the functions.php from /cms_inc/addons/
*/

/* paste the package code in here */


/* Do not add any code in this next section */

$OptionsCount = get_option('option_count');
$SidebarCount = get_option('sidebar_count');
$ContentCount = get_option('content_count');
$FooterCount = get_option('footer_count');

$OptionsLite = array (
		array(  "name" => "HTML",
                "desc" => 'CMS Theme Options',
                "type" => "header"),
        );

if ($OptionsCount){
	for ( $counter = 1; $counter <= $OptionsCount; $counter += 1) {
		$ItemID = 'option'.$counter;
		$ItemStyleID = $ItemID.'style';
		$ItemTextID = $ItemID.'text';
		$ItemDescID = $ItemID.'desc';
		$ItemName = get_option($ItemID);
		$ItemDesc = get_option($ItemDescID);
		$ItemStyle = get_option($ItemStyleID);
		if ($ItemStyle) {
			$ItemText = get_option($ItemTextID);
			array_push($OptionsLite, array(
				"name" => $ItemName,
				"id" => $ItemTextID,
				"type" => $ItemStyle,
				"desc" => $ItemDesc,
				"std" => $ItemText));
		}
	}
}

function cms_lite_update_option($key, $value){
	update_option($key, (get_magic_quotes_gpc()) ? stripslashes($value) : $value);
}

function cms_lite_add_admin() {

    global $themename, $shortname, $OptionsLite;

    if ( $_GET['page'] == 'cmslite' ) {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($OptionsLite as $value) {
                    if($value['type'] != 'multicheck'){
                        cms_lite_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            cms_lite_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
                foreach ($OptionsLite as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) { cms_lite_update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); }
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) ) { cms_lite_update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); }
                        }
                    }
                }
                header("Location: themes.php?page=cmslite.php&saved=true");
                die;
        } 
    }

    add_theme_page("CMS Theme Options", 'CMS Theme Options', 'edit_themes', 'cmslite', 'cms_lite_admin');

}

function cms_lite_admin() {
    global $themename, $shortname, $OptionsLite;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
?>
<div class="wrap">
	<h2>CMS Theme Options</h2>

	<form method="post">

		<table class="optiontable" style="width:100%;">

<?php foreach ($OptionsLite as $value) {
   
    switch ( $value['type'] ) {
        case 'text':
        cms_lite_wrapper_header($value);
        ?>
                <input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
        <?php
        cms_lite_wrapper_footer($value);
        break;
	
		case 'text2':
        cms_lite_wrapper_header($value);
        ?>
                <input style="width:70%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
        <?php
        cms_lite_wrapper_footer($value);
        break;
  
        case 'select':
        cms_lite_wrapper_header($value);
        ?>
                <select style="width:70%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                    <?php foreach ($value['options'] as $option) { ?>
                    <option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                    <?php } ?>
                </select>
        <?php
        cms_lite_wrapper_footer($value);
        break;
       
        case 'textarea':
        $ta_options = $value['options'];
        cms_lite_wrapper_header($value);
        ?>
                <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:100%;height:100px;"><?php
                if( get_option($value['id']) !== false) {
                        echo get_option($value['id']);
                    }else{
                        echo $value['std'];
                }?></textarea>
        <?php
        cms_lite_wrapper_footer($value);
        break;

        case "radio":
        cms_lite_wrapper_header($value);
       
        foreach ($value['options'] as $key=>$option) {
                $radio_setting = get_option($value['id']);
                if($radio_setting != ''){
                    if ($key == get_option($value['id']) ) {
                        $checked = "checked=\"checked\"";
                        } else {
                            $checked = "";
                        }
                }else{
                    if($key == $value['std']){
                        $checked = "checked=\"checked\"";
                    }else{
                        $checked = "";
                    }
                }?>
                <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
        <?php
        }
        
        cms_lite_wrapper_footer($value);
        break;
       
        case "checkbox":
        cms_lite_wrapper_header($value);
                        if(get_option($value['id'])){
                            $checked = "checked=\"checked\"";
                        }else{
                            $checked = "";
                        }
                    ?>
                    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
        <?php
        cms_lite_wrapper_footer($value);
        break;

        case "multicheck":
        cms_lite_wrapper_header($value);
       
        foreach ($value['options'] as $key=>$option) {
                 $pn_key = $value['id'] . '_' . $key;
                $checkbox_setting = get_option($pn_key);
                if($checkbox_setting != ''){
                    if (get_option($pn_key) ) {
                        $checked = "checked=\"checked\"";
                        } else {
                            $checked = "";
                        }
                }else{
                    if($key == $value['std']){
                        $checked = "checked=\"checked\"";
                    }else{
                        $checked = "";
                    }
                }?>
                <input type="checkbox" name="<?php echo $pn_key; ?>" id="<?php echo $pn_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $pn_key; ?>"><?php echo $option; ?></label><br />
        <?php
        }
        
        cms_lite_wrapper_footer($value);
        break;
       
        case "heading":
        ?>
        <tr valign="top">
            <td colspan="2" style="text-align: center;"><h3><?php echo $value['name']; ?></h3></td>
        </tr>
        <?php
        break;
       
        default:

        break;
    }
}
?>

		</table>

		<p class="submit">
			<input name="save" type="submit" value="Save changes" />
			<input type="hidden" name="action" value="save" />
		</p>
	</form>
</div>
<?php
}

function cms_lite_wrapper_header($values){
    ?>
    <tr valign="top">
        <th scope="row" style="width:1%;white-space: nowrap;"><?php echo $values['name']; ?></th>
        <td>
    <?php
}

function cms_lite_wrapper_footer($values){
    ?>
        </td>
    </tr>
    <tr valign="top">
        <td>&nbsp;</td><td><small><?php echo $values['desc']; ?></small></td>
    </tr>
    <?php
}


add_action('admin_menu', 'cms_lite_add_admin'); 



function cms_stylesheet() {
if(file_exists(TEMPLATEPATH.'/cms-layout.css')) ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/cms-layout.css" type="text/css" media="screen" />
<?php if(file_exists(TEMPLATEPATH.'/cms-style.css')) ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/cms-style.css" type="text/css" media="screen" />
<?php if(file_exists(TEMPLATEPATH.'/cms-custom.css')) ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/cms-custom.css" type="text/css" media="screen" />
<?php }

add_action('wp_print_styles', 'cms_stylesheet');

for ( $counter = 1; $counter <= $SidebarCount; $counter += 1) {
	$ItemID = 'cmssidebar' .$counter;
	$ItemName = get_option($ItemID);
	if ($ItemName){
		if (function_exists('register_sidebars')) {
			register_sidebars(1, array(
				'name' => $ItemName,
				'before_widget' => '<div id="%1$s" class="widget %2$s">'.'<!--- BEGIN Widget --->',
				'before_title' => '<!--- BEGIN WidgetTitle --->',
				'after_title' => '<!--- END WidgetTitle --->',
				'after_widget' => '<!--- END Widget --->'.'</div>'
				));
		}
	}
}

for ( $counter = 1; $counter <= $ContentCount; $counter += 1) {
	$ItemID = 'content' .$counter;
	$ItemName = get_option($ItemID);
	if ($ItemName){
		if (function_exists('register_sidebars')) {
			register_sidebars(1, array(
				'name' => $ItemName,
				'before_widget' => '<div id="%1$s" class="widget %2$s">'.'<!--- BEGIN Widget --->',
				'before_title' => '<!--- BEGIN WidgetTitle --->',
				'after_title' => '<!--- END WidgetTitle --->',
				'after_widget' => '<!--- END Widget --->'.'</div>'
				));
		}
	}
}
 
if ($FooterCount) {
	if (function_exists('register_sidebars')) {
		register_sidebars($FooterCount, array(
			'name' => 'Footer %d',
			'before_widget' => '<div id="%1$s" class="widget %2$s">'.'<!--- BEGIN Widget --->',
			'before_title' => '<!--- BEGIN WidgetTitle --->',
			'after_title' => '<!--- END WidgetTitle --->',
			'after_widget' => '<!--- END Widget --->'.'</div>'
		));
	}	
}
?>