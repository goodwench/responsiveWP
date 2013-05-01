<?php

	// // Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'responsiveWP', TEMPLATEPATH . '/languages' );
	
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	    require_once($locale_file);

	// Clean up the <head>
	function removeHeadLinks() {
	   	remove_action('wp_head', 'rsd_link');
	   	remove_action('wp_head', 'wlwmanifest_link');
		}
	add_action('init', 'removeHeadLinks');
	remove_action('wp_head', 'wp_generator');

	/* Admin options go here */

	//Theme Options
	require_once 'admin-styles/admin-options.php';	

	//Custom logos for the admin bar
	add_action('admin_head', 'my_custom_logo');
	function my_custom_logo() {
	echo '
	<style type="text/css">
	.ab-icon { background-image: url('.get_bloginfo('template_directory').'/img/custom-logo.png) !important; }
	</style>
	';
	}

	// Hide Dashboard Widgets you don't want

	add_action('wp_dashboard_setup', 'wpc_dashboard_widgets');
	function wpc_dashboard_widgets() {
		global $wp_meta_boxes;
		// Today widget
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		// Last comments
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		// Incoming links
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		// Plugins
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	}

	// // Add a custom footer in the admin
	function remove_footer_admin () {
	echo '<p>Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Designed by <a href="#" target="_blank">Someone</a></p>';
	}

	add_filter('admin_footer_text', 'remove_footer_admin');

	// // Add custom dashboard widgets
	add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

	function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;

	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
	}

	function custom_dashboard_help() {
	echo '<p>Welcome to your site! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a></p>';
	}


	// //Custom Gravatar

	add_filter( 'avatar_defaults', 'newgravatar' );

	function newgravatar ($avatar_defaults) {
	$myavatar = get_bloginfo('template_directory').'/img/gravatar.png';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
	}


	/*Theme functions go here*/

	// //Add in our non-jquery scripts
	function my_scripts_method() {
	    wp_enqueue_script('plugit', get_bloginfo('template_url').'/js/plugins.js', 1.0, ' ', true);
	    wp_enqueue_script('main', get_bloginfo('template_url').'/js/main.js', 1.0, ' ', true);
	}

	add_action( 'wp_enqueue_scripts', 'my_scripts_method' ); // wp_enqueue_scripts action hook to link only on the front-end

	// // Add RSS links to <head> section
	automatic_feed_links();

	// // Add thumbnails to RSS
	function rss_post_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
	$content = '<p>' . get_the_post_thumbnail($post->ID) .
	'</p>' . get_the_content();
	}
	return $content;
	}
	add_filter('the_excerpt_rss', 'rss_post_thumbnail');
	add_filter('the_content_feed', 'rss_post_thumbnail');

	// Delay RSS feed posts in case of errors
	// Change the wait variable to the number of minutes you wish to delay
	function publish_later_on_feed($where) {
	global $wpdb;

	if ( is_feed() ) {
	// timestamp in WP-format
	$now = gmdate('Y-m-d H:i:s');

	// value for wait; + device
	$wait = '30'; // integer

	// http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_timestampdiff
	$device = 'MINUTE'; //MINUTE, HOUR, DAY, WEEK, MONTH, YEAR

	// add SQL-sytax to default $where
	$where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
	}
	return $where;
	}

	add_filter('posts_where', 'publish_later_on_feed');

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, true ); // Normal post thumbnails
		add_image_size( 'small-post-thumbnail', 100, 100, true ); // Small Thumbnail		
	}

	// // enable threaded comments
	// // Remember to enable this in Settings
	function enable_threaded_comments(){
	if (!is_admin()) {
	if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
	wp_enqueue_script('comment-reply');
	}
	}
	add_action('get_header', 'enable_threaded_comments');

	//Accurate comment counts
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $count ) {
	if ( ! is_admin() ) {
	global $id;
	$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
	return count($comments_by_type['comment']);
	} else {
	return $count;
	}
	}

	//add some menus
	add_action( 'init', 'register_my_menus' );

		function register_my_menus() {
		register_nav_menus(
		array(
		'nav' => __( 'Top Navigation' ),
		'footer-nav' => __( 'Footer Navigation' ),						
		)
		);
	}

	//Add custom widgets

	// Sidebar widgets
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => __('Sidebar Widgets','responsiveWP' ),
			'id'   => 'sidebar-widgets',
			'description'   => __( 'These are widgets for the sidebar.','responsiveWP' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>'
		));
	}

	/*//Add some post types
	function my_events_posts() {
	register_post_type( 'events',
	    array( 
			'label' => __('Events'), 
			'public' => true, 
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'menu_position' => 5,
			'supports' => array(
				'title',
				'custom-fields',
				'editor',
				'thumbnail',
				'revisions',
				'post-formats',
				'page-attributes',
				'exerpt'),
			//'taxonomies' => array('post_tag')
			) 
		);
	}
	add_action('init', 'my_events_posts');*/

	//Make Pretty Excerpts
	function excerpt_ellipse($text) {
	   return str_replace('[...]', ' <a href="'.get_permalink().'" class="read-more">Read more &#187;</a>', $text); }
	add_filter('the_excerpt', 'excerpt_ellipse');
	    
	add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.

?>