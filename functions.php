<?php

update_option('siteurl','http://jim-valentine.co.uk/');
update_option('home','http://jim-valentine.co.uk/');    

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'magazine', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'magazine' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Magazine Pro Theme', 'magazine' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/magazine/' );
define( 'CHILD_THEME_VERSION', '3.1' );

function wpsites_npp_navigation_links() {
/**
 * @author    Brad Dalton
 * @example   http://wpsites.net/
 * @copyright 2014 WP Sites
 */
if ( is_singular('post') ) { ?>
    <span class="nav-previous alignleft" style="color:#6ba4be;"><?php previous_post_link('%link', 'Previous Post', TRUE) ?></span>
    <span class="nav-next alignright" style="color:#6ba4be;"><?php next_post_link('%link', 'Next Post', TRUE) ?></span>
    <?php
    } }
add_action('genesis_entry_footer', 'wpsites_npp_navigation_links' );

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

// Place the following code in your theme's functions.phphttp://jim-valentine.co.uk/ file
// override the quantity input with a dropdown
function woocommerce_quantity_input() {
    global $product;

	$defaults = array(
		'input_name'  	=> 'quantity',
		'input_value'  	=> '1',
		'max_value'  	=> apply_filters( 'woocommerce_quantity_input_max', '', $product ),
		'min_value'  	=> apply_filters( 'woocommerce_quantity_input_min', '', $product ),
		'step' 		=> apply_filters( 'woocommerce_quantity_input_step', '1', $product ),
		'style'		=> apply_filters( 'woocommerce_quantity_style', 'float:left; margin-right:10px; width:100%; background-color:#fff!important; color:#000;', $product )
	);
	if ( ! empty( $defaults['min_value'] ) )
		$min = $defaults['min_value'];
	else $min = 1;

	if ( ! empty( $defaults['max_value'] ) )
		$max = $defaults['max_value'];
	else $max = 20;

	if ( ! empty( $defaults['step'] ) )
		$step = $defaults['step'];
	else $step = 1;

	$options = '';
	for ( $count = $min; $count <= $max; $count = $count+$step ) {
		$options .= '<option value="' . $count . '">' . $count . '</option>';
	}
	echo '<div class="quantity_select" style="' . $defaults['style'] . '"><select name="' . esc_attr( $defaults['input_name'] ) . '" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="qty">' . $options . '</select></div>';
}


add_theme_support( 'genesis-connect-woocommerce' );

//* Display a custom favicon
add_filter( 'genesis_pre_load_favicon', 'sp_favicon_filter' );
function sp_favicon_filter( $favicon_url ) {
	return 'http://www.jim-valentine.co.uk/wp-content/images/favicon.ico';
}

function tweakjp_rm_comments_att( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'tweakjp_rm_comments_att', 10 , 2 );

//* Enqueue Google Fonts and JS script
add_action( 'wp_enqueue_scripts', 'magazine_enqueue_scripts' );
function magazine_enqueue_scripts() {

	wp_enqueue_script( 'magazine-entry-date', get_bloginfo( 'stylesheet_directory' ) . '/js/entry-date.js', array( 'jquery' ), '1.0.0' );
	
	wp_enqueue_script( 'magazine-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	
	wp_enqueue_style( 'dashicons' );
	
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,400|Raleway:400,500,900', array(), CHILD_THEME_VERSION );

}

add_action( 'genesis_entry_header', 'featured_post_image_before_title', 5 );
function featured_post_image_before_title() {
  if ( ! is_singular( 'post' ) )  return;
	the_post_thumbnail('featured-image');
}
 
add_image_size('featured-image', 700, 600, TRUE );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add new image size
add_image_size( 'masonry-thumb', 270, 0, true );

//* Add new image sizes
add_image_size( 'home-middle', 360, 200, true );
add_image_size( 'home-top', 750, 420, true );
add_image_size( 'sidebar-thumbnail', 100, 100, true );

if ( ! isset( $content_width ) )
    $content_width = 1200;

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'magazine-pro-blue'   => __( 'Magazine Pro Blue', 'magazine' ),
	'magazine-pro-green'  => __( 'Magazine Pro Green', 'magazine' ),
	'magazine-pro-orange' => __( 'Magazine Pro Orange', 'magazine' ),
) );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'default-text-color'     => '000000',
	'header-selector'        => '.site-title a',
	'header-text'            => false,
	'height'                 => 240,
	'width'                  => 240,
) );

genesis_register_sidebar( array(
	'id'          => 'nav-social-menu',
	'name'        => __( 'Nav Social Menu', 'your-theme-slug' ),
	'description' => __( 'This is the nav social menu section.', 'your-theme-slug' ),
) );
 
add_filter( 'genesis_nav_items', 'sws_social_icons', 10, 2 );
add_filter( 'wp_nav_menu_items', 'sws_social_icons', 10, 2 );
 
function sws_social_icons($menu, $args) {
	$args = (array)$args;
	if ( 'secondary' !== $args['theme_location'] )
		return $menu;
	ob_start();
	genesis_widget_area('nav-social-menu');
	$social = ob_get_clean();
	return $menu . $social;
}

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Add primary-nav class if primary navigation is used
add_filter( 'body_class', 'backcountry_no_nav_class' );
function backcountry_no_nav_class( $classes ) {

	$menu_locations = get_theme_mod( 'nav_menu_locations' );

	if ( ! empty( $menu_locations['primary'] ) ) {
		$classes[] = 'primary-nav';
	}
	return $classes;
}

//* Customize search form input box text
add_filter( 'genesis_search_text', 'magazine_search_text' );
function magazine_search_text( $text ) {

	return esc_attr( __( 'Search the site ...', 'magazine' ) );
	
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'magazine_author_box_gravatar' );
function magazine_author_box_gravatar( $size ) {

	return 140;

}

//* Remove the author box on single posts XHTML Themes
remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'magazine_comments_gravatar' );
function magazine_comments_gravatar( $args ) {

	$args['avatar_size'] = 100;
	return $args;

}

//* Remove entry meta in entry footer
add_action( 'genesis_before_entry', 'magazine_remove_entry_meta' );
function magazine_remove_entry_meta() {
	
	//* Remove if not single post
	if ( ! is_single() ) {
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
	}

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'magazine_remove_comment_form_allowed_tags' );
function magazine_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}




//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_entry_footer', 'genesis_after_entry_widget_area' );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'magazine' ),
	'description' => __( 'This is the top section of the homepage.', 'magazine' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home - Middle', 'magazine' ),
	'description' => __( 'This is the middle section of the homepage.', 'magazine' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'magazine' ),
	'description' => __( 'This is the bottom section of the homepage.', 'magazine' ),
) );