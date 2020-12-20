<?php
/**
 * Pluto back compat functionality
 *
 * Prevents pluto from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage Pluto
 * @since Pluto 1.0
 */

/**
 * Prevent switching to pluto on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since pluto 1.0
 */
function pluto_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'pluto_upgrade_notice' );
}
add_action( 'after_switch_theme', 'pluto_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * pluto on WordPress versions prior to 4.4.
 *
 * @since pluto 1.0
 *
 * @global string $wp_version WordPress version.
 */
function pluto_upgrade_notice() {
	/* translators: %s: The current WordPress version. */
	$message = sprintf( __( 'pluto requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'pluto' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since pluto 1.0
 *
 * @global string $wp_version WordPress version.
 */
function pluto_customize() {
	wp_die(
		/* translators: %s: The current WordPress version. */
		sprintf( __( 'pluto requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'pluto' ), $GLOBALS['wp_version'] ),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'pluto_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since pluto 1.0
 *
 * @global string $wp_version WordPress version.
 */
function pluto_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: The current WordPress version. */
		wp_die( sprintf( __( 'pluto requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'pluto' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'pluto_preview' );
