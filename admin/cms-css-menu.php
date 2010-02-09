<?php
/*	This file is part of the Digital Raindrops Template Pages for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* CMS-Lite this section creates the CSS file */

$cssoptions = array (
	
	array("type" => "heading3",
		"name" => "Right mouse click on the contents, Select All > Copy the CSS Content to the clipboard<br/> 
					Go to Appearance > Editor, on the right column find crm-layout.css, paste in the text and save"),
	
	array(
		"name" => 'CSS Content',
		"id" => 'csssettings',
		"type" => "textarea")
	);


function cms_style_admin() {
	global $cssoptions;
?>
<div class="wrap">
	<h2>CMS-Lite CSS Content</h2>
	
	<?php
	$catcherrors = cms_content_validate();
	if (count($catcherrors)> 1) { ?>
		<table class="form-table">
			<?php
			foreach ($catcherrors as $value){ ?>
				<li scope="row"><?php echo $value; ?></li>
			<?php } ?>
		</table>
	<?php } ?>

	<form>

		<table class="optiontable" style="width:100%;">

<?php foreach ($cssoptions as $value) {
   
    switch ( $value['type'] ) {
       
		case 'textarea':
        $ta_options = $value['options'];
        cms_wrapper_header($value);
        ?>
                <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:100%;height:550px;border-color:red"><?php echo cms_create_css(); ?></textarea>
        <?php
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
		       <td colspan="2" style="text-align: left;"><h4><?php echo $value['name']; ?>:</h4></td>
        </tr>
        <?php
        break;
       	
		case "list":
        ?>
        <tr valign="top">
		       <li colspan="2" style="text-align: left;"><?php echo $value['name']; ?>:</li>
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

?>