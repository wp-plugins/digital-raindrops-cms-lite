<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This section is the introduction screen for the CMS-Lite */

$OptionsManage = array (
	array(
		"name" => 'Themes Setup Values',
		"type" => "heading2"),       

	array(
		"name" => 'Name',
		"desc" => 'Enter the Content Layout name from the themes style.css<br/>For Artisteer Themes the name is .art-contentLayout from the styles.css file',
		"id" => 'content_layout_name',
		"type" => "text",
		"std" => '.art-contentLayout'),
	
	array(
		"name" => 'Width',
		"desc" => 'Enter the Content layout width here in px for your theme from the style.css',
		"id" => 'content_layout_width',
		"type" => "numtext",
		"std" => '0'),
	
	array(
		"name" => 'Number of Sidebars, Content Panes, Option Panels and Footer',
		"type" => "heading2"),       

	array(
		"name" => 'Sidebars',
		"desc" => 'Enter the Number of Sidebars including the theme sidebars the Maximum is 4',
		"id" => 'sidebar_count',
		"type" => "numtext",
		"std" => '0'),

	array(
		"name" => 'Content Panes',
		"desc" => 'Enter the number of Content Panes the Maximum is 16',
		"id" => 'content_count',
		"type" => "numtext",
		"std" => '0'),
	
	array(
		"name" => 'Option Panels',
		"desc" => 'Enter the number of Option Panels the Maximum is 10',
		"id" => 'option_count',
		"type" => "numtext",
		"std" => '0'),

	);


function cms_management_update(){
	/* Update our Contents Records */
	$ItemCount = cms_get_settings('content_count');
	if (!is_numeric($ItemCount)) $ItemCount = 0;
	cms_update_option('content_count',$ItemCount);
	if ($ItemCount > 16) $ItemCount = 16;
	for ( $counter = 1; $counter <= 16; $counter += 1) {
		$ItemID = 'content'.$counter;
		$ItemName = 'Content '.$counter;
		$ItemWidth = $ItemID .'width';
		$ItemOrder = $ItemID .'order';
		if ($counter <= $ItemCount) {	
			if (!cms_get_settings($ItemID))cms_update_option($ItemID,$ItemName);
			if (!cms_get_settings($ItemWidth))cms_update_option($ItemWidth,0);
			if (!cms_get_settings($ItemOrder))cms_update_option($ItemOrder,0);
		}else{
			cms_delete_option($ItemID);
			cms_delete_option($ItemWidth);
			cms_delete_option($ItemOrder);
		}
	}
	/* Update our Options Records */
	$ItemCount = cms_get_settings('option_count');
	if (!is_numeric($ItemCount)) $ItemCount = 0;
	if ($ItemCount > 10) $ItemCount = 10;
	cms_update_option('option_count',$ItemCount);
	for ( $counter = 1; $counter <= 16; $counter += 1) {
		$ItemID = 'option'.$counter;
		$ItemName = 'Option '.$counter;
		$ItemWidth = $ItemID .'width';
		$ItemHeight = $ItemID .'height';
		$ItemHidden = $ItemID .'hidden';
		$ItemOrder = $ItemID .'order';
		$ItemStyle = $ItemID .'style';
		$ItemText = $ItemID .'text';
		$ItemDesc = $ItemID .'text';
		if ($counter <= $ItemCount) {	
			if (!cms_get_settings($ItemID))cms_update_option($ItemID,$ItemName);
			if (!cms_get_settings($ItemWidth))cms_update_option($ItemWidth,0);
			if (!cms_get_settings($ItemHeight))cms_update_option($ItemHeight,0);
			if (!cms_get_settings($ItemHidden))cms_update_option($ItemHidden,"");
			if (!cms_get_settings($ItemOrder))cms_update_option($ItemOrder,0);
			if (!cms_get_settings($ItemStyle))cms_update_option($ItemStyle,"");
			if (!cms_get_settings($ItemText))cms_update_option($ItemText,"");
			if (!cms_get_settings($ItemDesc))cms_update_option($ItemDesc,"");

		}else{
			cms_delete_option($ItemID);
			cms_delete_option($ItemWidth);
			cms_delete_option($ItemHeight);
			cms_delete_option($ItemHidden);
			cms_delete_option($ItemOuter);
			cms_delete_option($ItemOrder);
			cms_delete_option($ItemStyle);
			cms_delete_option($ItemText);
			cms_delete_option($ItemDesc);
		}
	}
	
	/* Update our Options Records */
	$ItemCount = cms_get_settings('sidebar_count');
	if (!is_numeric($ItemCount)) $ItemCount = 0;
	if ($ItemCount > 4) $ItemCount = 4;
	cms_update_option('sidebar_count',$ItemCount);
	for ( $counter = 1; $counter <= 4; $counter += 1) {
		$ItemID = 'cmssidebar'.$counter;
		$ItemName = 'Side Bar '.$counter;
		$ItemWidth = $ItemID .'width';
		$ItemFile = $ItemID .'file';
		$ItemDiv = $ItemID .'div';
		$ItemOuter = $ItemID .'outer';
		$ItemOrder = $ItemID .'order';
		if (!cms_get_settings($ItemID)){
			cms_delete_option($ItemID);
			cms_delete_option($ItemWidth);
			cms_delete_option($ItemFile);
			cms_delete_option($ItemDiv);
			cms_delete_option($$ItemOuter);
			cms_delete_option($ItemOrder);
		}else{
			if (!cms_get_settings($ItemOuter))cms_update_option($ItemOuter,0);
			if (!cms_get_settings($ItemOrder))cms_update_option($ItemOrder,0);
		}
	}
}

/* Calculate the Content variable widths */
$CalcValue[]=array();
function cms_management_widths(){
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

function cms_management_add_admin() {
	global $OptionsManage;

    if ( $_GET['page'] == 'cmsmanage') {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($OptionsManage as $value) {
                    if($value['type'] != 'multicheck'){
                        cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            cms_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
              
			       foreach ($OptionsManage as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) { cms_update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { cms_delete_option( $value['id'] ); }
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) ) { cms_update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { cms_delete_option( $up_opt ); }
                        }
                    }
                }            
			cms_management_update();
			 cms_management_widths();
			header("Location:admin.php?page=cmsmanage&saved=true");	
        } 
	}
}

// Create the admin form
function cms_management_admin() {
	global $OptionsManage;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>settings saved.</strong></p></div>';
?>
<div class="wrap">
	<h2>CMS-Lite Management</h2>
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

<?php foreach ($OptionsManage as $value) {
   
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
add_action('admin_menu', 'cms_management_add_admin'); 

?>