<?php
/**
 * Theme Name:      Meloo
 * Theme Author:    Mariusz Rek - Rascals Themes
 * Theme URI:       http://rascalsthemes.com/meloo
 * Author URI:      http://rascalsthemes.com
 * File:            loop-events-block2.php
 * @package meloo
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get options
$meloo_opts = meloo_opts();

// Date Format 
$date_format = get_option( 'date_format' );

// Get Columns Number 
$block_grid = get_query_var( 'block_option' );

// Module classes 
$classes = array(
   	'post-grid-module'
);

// Set color scheme 
$color_scheme = get_theme_mod( 'color_scheme', 'dark' );
$classes[] = $color_scheme . '-scheme-el';

// Module Opts 
$module_opts = array(
	'module'     => 'meloo_event_module2',
	'thumb_size' => 'large',
	'classes'    => implode( ' ', $classes )
);
?>

<div data-module-opts='<?php echo json_encode( $module_opts ) ?>' class="ajax-grid flex-grid flex-<?php echo esc_attr( $block_grid  ) ?> flex-tablet-2 flex-mobile-2 flex-mobile-portrait-1 flex-gap-medium flex-anim flex-anim-fadeup posts-container">
<?php
// Start Loop 
while ( have_posts() ) {

	the_post();

	$index = $wp_query->current_post + 1;
	// Module arguments 
	if ( function_exists( $module_opts['module'] ) ) {
		echo '<div class="flex-item">';
	    $meloo_opts->e_esc( $module_opts['module']( array(
			'post_id'       => $wp_query->post->ID,
			'thumb_size'    => $module_opts['thumb_size'],
			'lazy'          => true,
			'title'         => get_the_title(),
			'permalink'     => get_permalink(),
			'classes'       => $module_opts['classes'],
			'posts_classes' => implode( ' ', get_post_class( '', $wp_query->post->ID ) ),
	    ) ) );
	    echo '</div>';
	}
}
?>
</div>