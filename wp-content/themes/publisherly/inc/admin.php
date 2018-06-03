<?php
/**
 * Adds a custom Appearance sub-page in admin side.
 *
 * @package publisherly
 */

/**
 * Creates theme page inside Appearance panel.
 */
function publisherly_admin() {

	$theme = wp_get_theme();

	add_theme_page( $theme->display( 'Name' ), $theme->display( 'Name' ), 'edit_theme_options', 'publisherly', 'publisherly_welcome_page' );

}
add_action( 'admin_menu', 'publisherly_admin' );

/**
 * Theme welcome page content.
 */
function publisherly_welcome_page() {

	$theme = wp_get_theme( get_template() );
	?>

	<div class="wrap about-wrap">

		<div class="one-col">
			<div class="col">
				<h2>Publisherly Theme</h2>
				<p>
					<a href="<?php echo esc_html( $theme->get( 'ThemeURI' ) ); ?>"><?php	esc_html_e( 'Theme Homepage ', 'publisherly' ); ?></a>
				</p>

				<h3><?php esc_html_e( 'Help &amp; Documentation', 'publisherly' ); ?></h3>

				<p>
					<?php esc_html_e( 'Documentation for this Theme coming soon.', 'publisherly' ); ?>
				</p>

			</div>
		</div>

		<hr />

	</div>

<?php
}
