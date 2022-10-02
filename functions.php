<?php
/**
 * hmmh functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hmmh
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hmmh_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on hmmh, use a find and replace
		* to change 'hmmh' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'hmmh', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'hmmh' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'hmmh_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'hmmh_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hmmh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hmmh_content_width', 640 );
}
add_action( 'after_setup_theme', 'hmmh_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hmmh_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'hmmh' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hmmh' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hmmh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hmmh_scripts() {
	wp_enqueue_style( 'hmmh-style',  get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );
	wp_style_add_data( 'hmmh-style', 'rtl', 'replace' );

	wp_enqueue_script( 'hmmh-script', get_template_directory_uri() . '/js/script.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hmmh_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


 
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/my-custom-folder';
    
    
    // return
    return $path;
    
}
 
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/my-custom-folder';
    
    
    // return
    return $paths;
    
}
function my_acf_init() {
        
	if( function_exists('acf_register_block') ) {

		acf_register_block(array(
			'name'				=> 'casestudy-block', // Nazwa bloku
			'title'				=> __('Case study block', 'text-domain'), // Wyświetlana nazwa bloku
			'description'		=> __('Custom case study block', 'text-domain'), // Opis bloku
			'render_callback'	=> 'acf_block_render_callback', // Nazwa funkcji renderującej
			'category'			=> 'acf-custom-blocks', // Kategoria bloku
			'icon'				=> '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z"/></svg>', // Ikona
			'keywords'			=> array( 'case study' ), // Słowa kluczowe
		));

	}

}
add_action('acf/init', 'my_acf_init');
function acf_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'acf-custom-blocks',
				'title' => __( 'ACF Custom Blocks', 'text-domain'),
				'icon' => 'welcome-widgets-menus'
			),
		)
	);
}
add_filter( 'block_categories', 'acf_category', 10, 2 );
function acf_block_render_callback( $block ) {

	$slug = str_replace('acf/', '', $block['name']);
	
	if( file_exists( get_theme_file_path("/components/blocks/{$slug}.php") ) ) {
		include( get_theme_file_path("/components/blocks/{$slug}.php") );
	}
}
/**
 * Function to output either Link URL or Link Text from ACF link field or sub field
 */
function acf_link_field($field_name,$type,$subfield = "false") {
	
	$link = ($subfield == 'true') ? get_sub_field($field_name) : get_field($field_name);
	
	if( !$link ) {
		return;
	}
	
	$link_output = ($type == 'url') ? esc_url( $link['url'] ) : esc_html($link['title'] );
	
	return $link_output;

}