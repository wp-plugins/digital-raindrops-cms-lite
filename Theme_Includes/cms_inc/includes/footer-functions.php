<?php
add_action('wp_footer', 'set_widget_width');

// Adjust these values if you get overflow
function style_4_widgets(){
	?>
	<style type="text/css">
		.drf-footer ..drf-footer1
		{
		width: 25%;
		float: left;
		}
		.drf-footer ..drf-footer2
		{
		width: 25%;
		float: left;
		}
		.drf-footer ..drf-footer3
		{		
		width: 25%;
		float: left;
		}
		.drf-footer ..drf-footer4
		{
		width: 25%;
		float: right;
		}
	</style>
	<?PHP
}

// Adjust these values if you get overflow
function style_3_widgets(){
	?>
	<style type="text/css">
		.drf-footer ..drf-footer1
		{
		width: 33%;
		float: left;
		}
		.drf-footer ..drf-footer2
		{
		width: 34%;
		float: left;
		}
		.drf-footer ..drf-footer3
		{
		width: 33%;
		float: right;
		}
	</style>
	<?PHP
}

// Adjust these values if you get overflow
function style_2_widgets(){
	?>
	<style type="text/css">
		.drf-footer ..drf-footer1
		{
		width: 50%;
		float: left;
		}
		.drf-footer ..drf-footer2
		{
		width: 50%;
		float: right;
		}
	</style>
	<?PHP
}

// Adjust this values if you get overflow
function style_1_widgets(){
	?>
	<style type="text/css">
		.drf-footer ..drf-footer1
		{
		width: 100%;
		float: left;
		}
	</style>
	<?PHP	
}

function Add_footer_widgets(){
	if (function_exists('register_sidebars')) {
			register_sidebars(1, array(
			'name' => 'footer 1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">'.'<!--- BEGIN Widget --->',
			'before_title' => '<!--- BEGIN WidgetTitle --->',
			'after_title' => '<!--- END WidgetTitle --->',
			'after_widget' => '<!--- END Widget --->'.'</div>'
		));
	}
	if (function_exists('register_sidebars')) {
		register_sidebars(1, array(
			'name' => 'footer 2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">'.'<!--- BEGIN Widget --->',
			'before_title' => '<!--- BEGIN WidgetTitle --->',
			'after_title' => '<!--- END WidgetTitle --->',
			'after_widget' => '<!--- END Widget --->'.'</div>'
		));
	}
	if (function_exists('register_sidebars')) {
		register_sidebars(1, array(
			'name' => 'footer 3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">'.'<!--- BEGIN Widget --->',
			'before_title' => '<!--- BEGIN WidgetTitle --->',
			'after_title' => '<!--- END WidgetTitle --->',
			'after_widget' => '<!--- END Widget --->'.'</div>'
		));
	}
	if (function_exists('register_sidebars')) {
		register_sidebars(1, array(
			'name' => 'footer 4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">'.'<!--- BEGIN Widget --->',
			'before_title' => '<!--- BEGIN WidgetTitle --->',
			'after_title' => '<!--- END WidgetTitle --->',
			'after_widget' => '<!--- END Widget --->'.'</div>'
		));
	}
}

//Sets the widget widths here
function set_widget_width() {
	if (is_sidebar_active('footer 4')) {
		style_4_widgets();
		exit;
		}
	elseif (is_sidebar_active('footer 3')) {
		style_3_widgets();
		exit;		
		}
	elseif (is_sidebar_active('footer 2')) {
		style_2_widgets();
		exit;		
		}
	elseif (is_sidebar_active('footer 1')) {
		style_1_widgets();
		exit;		
		}				
}

// passes in the sidebar name to see if it is active 
function is_sidebar_active( $index = 1 ) {
	global $wp_registered_sidebars;

	if ( is_int( $index ) ) :
		$index = "sidebar-$index";
	else :
		$index = sanitize_title( $index );
		foreach ( (array) $wp_registered_sidebars as $key => $value ) :
			if ( sanitize_title( $value['name'] ) == $index ) :
				$index = $key;
				break;
			endif;
		endforeach;
	endif;

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( empty( $wp_registered_sidebars[$index] ) || !array_key_exists( $index, $sidebars_widgets ) || !is_array( $sidebars_widgets[$index] ) || empty( $sidebars_widgets[$index] ) )
		return false;
	else
		return true;
}
?>