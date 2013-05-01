<?php
	// Theme Setting
	$themename 				= "Responsive WP";
	$shortname 				= "responsiveWP";
	
	
	
	
	// Options Page Functions

	function themeoptions_admin_menu() 
	{
		// here's where we add our theme options page link to the dashboard sidebar
		add_theme_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), 'themeoptions_page');
	}

	add_action('admin_menu', 'themeoptions_admin_menu');


?>