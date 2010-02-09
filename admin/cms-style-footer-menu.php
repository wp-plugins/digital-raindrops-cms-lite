<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This section is the Sidebar Style screen for the CMS-Lite */

if (cms_get_settings('TemplateImageFolder')){
	$SidebarImages = cms_get_theme_images(cms_get_settings('TemplateImageFolder'));
}else{
	$SidebarImages = cms_get_theme_images('');
}

$OptionsStyleFooter = array (
	array("name" => "Footer Styling",
		"type" => "heading2"),
		
	array(
		"name" => 'Image Folder',
		"desc" => 'Theme folder for the Sidebar style images',
		"id" => 'TemplateImageFolder',
		"type" => "text",
		"std" => '/images/'),

	array("name" => 'Fixed Height',
			"desc" => 'Enter a value if you want a fixed Height footer',
			"id" => 'footer_height',
			"type" => "numtext",
			"std" => ''),
	
	array(
		"name" => 'Number of Panes',
		"desc" => 'Enter the Number of footer widget panes the Maximum is 4',
		"id" => 'footer_count',
		"type" => "numtext",
		"std" => '0'),
	
	array(
		"name" => 'Outer Background Color',
		"desc" => 'Optional enter a color for the content background e.g #FFFFFF',
		"id" => 'cmsf-Widgets-background-color',
		"type" => "color",
		"std" => ''),

	array(
		"name" => 'Background Image',
		"desc" => 'Background image name i.e. widget_background.png',
		"id" => 'cmsf-WidgetsContents-background-image',
		"type" => "select",
		"options" => $SidebarImages,
		"std" => ""),

	array(
		"name" => 'Outer Margin',
		"desc" => 'Enter the outer margin width in pixels ie: 8',
		"id" => 'cmsf-Widgets-margin',
		"type" => "numtext",
		"std" => '0'),

	array(
		"name" => 'Inner Background Color',
		"desc" => 'Optional enter a color for the content background e.g #FFFFFF',
		"id" => 'cmsf-WidgetsContents-background-color',
		"type" => "color",
		"std" => ''),

	array("name" => "Padding or Borders",
		"type" => "heading2"),

	array(
		"name" => 'Padding',
		"desc" => 'only enter a value here if you are not using images i.e. 12',
		"id" => 'cmsf-Widgets-padding',
		"type" => "numtext",
		"std" => "0"),

	array(
		"name" => 'Corner Image',
		"desc" => 'Corner border image name i.e. 12px x 12px corner.png',
		"id" => 'cmsf-Widgets-corner-image',
		"type" => "select",
		"options" => $SidebarImages,
		"std" => ""),

	array(
		"name" => 'horizontal Image',
		"desc" => 'Top and Bottom border image name i.e. 50px x 12px horizontal.png',
		"id" => 'cmsf-Widgets-horizontal-image',
		"type" => "select",
		"options" => $SidebarImages,
		"std" => ""),

	array(
		"name" => 'Vertical Image',
		"desc" => 'left and Right border image name i.e. 12px x 50px vertical.png',
		"id" => 'cmsf-Widgets-vertical-image',
		"type" => "select",
		"options" => $SidebarImages,
		"std" => ""),

	array("name" => "Header Styling",
		"type" => "heading2"),

	array(
		"name" => 'Header Height',
		"desc" => 'Enter the header height for in pixels ie: 30',
		"id" => 'cmsf-WidgetsHeader-height',
		"type" => "numtext",
		"std" => '0'),

	array(
		"name" => 'Padding',
		"desc" => 'Enter the header left to right padding in pixels ie: 6',
		"id" => 'cmsf-WidgetsHeader-padding',
		"type" => "numtext",
		"std" => '0'),

	array(
		"name" => 'margin bottom',
		"desc" => 'Enter the the header margin bottom height in pixels ie: 7',
		"id" => 'cmsf-WidgetsHeader-margin-bottom',
		"type" => "numtext",
		"std" => '0'),
	
	array(
		"name" => 'Header Background Image',
		"desc" => 'Header background image name i.e. 1020px x 30px widgets-header.png',
		"id" => 'cmsf-WidgetsHeader-background-image',
		"type" => "select",
		"options" => $SidebarImages,
		"std" => ""),

	array(
		"name" => 'Background Color',
		"desc" => 'Optional enter a color for the header background e.g #FFFFFF',
		"id" => 'cmsf-WidgetsHeader-background-color',
		"type" => "color",
		"std" => ''),
	
	array(
		"name" => 'Header Icon Image',
		"desc" => 'Header Icon image name i.e. 12px x 20px widgets-header-icon.png',
		"id" => 'cmsf-Widgets-HeaderIcon-image',
		"type" => "select",
		"options" => $SidebarImages,
		"std" => ""),
	
	array(
		"name" => 'Header Icon outer Margin left',
		"desc" => 'Header Icon left margin in pixels ie: 5',
		"id" => 'cmsf-Widgets-HeaderIcon-margin',
		"type" => "numtext",
		"std" => "0"),

	array(
		"name" => 'Header Icon inner padding left',
		"desc" => 'Header Icon left padding in pixels ie: 20',
		"id" => 'cmsf-Widgets-HeaderIcon-padding',
		"type" => "numtext",
		"std" => "0"),

	array(
		"name" => 'Color',
		"desc" => 'Optional enter a color for the header text e.g #FFFFFF',
		"id" => 'cmsf-WidgetsHeader-text-color',
		"type" => "color",
		"std" => ''),

	array(
		"name" => 'Font Family',
		"desc" => 'Optional Header font family if required i.e. Arial, Helvetica, Sans-Serif',
		"id" => 'cmsf-WidgetsHeader-font-family',
		"type" => "text",
		"std" => ''),

	array(
		"name" => 'Font Size',
		"desc" => 'Optional Header font size if required i.e. 14',
		"id" => 'cmsf-WidgetsHeader-font-size',
		"type" => "numtext",
		"std" => ''),

	array(
		"name" => 'Font Bold',
		"desc" => 'Optional Header font weight bold required',
		"id" => 'cmsf-WidgetsHeader-font-weight',
		"type" => "checkbox",
		"std" => ''),
	

	array("name" => "Content Styling",
			"type" => "heading2"),

	array(
		"name" => 'Color',
		"desc" => 'Optional enter a color for the Content text e.g #FFFFFF',
		"id" => 'cmsf-WidgetsContent-text-color',
		"type" => "color",
		"std" => ''),

	array(
		"name" => 'Font Family',
		"desc" => 'Optional Content font family i.e. Arial, Helvetica, Sans-Serif',
		"id" => 'cmsf-WidgetsContent-font-family',
		"type" => "text",
		"std" => ''),

	array(
		"name" => 'Font Size',
		"desc" => 'Optional Content font size i.e. 14',
		"id" => 'cmsf-WidgetsContent-font-size',
		"type" => "numtext",
		"std" => ''),

	array(
		"name" => 'link Color',
		"desc" => 'Optional enter a link color for the content text e.g #FFFFFF',
		"id" => 'cmsf-WidgetsLink-text-color',
		"type" => "color",
		"std" => ''),

	array(
		"name" => 'Link Font Family',
		"desc" => 'Optional Content Link font family i.e. Arial, Helvetica, Sans-Serif',
		"id" => 'cmsf-WidgetsLink-font-family',
		"type" => "text",
		"std" => ''),

	array(
		"name" => 'Visited Color',
		"desc" => 'Optional enter a visited color for the content text e.g #FFFFFF',
		"id" => 'cmsf-WidgetsVisited-text-color',
		"type" => "color",
		"std" => ''),

	array(
		"name" => 'Visited Font Family',
		"desc" => 'Optional Content Visited font family i.e. Arial, Helvetica, Sans-Serif',
		"id" =>  'cmsf-WidgetsVisited-font-family',
		"type" => "text",
		"std" => ''),

	array(
		"name" => 'Hover Color',
		"desc" => 'Optional enter a hover color for the content text e.g #FFFFFF',
		"id" => 'cmsf-WidgetsHover-text-color',
		"type" => "color",
		"std" => ''),

	array(
		"name" => 'Hover Font Family',
		"desc" => 'Optional Content Hover font family i.e. Arial, Helvetica, Sans-Serif',
		"id" => 'cmsf-WidgetsHover-font-family',
		"type" => "text",
		"std" => ''),

	array("name" => "List Styling",
			"type" => "heading2"),

	array(
		"name" => 'List Text Colour',
		"desc" => 'Optional enter the color for the content list e.g #FFFFFF',
		"id" => 'cmsf-WidgetsList-text-color',
		"type" => "color",
		"std" => ''),
	
	array(
		"name" => 'List bullet Image',
		"desc" => 'List Bullet image name i.e. widgets-list-bullet.png',
		"id" => 'cmsf-Widgets-ListBullet-image',
		"type" => "select",
		"options" => $SidebarImages,
		"std" => ""),

	array(
		"name" => 'List Item Background Colour',
		"desc" => 'Optional enter a background color for hover on the content list items e.g #000000',
		"id" => 'cmsf-WidgetsHover-background-color',
		"type" => "color",
		"std" => ''),
	
	array(
		"name" => 'List Font Family',
		"desc" => 'Optional Content font family i.e. Arial, Helvetica, Sans-Serif',
		"id" => 'cmsf-WidgetsList-font-family',
		"type" => "text",
		"std" => ''),

	array(
		"name" => 'List Font Size',
		"desc" => 'Optional Content font size i.e. 14',
		"id" => 'cmsf-WidgetsList-font-size',
		"type" => "numtext",
		"std" => ''),
);
		
