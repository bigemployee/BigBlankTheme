<?php
/**
 * Big Blank back compat functionality
 *
 * Prevents Big Blank from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 3.6.
 *
 
 

 */

/**
 * Prevent switching to Big Blank on old versions of WordPress.
 *
 * Switches to the default theme.
 *

 *
 * @return void
 */
function bigblank_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'bigblank_upgrade_notice' );
}
add_action( 'after_switch_theme', 'bigblank_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Big Blank on WordPress versions prior to 3.6.
 *

 *
 * @return void
 */
function bigblank_upgrade_notice() {
	$message = sprintf( __( 'Big Blank requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'bigblank' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *

 *
 * @return void
 */
function bigblank_customize() {
	wp_die( sprintf( __( 'Big Blank requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'bigblank' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'bigblank_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *

 *
 * @return void
 */
function bigblank_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Big Blank requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'bigblank' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'bigblank_preview' );
