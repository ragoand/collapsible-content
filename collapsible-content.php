<?php

/** ===============================================================================
 * Plugin Name: Collapsible Content
 * Plugin URI: https://andrearago.it/project/collapsible-content/
 * Description: A WordPress plugin to add collapsible content through a shortcode.
 * Version: 1.0.3
 * Requires at least: 4.0
 * Tested up to: 5.9
 * Requires PHP: 5.3.8
 * Author: Andrea Rago
 * Author URI: http://andrearago.it/
 * Network: true
 * Text Domain: collapsible-content
 * License: GPLv2 or later
 * ================================================================================ */
defined( 'ABSPATH' ) || exit;
define( 'COLLAPSIBLE_CONTENT_VERSION', '1.0.3' );


class CollapsibleContent {

	public function __construct() {

		add_shortcode( 'collapsible-content', [ $this, 'collapsible_content_shortcode' ] );

	}

	function collapsible_content_shortcode( $atts, $content ) {
		$args = shortcode_atts( array(
			'read_more_text' => esc_html__( 'Read more', 'collapsible-content' ),
			'read_less_text' => esc_html__( 'Read less', 'collapsible-content' ),
            'id' => '',
            'class' => false
		), $atts );
		extract( $args );

		wp_enqueue_style( 'collapsible-content', plugin_dir_url(__FILE__) . '/assets/collapsible-content.css', [], COLLAPSIBLE_CONTENT_VERSION, 'all' );
		wp_enqueue_script( 'collapsible-content', plugin_dir_url(__FILE__). '/assets/collapsible-content.js', [ 'jquery' ], COLLAPSIBLE_CONTENT_VERSION, true );

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
                <span class="read-more"><?php esc_html_e($read_more_text, 'collapsible-content'); ?></span>
                <span class="read-less"><?php esc_html_e($read_less_text, 'collapsible-content'); ?></span>
            </div>
        </div>
		<?php
		return ob_get_clean();

	}

}
new CollapsibleContent();