function cms_footer_style_add_admin() {
	global $OptionsStyleFooter;

    if ( $_GET['page'] == 'cmsfooterstyle') {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($OptionsStyleFooter as $value) {
                    if($value['type'] != 'multicheck'){
                        cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            cms_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
              
			       foreach ($OptionsStyleFooter as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) { cms_update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { cms_delete_option( $value['id'] ); }
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) ) { cms_update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { cms_delete_option( $up_opt ); }
                        }
                    }
                }            
			header("Location:admin.php?page=cmsfooterstyle&saved=true");	
        } 
	}
}

// Create the admin form
function cms_footer_style_admin() {
	global $OptionsStyleFooter;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>settings saved.</strong></p></div>';
?>
<div class="wrap">
	<h2>CMS-Lite Footer Styling Management</h2>
	<?php
	$catcherrors = cms_content_validate();
	if (count($catcherrors)> 1) { ?>
		<table class="form-table">
			<?php
			foreach ($catcherrors as $value){ ?>
				<li scope="row"><?php echo $value; ?></li>
			<?php } ?>
		</table>
	<?php }
	?>
	<form method="post">

		<table class="optiontable" style="width:100%;">

<?php foreach ($OptionsStyleFooter as $value) {
   
    switch ( $value['type'] ) {
        case 'text':
        cms_wrapper_header($value);
        ?>
                <input style="width:40%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( cms_get_settings( $value['id'] ) != "") { echo cms_get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
        <?php
       cms_wrapper_footer($value);
        break;

		case 'color':
        cms_wrapper_header($value);
        ?>
                <input style="width:70px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( cms_get_settings( $value['id'] ) != "") { echo cms_get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
				<input style="width: 40px; style=text-align: left; border: none; editable: false; background: <?php echo cms_get_settings( $value['id'] ); ?>" />
        <?php
       cms_wrapper_footer($value);
        break;

		case 'numtext':
        cms_wrapper_header($value);
        ?>
                <input style="width:40px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( cms_get_settings( $value['id'] ) != "") { echo cms_get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
        <?php
       cms_wrapper_footer($value);
        break;

        case 'select':
        cms_wrapper_header($value);
        ?>
                <select style="width:40%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                    <?php foreach ($value['options'] as $option) { ?>
                    <option<?php if ( cms_get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                    <?php } ?>
                </select>
        <?php
       cms_wrapper_footer($value);
        break;
       
        case 'textarea':
        $ta_options = $value['options'];
        cms_wrapper_header($value);
        ?>
                <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:100%;height:100px;"><?php
                if( cms_get_settings($value['id']) !== false) {
                        echo cms_get_settings($value['id']);
                    }else{
                        echo $value['std'];
                }?></textarea>
        <?php
       cms_wrapper_footer($value);
        break;

        case "radio":
        cms_wrapper_header($value);
       
        foreach ($value['options'] as $key=>$option) {
                $radio_setting = cms_get_settings($value['id']);
                if($radio_setting != ''){
                    if ($key == cms_get_settings($value['id']) ) {
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
        
        cms_wrapper_footer($value);
        break;
       
        case "checkbox":
        cms_wrapper_header($value);
                        if(cms_get_settings($value['id'])){
                            $checked = "checked=\"checked\"";
                        }else{
                            $checked = "";
                        }
                    ?>
                    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
        <?php
       cms_wrapper_footer($value);
        break;

        case "multicheck":
        cms_wrapper_header($value);
       
        foreach ($value['options'] as $key=>$option) {
                 $pn_key = $value['id'] . '_' . $key;
                $checkbox_setting = cms_get_settings($pn_key);
                if($checkbox_setting != ''){
                    if (cms_get_settings($pn_key) ) {
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
        
        cms_wrapper_footer($value);
        break;
       
        case "heading":
        ?>
        <tr valign="top">
		       <td colspan="2" style="text-align: left;"><h3><?php echo $value['name']; ?></h3></td>
        </tr>
        <?php
        break;
        
		case "heading2":
        ?>
        <tr valign="top">
		       <td colspan="2" style="text-align: left;"><h4><?php echo $value['name']; ?></h4></td>
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
		<textarea name="sbcodecode" style="width:100%;height:500px;border-color:red;"><?php echo get_footer_styles(); ?></textarea>
	</form>
</div>
<?php
}
add_action('admin_menu', 'cms_footer_style_add_admin'); 

?>