<?php

/* Bootstrap Navigation -- https://github.com/twittem/wp-bootstrap-navwalker    
------------------------------------------------------------------------------*/

require_once('inc/wp_bootstrap_navwalker.php');


/* Images Support
------------------------------------------------------------------------------*/

add_theme_support( 'post-thumbnails' );
// add_image_size ( 'name', width, height, crop = false );

/* Menu
------------------------------------------------------------------------------*/
function custom_register_menus() {
    register_nav_menus(
            array(
                'navigation-top' => __( 'Top Navigation Menu', 'Townsend' ),
            )
    );
}
add_action( 'init', 'custom_register_menus' );


/* Styles and Scripts
------------------------------------------------------------------------------*/

/**
 * Enqueue scripts and styles
 */
function custom_scripts() {

    // Bootstrap 3.0
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/lib/bootstrap-3.3.5/css/bootstrap.min.css');
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/lib/bootstrap-3.3.5/js/bootstrap.min.js', array('jquery'), '1.0.0', true );

    // Custom theme
    wp_enqueue_style( 'customtheme', get_template_directory_uri() . '/style.css');
    wp_enqueue_script( 'customtheme_main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );


/* TinyMCE Editor Styles
------------------------------------------------------------------------------*/

// Callback function to insert 'styleselect' into the $buttons array
function custom_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// add_filter('mce_buttons_2', 'custom_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(
            'title' => 'Large Paragraph',  
            'block' => 'p',  
            'classes' => 'lead',
            'wrapper' => false,
        ),
        array(
            'title' => 'Button Link',  
            'block' => 'a',
            'selector' => 'a',
            'classes' => 'btn',
            'wrapper' => true,
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
// add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );  

// Add a stylesheet to show in the editor
function my_theme_add_editor_styles() {
    add_editor_style( 'css/custom-tinymce-style.css' );
}
// add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );


/* Misc.
------------------------------------------------------------------------------*/
/* Page Slug Body Class
 *
*/
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        // $classes[] = $post->post_type . '-' . $post->post_name;
        $classes[] = $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/******************************************************************************
* @Author: Boutros AbiChedid 
* @Date:   June 20, 2011
* @Websites: http://bacsoftwareconsulting.com/ ; http://blueoliveonline.com/
* @Description: Preserves HTML formating to the automatically generated Excerpt.
* Also Code modifies the default excerpt_length and excerpt_more filters.
* @Tested: Up to WordPress version 3.1.3
*******************************************************************************/ 
function custom_wp_trim_excerpt($text) {
global $post;

$raw_excerpt = $text;
if ( '' == $text ) {
    //Retrieve the post content. 
    $text = get_the_content('');

    //Delete all shortcode tags from the content. 
    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    
    /*** MODIFY THIS. Add the allowed HTML tags separated by a comma.***/
    $allowed_tags = '';
    $text = strip_tags($text, $allowed_tags);
    
    /*** MODIFY THIS. change the excerpt word count to any integer you like.***/
    $excerpt_word_count = 35; 
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
    
    /*** MODIFY THIS. change the excerpt endind to something else.***/
    $excerpt_end = '&hellip;</p><p><a href="'. get_permalink() .'" title="read more link" class="btn-more-link">View &raquo;</a>'; 
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
    
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
// remove_filter('get_the_excerpt', 'wp_trim_excerpt');
// add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');


?>