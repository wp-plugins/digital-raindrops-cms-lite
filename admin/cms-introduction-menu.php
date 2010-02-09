<?php
/*	This file is part of the Digital Raindrops CMS-Lite for WordPress Plugin */
/*	Copyright 2010  David Cox  (email : david.cox@digitalraindrops.net) */

/* This section is the introduction screen for the CMS-Lite */

$OptionsIntro = array (	
	array(
		"name" => 'Introduction',
		"type" => "heading2"),
	
	array(
		"id" => "step1",
		"type" => "heading3",
		"name" => cms_intro_text()),
	
	array(
		"name" => 'Manage Theme',
		"type" => "heading2"),
	
	array(
		"id" => "step2",
		"type" => "heading3",
		"name" => cms_management_text()),
	
	array(
		"name" => 'Content Panes',
		"type" => "heading2"),
	
	array(
		"type" => "heading3",
		"name" => cms_content_text()),
	
	array(
		"name" => 'Option Panels',
		"type" => "heading2"),
	
	array(
		"type" => "heading3",
		"name" => cms_options_text()),

	array(
		"name" => 'Stylesheets',
		"type" => "heading2"),
	
	array(
		"id" => "step5",
		"type" => "heading3",
		"name" => cms_style_text()),
	
	array(
		"name" => 'Template Pages',
		"type" => "heading2"),
	
	array(
		"id" => "step6",
		"type" => "heading3",
		"name" => cms_template_text()),



	array(
		"name" => 'Package',
		"type" => "heading2"),
	
	array(
		"id" => "step7",
		"type" => "heading3",
		"name" => cms_package_text())
);

function cms_intro_text(){
	$string = 'Welcome to the Digital Raindrops CMS-Lite plugin, for the WordPress blogging platform,';
	$string = $string .' this plugin will help you manage and create a set of new templates to use with your theme,';
	$string = $string .' you will need some understanding about php code and how templates and cascading style sheets work, ';
	$string = $string .'to get the best out of this plugin planning the layout of the pages on your website is the most important thing to consider.';
	return $string;
}

function cms_management_text() {
	$string = 'On the Management page you will need to enter some information about your theme,';
	$string = $string .' this will include the name and width of the main content container,';
	$string = $string .' the number of existing sidebars, filenames, class id, and widths,';
	$string = $string .' you can add sidebars to include in the templates up to a maximum of four including the existing ones,';
	$string = $string .' you will be asked for the names, if they are to be positioned left and the widths of the Sidebars.<br/>' ;
	$string = $string .'As well as the sidebars you can add up to sixteen content pane areas and ten option panels, there is also a dynamic footer and other snippits,';
	$string = $string .' these can be installed to make your template pages stand out from others.';
	return $string;
}

function cms_content_text(){
	$string = 'Up to sixteen content panes can be used in designing your pages, after selecting the number on the management screen, ';
	$string = $string .'you can name these on the content panes page, when you add widgets you will see the names that you entered here,';
	$string = $string .' you may also want to include the page name like "home upper content" so you can identify what that content pane is to be used for.';
	return $string;
}

function cms_options_text(){
	$string = 'Up to ten option panels can be used in designing your pages, after selecting the number on the management screen, ';
	$string = $string .'you can name these on the option panels page, these are not wigitized areas but placeholder for items like galleries,';
	$string = $string .' there are three other values for each option, height, width and hidden, these values will be used if you insert the option into your template,';
	$string = $string .' if you select hidded then there will be no option in the themes options page, Adsense 486x60 you would not hide, a content gallery you would.';
	return $string;
}

function cms_style_text(){
	$string = 'Once you have completed the conemt choices you are ready to start styling the new content areas, there are four pages to compleye in this section.'; 
	$string = $string .'The new Sidebars styles can be different from your main theme or you can style it based on the existing sidebars, the content area panes would be styled to match ';
	$string = $string .'your page content, the dynamic footer style can have different colors and fonts to seperate it from your main theme, last is the main stylesheet this is the layout';
	$string = $string .'once you have completed these steps follow the tutorials on updating the files, this can be done from Appearance > Editor in the admin area.';
	return $string;
}

function cms_template_text(){
	$string = '';
	$string = $string .'On the Template Page you can select the items you want to include in your template, you do this by checking a box or entering a number into the order box, ';
	$string = $string .'the number is used to place your content into the style, if you had a gallery and adsense options in the top row of the main content area you would make these 1 and 2,';
	$string = $string .' on this page you also set any custom widths if the content area was 730 you would make the gallery 400 and the adSense 320,  ';
	$string = $string .' if you wanted three content panes side by side you would also set the widths here';
	return $string;
}

function cms_package_text(){
	$string = 'The final steps are to add some generated code to an empty file which will be called from your themes functions.php, this code adds the extra widgitized panes to your theme, ';
	$string = $string .'manages the options, and loads the stylesheet, then you will need to add one line of code to your theme, that is it ready to test and rollout, make any changes and export the css if you need to';
	$string = $string .'';
	return $string;
}

function cms_introduction_admin() {
	global $OptionsIntro;
?>
<div class="wrap">
	<h2>Digital Raindrops CMS-Lite</h2>

	<form>

		<table class="optiontable" style="width:100%;">

<?php foreach ($OptionsIntro as $value) {
   
    switch ( $value['type'] ) {
       
		case 'textarea':
        $ta_options = $value['options'];
        cms_wrapper_header($value); 
		?>
		<?php echo $value['std']; ?>
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
		       <td colspan="2" style="text-align: left;"><h4><?php echo $value['name']; ?></h4></td>
        </tr>
        <?php
        break;

		case "heading3":
        ?>
        <tr valign="top">
		       <td colspan="2" style="text-align: left;"><?php echo $value['name']; ?></td>
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