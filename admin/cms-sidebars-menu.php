<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This section is the introduction screen for the CMS-Lite */

$OptionsSidebars = array (
	array("name" => "Sidebar Setup",
		"type" => "heading2",
		));	
	
/* Update our Sidebar Records */
$ItemCount = cms_get_settings('sidebar_count');
if($ItemCount){
	for ( $counter = 1; $counter <= $ItemCount; $counter += 1) {
		$cmscontent = 'Sidebar ' .$counter; 
		$ItemID = 'cmssidebar' .$counter;
		$ItemWidth = $ItemID.'width';
		$cmscontentposition = $ItemID.'left';
		$cmscontentfile = $ItemID.'file';
		$cmscontentdiv = $ItemID.'div';
		array_push($OptionsSidebars, array(
			"name" => $cmscontent,
			"type" => "heading2"));        

		array_push($OptionsSidebars, array(
			"name" => 'Name',
			"desc" => 'Activate by entering a name for this Sidebar',
			"id" => $ItemID,
			"type" => "text",
			"std" => ''));

		array_push($OptionsSidebars, array(
			"name" => 'Width',
			"desc" => 'Enter the width for this sidebar in pixels',
			"id" => $ItemWidth,
			"type" => "numtext",
			"std" => '0'));
	
		array_push($OptionsSidebars, array(
			"name" => 'Left',
			"desc" => 'Select this option if your sidebar is on the Left',
			"id" => $cmscontentposition,
			"type" => "checkbox"));
	
		array_push($OptionsSidebars, array(
			"name" => 'File',
			"desc" => 'Enter the filename of an existing sidebar from the folder, sidebar.php, sidebar1.php etc:',	
			"id" => $cmscontentfile,
			"type" => "text",
			"std" => ''));
	
		array_push($OptionsSidebars, array(
			"name" => 'Div',
			"desc" => 'Enter the < div > name of an existing sidebar from the Sidebar file, sidebar.php, sidebar1.php etc:',
			"id" => $cmscontentdiv,
			"type" => "text",
			"std" => ''));
	}
}

/* Calculate the Content variable widths */
$CalcValue[]=array();
function cms_sidebars_widths(){
	if (cms_get_settings('content_layout_width')) {
		$CalcValue[]= cms_get_settings('content_layout_width'); 
	}else{
		$CalcValue[]= 0;
	}
	
	/* Get our Sidebar Widths */
	$SideBarCount = cms_get_settings('sidebar_count');
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$ItemID = 'cmssidebar' .$counter;
		$ItemWidth = $ItemID.'width';
		if (cms_get_settings($ItemWidth)) {
			$CalcValue[$counter]= cms_get_settings($ItemWidth); 
		}else{
			$CalcValue[$counter]= 0;
		}
	}
	
	
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$ItemID = 'cmssidebar'.$counter;
		$ItemOuter = $ItemID .'outer';
		$SideCount=0;
		if (cms_get_settings($ItemID)){
			if ($CalcValue[$counter] > 0){
				$ItemInner = 'cms-templateInner'.$counter;
				$a = $CalcValue[0];
				$b = $CalcValue[$counter];
				$c = 3;
				$width = (($a-$b)-$c);
				if($width <0)$width = 0;
				cms_update_option($ItemInner,$width);
				cms_update_option($ItemOuter,$width);
			}
		}
	}
	
	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		for ( $counter2 = 1; $counter2 <= $SideBarCount; $counter2 += 1) {
			if ($counter < $counter2){
				if ($CalcValue[$counter]>0 && $CalcValue[$counter2]>0){
					$ItemID = 'cms-templateInner'. $counter .$counter2 .$counter3;
					$a = $CalcValue[0];
					$b = $CalcValue[$counter]+$CalcValue[$counter2];
					$c = 3;
					$width = (($a-$b)-$c);
					if($width <0)$width = 0;
						cms_update_option($ItemID,$width);
					} else { 
						cms_update_option($ItemID,$width);
				}
			}	
		}
	}	

	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		for ( $counter2 = 1; $counter2 <= $SideBarCount; $counter2 += 1) {
			for ( $counter3 = 1; $counter3 <= $SideBarCount; $counter3 += 1) {
				if ($counter < $counter2 && $counter2 < $counter3){
					if ($CalcValue[$counter]>0 && $CalcValue[$counter2]>0){
					$ItemID = 'cms-templateInner'. $counter .$counter2 .$counter3;
					$a = $CalcValue[0];
					$b = $CalcValue[$counter]+$CalcValue[$counter2]+$CalcValue[$counter3];
					$c = 3;
					$width = (($a-$b)-$c);
					if($width <0)$width = 0;
						cms_update_option($ItemID,$width);
					} else { 
						cms_update_option($ItemID,$width);
					}
				}	
			}
		}
	}
	$ItemID = 'cms-templateInner-wide';
	$width = $CalcValue[0] - 3;
	if($width <0)$width = 0;
	cms_update_option($ItemID,$width);
}

function cms_sidebars_add_admin() {
	global $OptionsSidebars;

    if ( $_GET['page'] == 'cmssidebars') {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($OptionsSidebars as $value) {
                    if($value['type'] != 'multicheck'){
                        cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            cms_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
              
			       foreach ($OptionsSidebars as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) { cms_update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { cms_delete_option( $value['id'] ); }
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) ) { cms_update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { cms_delete_option( $up_opt ); }
                        }
                    }
                }            
			 cms_sidebars_widths();
			header("Location:admin.php?page=cmssidebars&saved=true");	
        } 
	}
}

// Create the admin form
function cms_sidebars_admin() {
	global $OptionsSidebars;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>settings saved.</strong></p></div>';
?>
<div class="wrap">
	<h2>CMS-Lite Sidebar Management</h2>
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

<?php foreach ($OptionsSidebars as $value) {
   
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
add_action('admin_menu', 'cms_sidebars_add_admin'); 

?>