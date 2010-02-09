<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This section creates the admin page Content Panes area */

$SideBarCount = cms_get_settings('sidebar_count');
if (cms_get_settings('content_layout_width')) {
	$CalcValue[]= cms_get_settings('content_layout_width'); 
}else{
	$CalcValue[]= 0;
}
$ItemInner[] = 'Please Select a Layout';

/* Get our Sidebar Widths */
for ( $counter = 1; $counter <= 4; $counter += 1) {
	$ItemID = 'cmssidebar' .$counter;
	$ItemWidth = $ItemID.'width';
	if (cms_get_settings($ItemWidth)) {
		$CalcValue[$counter]= cms_get_settings($ItemWidth); 
	}else{
		$CalcValue[$counter]= 0;
	}
}

for ( $counter = 1; $counter <= 4; $counter += 1) {
	$ItemID = 'cmssidebar'.$counter;
	if (cms_get_settings($ItemID)){
		if ($CalcValue[$counter] > 0){
			$ItemInner[] = 'cms-templateInner'.$counter;
		}
	}
}

for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
	for ( $counter2 = 1; $counter2 <= $SideBarCount; $counter2 += 1) {
		if ($counter < $counter2){
			if ($CalcValue[$counter]>0 && $CalcValue[$counter2]>0){
				$ItemInner[] = 'cms-templateInner'. $counter .$counter2 .$counter3;
			}
		}	
	}
}	

for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
	for ( $counter2 = 1; $counter2 <= $SideBarCount; $counter2 += 1) {
		for ( $counter3 = 1; $counter3 <= $SideBarCount; $counter3 += 1) {
			if ($counter < $counter2 && $counter2 < $counter3){
				if ($CalcValue[$counter]>0 && $CalcValue[$counter2]>0){
				$ItemInner[] = 'cms-templateInner'. $counter .$counter2 .$counter3;
				}
			}	
		}
	}
}	

$ItemInner[] = 'cms-templateInner-wide';

$OptionsTemplate = array (
	array("name" => "TEMPLATE MANAGEMENT",
		"type" => "heading",
		"desc" => "Turn your Sidebars Content Panes and Option Panels into Templates for your theme"),

	array(
		"name" => 'Inner Content Layout',
		"type" => "heading2"),       

	array(
		"name" => 'Select',
		"desc" => 'Choose the Inner Content Layout name from the List<br/>The numbers on the end are the Sidebars you want to include',
		"id" => 'template_inner',
		"type" => "select",
		"options" => $ItemInner,
		"std" => ''),

array(
		"name" => 'Template Name',
		"type" => "heading2"),       

array(
	"name" => 'Enter',
	"desc" => 'Leave blank if you are creating a non theme page like the home page',
	"id" => 'template_name',
	"type" => "text",
	"std" => ''),

array(
	"name" => 'Active Template Content area = '.cms_get_settings('template_inner') .' and has a width of : ' .cms_get_settings('template_inner_width'),
	"type" => "heading3")
);

if ($SideBarCount){
array_push(	$OptionsTemplate,	
		array(
		"name" => 'Sidebars',
		"type" => "heading"));

	for ( $counter = 1; $counter <= $SideBarCount; $counter += 1) {
		$ItemID = 'cmssidebar'.$counter;
		$ItemName = cms_get_settings($ItemID);
		$ItemOrder = $ItemID .'order';		
		
		array_push(	$OptionsTemplate,
			array("name" => $ItemName,
				"type" => "heading2"));
		
		array_push(	$OptionsTemplate,	
			array("name" => 'Include Sidebar :',
			"desc" => 'Select to include in the Template',
			"id" => $ItemOrder,
			"type" => "checkbox",
			"std" => ''));
	}
}

array_push($OptionsTemplate,
	array(
		"name" => 'Add the Components below in display sequence 1, 2, 3, 4,5 ,6 etc:<br/>'
			.'Left Sidebars first then the main theme area and the Right Sidebars<br/>'
			.'For the full Content width leave the width values as zero as :0 = 100%',
		"type" => "heading3"));

