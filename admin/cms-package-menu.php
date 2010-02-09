<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This section creates the Package area */

$OptionsPackage = array (
	array("name" => "Package your changes for deployment",
		"type" => "heading2"),

	array(
		"name" => 'Copy this code into the file in your theme folder called functions.php
					<br/> You can do this from here by going to Appearance > Editor and locate the file
					<br/> You can place these lines at the start or after any code that creates sidebars',
		"type" => "heading3"),       

	array(
		"name" => 'functions.php',
		"id" => 'functions_text',
		"type" => "textarea"),
	
	array(
		"name" => 'Copy this code into the file in your theme folder called footer.php after the <?php tag,
					<br/> You can do this from here by going to Appearance > Editor and locate the file
					<br/> You should place these lines at the start of the file after <?php and before any < div > tags',
		"type" => "heading3"),       

	array(
		"name" => 'footer.php',
		"id" => 'footer_text',
		"type" => "textarea3",
		"std" => 'Here'),

	array(
		"name" => 'Copy this code into the file in your theme folder called /cms_inc/cms-functions.php
					<br/> You can do this from here by going to Appearance > Editor and locate the file',
		"type" => "heading3"),       

	array(
		"name" => 'cms-functions.php',
		"id" => 'functions_text',
		"type" => "textarea2",
		"std" => 'Here'),
);


function cms_package_add_admin() {
	global $OptionsPackage;

    if ( $_GET['page'] == 'cmspackage') {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($OptionsPackage as $value) {
                    if($value['type'] != 'multicheck'){
                        cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            cms_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
                foreach ($OptionsPackage as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) )  cms_update_option( $up_opt, $_REQUEST[ $up_opt ] ); 
                        }
                    }
                }
				header("Location:admin.php?page=cmspackage&saved=true");
               /*die;*/
        } 
    }
}

// Create the admin form
function cms_package_admin() {
	global $OptionsPackage;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>settings saved.</strong></p></div>';
?>
<div class="wrap">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="74895MYMT6CQE">
		<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
		<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
	</form>
	<h2>CMS-Lite Package and Deploy</h2>
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

<?php foreach ($OptionsPackage as $value) {
   
    switch ( $value['type'] ) {
        case 'text':
        cms_wrapper_header($value);
        ?>
                <input style="width:150px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( cms_get_settings( $value['id'] ) != "") { echo cms_get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
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
                <select style="width:25%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
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
                <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:95%;height:80px;border-color:red"><?php
                         echo trim(cms_functions_code()); 
				?></textarea>
        <?php
       cms_wrapper_footer($value);
        break;

		 case 'textarea2':
        $ta_options = $value['options'];
        cms_wrapper_header($value);
        ?>
                <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:95%;height:500px;border-color:red"><?php
                         echo trim(cms_get_functions_code()); 
				?></textarea>
        <?php
       cms_wrapper_footer($value);
        break;
		
	case 'textarea3':
        $ta_options = $value['options'];
        cms_wrapper_header($value);
        ?>
                <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:95%;height:60px;border-color:red"><?php
                         echo trim(cms_get_footer_code()); 
				?></textarea>
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

		case "heading3":
        ?>
        <tr valign="top">
		       <td colspan="2" style="text-align: left;"><h5><?php echo $value['name']; ?><h5></td>
        </tr>
        <?php
        break;
    
        default:

        break;
    }
}
?>

		</table>

	</form>
</div>
<?php
}

add_action('admin_menu', 'cms_package_add_admin'); 

?>