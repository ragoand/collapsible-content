<?php

/** ===============================================================================
 * Plugin Name: Shortcode Addons
 * Plugin URI: https://andrearago.it/project/shortcode-addons/
 * Description: A WordPress plugin to add some fancy shortcodes to get nicer WordPress contene.
 * Version: 1.0.0
 * Requires at least: 4.0
 * Tested up to: 5.9
 * Requires PHP: 5.3.8
 * Author: Andrea Rago
 * Author URI: http://andrearago.it/
 * Network: true
 * Text Domain: shortcode-addons
 * License: GPLv2 or later
 * ================================================================================ */
defined( 'ABSPATH' ) || exit;
define( 'SHORTCODE_ADDONS_VERSION', '1.0.0' );


class ShortcodeAddons {

	public function __construct() {

		add_shortcode( 'collapsible-content', [ $this, 'collapsible_content_shortcode' ] );
		add_shortcode( 'box-with-title', [ $this, 'box_with_title_shortcode' ] );

	}

	function collapsible_content_shortcode( $atts, $content ) {
		$args = shortcode_atts( array(
			'read_more_text' => esc_html__( 'Read more', 'shortcode-addons' ),
			'read_less_text' => esc_html__( 'Read less', 'shortcode-addons' ),
            'id' => '',
            'class' => false
		), $atts );
		extract( $args );

		wp_enqueue_style( 'shortcode-addons', plugin_dir_url(__FILE__) . '/assets/shortcode-addons.css', [], COLLAPSIBLE_CONTENT_VERSION, 'all' );
		wp_enqueue_script( 'shortcode-addons', plugin_dir_url(__FILE__). '/assets/shortcode-addons.js', [ 'jquery' ], COLLAPSIBLE_CONTENT_VERSION, true );

        if($class) {
            sprintf(' %1%s', $class);
        }

		ob_start();
		?>
        <div class="collapsible-content-container<?php echo $class; ?>" id="<?php echo $id; ?>">
            <div class="collapsible-content">
				<?php echo do_shortcode($content); ?>
            </div>
            <div class="collapsible-button">
                <span class="read-more"><?php esc_html_e($read_more_text, 'shortcode-addons'); ?></span>
                <span class="read-less"><?php esc_html_e($read_less_text, 'shortcode-addons'); ?></span>
            </div>
        </div>
		<?php
		return ob_get_clean();

	}

	public function box_with_title_shortcode ( $atts, $content ) {
		$args = shortcode_atts( array(
				'title' => esc_html__( 'Box title', 'shortcode-addons' ),
				'id' => '',
			), $atts );
		extract( $args );

		ob_start();
		?>
			<div class="box-with-title-container" id="<?php echo $id; ?>">
				<?php if(strlen($title) > 0 ): ?>
					<div class="box-title">
						<h3><?php esc_html_e($title, 'shortcode-addons'); ?></h3>
					</div>
				<?php endif; ?>
				<div class="box-content">
					<?php echo $content; ?>
				</div>
			</div>
		<?php
		return ob_get_clean();
	  }
}
new ShortcodeAddons();