$ContentCount = cms_get_settings('content_count');
if ($ContentCount){
array_push(	$OptionsTemplate,	
		array(
		"name" => 'Content Panes',
		"type" => "heading2"));

	for ( $counter = 1; $counter <= $ContentCount; $counter += 1) {
		$ItemID = 'content'.$counter;
		$ItemName = cms_get_settings($ItemID);
		$ItemWidth = $ItemID .'width';
		$ItemOrder = $ItemID .'order';		
		
		array_push(	$OptionsTemplate,
			array("name" => $ItemName,
				"type" => "heading2"));
		
		array_push(	$OptionsTemplate,	
			array("name" => 'Custom Width    :',
			"desc" => 'Enter a custom Width for this Content Pane if required',
			"id" => $ItemWidth,
			"type" => "numtext",
			"std" => '0'));

		array_push(	$OptionsTemplate,	
			array("name" => 'Display Order   :',
			"desc" => 'Enter the display order for this Content Pane in sequence',
			"id" => $ItemOrder,
			"type" => "numtext",
			"std" => '0'));
	}
}

$OptionCount = cms_get_settings('option_count');
if ($OptionCount){
array_push(	$OptionsTemplate,	
		array(
		"name" => 'Option Panels',
		"type" => "heading2"));

	for ( $counter = 1; $counter <= $OptionCount; $counter += 1) {
		$ItemID = 'option'.$counter;
		$ItemName = cms_get_settings($ItemID);
		$ItemWidth = $ItemID .'width';
		$ItemHeight = $ItemID .'height';
		$ItemOrder = $ItemID .'order';		
		
		array_push(	$OptionsTemplate,
			array("name" => $ItemName,
				"type" => "heading2"));
		
		array_push(	$OptionsTemplate,	
			array("name" => 'Custom Width    :',
			"desc" => 'Enter a custom Width for this Option Panel if required',
			"id" => $ItemWidth,
			"type" => "numtext",
			"std" => '0'));
		
		array_push(	$OptionsTemplate,	
			array("name" => 'Custom Height   :',
			"desc" => 'Enter a custom Height for this Option Panel if required',
			"id" => $ItemHeight,
			"type" => "numtext",
			"std" => '0'));

		array_push(	$OptionsTemplate,	
			array("name" => 'Display Order   :',
			"desc" => 'Enter the display order for this Option Panel in sequence',
			"id" => $ItemOrder,
			"type" => "numtext",
			"std" => '0'));
	}
}

array_push(	$OptionsTemplate,
		array("name" => 'INCLUDE FOOTERS',
			"type" => "heading2"));

array_push(	$OptionsTemplate,		
				array("type" => "heading3",
					"name" => "<br/>Save First, then Right mouse click on the contents, Select All > Copy the Content to the clipboard to use in the next step<br/> 
					Go to the left menu bar and Appearance > Editor, on the right column find your template.php, paste in the text and save<br/>
					If you have not already saved an empty php file to your themes folder paste into a text editor and save as yourpagename.php"));

/* Calculate the Content variable widths */ 
function cms_update_template_widths(){
	$ActiveInner = cms_get_settings('template_inner');
	cms_update_option('template_inner_width',cms_get_settings($ActiveInner));
}


function cms_template_add_admin() {
	global $OptionsTemplate;

    if ( $_GET['page'] == 'cmstemplate') {
   
        if ('save' == $_REQUEST['action'] ) {

                foreach ($OptionsTemplate as $value) {
                    if($value['type'] != 'multicheck'){
                        cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            cms_update_option($up_opt, $_REQUEST[$up_opt] );
                        }
                    }
                }
                foreach ($OptionsTemplate as $value) {
                    if($value['type'] != 'multicheck'){
                        if( isset( $_REQUEST[ $value['id'] ] ) ) cms_update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
                    }else{
                        foreach($value['options'] as $mc_key => $mc_value){
                            $up_opt = $value['id'].'_'.$mc_key;
                            if( isset( $_REQUEST[ $up_opt ] ) )  cms_update_option( $up_opt, $_REQUEST[ $up_opt ] ); 
                        }
                    }
                }
				cms_update_template_widths();
				header("Location:admin.php?page=cmstemplate&saved=true");
               /*die;*/
        } 
    }
}

// Create the admin form
function cms_template_admin() {
	global $OptionsTemplate;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>settings saved.</strong></p></div>';
?>
<div class="wrap">
	<h2>CMS-Lite Template Creator</h2>
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

<?php foreach ($OptionsTemplate as $value) {
   
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

		<p class="submit">
			<input name="save" type="submit" value="Save changes" />
			<input type="hidden" name="action" value="save" />
		</p>
		<textarea name="code" style="width:100%;height:500px;border-color:red;"><?php echo cms_create_template(); ?></textarea>

	</form>
</div>
<?php
}

add_action('admin_menu', 'cms_template_add_admin'); 

?>