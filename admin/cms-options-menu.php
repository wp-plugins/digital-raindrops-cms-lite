<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This CSM-Lite section manages the Options Panes */

$OptionsCount= cms_get_settings('option_count');
$OptionsOptions = array (
	array("name" => "Manage the Options Names, and Width settings here",
		"type" => "heading2")
		);
	
if ($OptionsCount>0){
	for ( $counter = 1; $counter <= $OptionsCount; $counter += 1) {
		$cmsOptionName = 'Options Panel ' .$counter; 
		$cmsOptionsid = 'option' .$counter;
		$cmsOptionWidth = $cmsOptionsid .'width';
		$cmsOptionHeight = $cmsOptionsid .'height';
		$cmsOptionInput = $cmsOptionsid .'input';
		$cmsOptionStyle = $cmsOptionsid .'style';
		$cmsOptionText = $cmsOptionsid .'text';
		$cmsOptionDesc = $cmsOptionsid .'desc';

		array_push($OptionsOptions, array(
			"name" => $cmsOptionName,
			"type" => "heading2"));        

		array_push($OptionsOptions, array(
			"name" => 'Name',
			"desc" => 'Enter a name for this Options Panel',
			"id" => $cmsOptionsid,
			"type" => "text",
			"std" => $cmsOptionName));
		
		array_push($OptionsOptions, array(
			"name" => 'Width',
			"desc" => 'You may enter the width for this Panel',
			"id" => $cmsOptionWidth,
			"type" => "numtext",
			"std" => 0));
		
		array_push($OptionsOptions, array(
			"name" => 'Height',
			"desc" => 'You may enter the height for this Panel',
			"id" => $cmsOptionHeight,
			"type" => "numtext",
			"std" => 0));

		array_push($OptionsOptions, array(
			"name" => 'User Input',
			"desc" => 'Select if the admin has to update the text like for AdSense',
			"id" => $cmsOptionInput,
			"type" => "checkbox"));
		
		array_push($OptionsOptions, array(
			"name" => 'Input Style',
			"desc" => 'Select if the input text requires a text area like AdSense leave unchecked for text box',
			"id" => $cmsOptionStyle,
			"type" => "checkbox"));
		
		array_push($OptionsOptions, array(
			"name" => 'Default Text',
			"desc" => 'Enter some default text for the admin text for this option',
			"id" => $cmsOptionText,
			"type" => "text"));
		
		array_push($OptionsOptions, array(
			"name" => 'Help Text',
			"desc" => 'Enter some text for the admin to describe this option',
			"id" => $cmsOptionDesc,
			"type" => "text"));
	}
}

function cms_options_add_admin() {
	global $OptionsOptions;

    if ( $_GET['page'] == 'cmsoptions') {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($OptionsOptions as $value) {
                    if($value['type'] != 'multicheck'){
                        cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            cms_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
                foreach ($OptionsOptions as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) )  cms_update_option( $up_opt, $_REQUEST[ $up_opt ] ); 
                        }
                    }
                }
				header("Location:admin.php?page=cmsoptions&saved=true");
               /*die;*/
        } 
    }
}

// Create the admin form
function cms_Options_admin() {
	global $OptionsOptions;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>settings saved.</strong></p></div>';
?>
<div class="wrap">
	<h2>CMS-Lite Options Panel Management</h2>
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

<?php foreach ($OptionsOptions as $value) {
   
    switch ( $value['type'] ) {
        case 'text':
        cms_wrapper_header($value);
        ?>
                <input style="width:50%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( cms_get_settings( $value['id'] ) != "") { echo cms_get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
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
	</form>
</div>
<?php
}

add_action('admin_menu', 'cms_options_add_admin'); 

?>