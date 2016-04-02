<?php

/*
Plugin Name: V8CH Carousel Widget
Plugin URI: http://www.v8ch.com
Description: Widget for creating layout carousels from a custom post type.
Version: 0.1.0
Author: Samai Kaewprasoet
Author URI: http://www.v8ch.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.en.html
Text Domain:
Domain Path:
*/

// Security check
defined( 'ABSPATH' ) or die( 'Fail on direct access' );


require 'includes/v8ch-carousel-post-type.php';

// Load widget
function v8ch_load_carousel_widget() {
	register_widget( 'V8CH_Carousel_Widget' );
}

add_action( 'widgets_init', 'v8ch_load_carousel_widget' );

// Setup automatic updates
require 'vendor/plugin-updates/plugin-update-checker.php';
$v8ch_carousel_widget_updates = PucFactory::buildUpdateChecker(
	'http://www.v8ch.com/update/v8ch-carousel-widget.json',
	__FILE__,
	'v8ch-carousel-widget'
);

class V8CH_Carousel_Widget extends WP_Widget {

	const VERSION = '0.1.0';

	/**
	 * V8CH Carousel Widget constructor
	 *
	 * @author V8CH
	 */
	public function __construct() {
		// load_plugin_textdomain( 'v8ch_carousel_widget', false, trailingslashit( basename( dirname( __FILE__ ) ) ) . 'lang/' );
		$widget_ops = array(
			'classname'   => 'widget_v8ch_carousel',
			'description' => __( '', 'v8ch_carousel_widget' ),
		);
		parent::__construct( 'widget_v8ch_carousel', __( 'V8CH Carousel Widget', 'v8ch_carousel_widget' ), $widget_ops );

		// add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
		// add_action( 'admin_head-widgets.php', array( $this, 'admin_head' ) );
	}

	/**
	 * Widget frontend output
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @author V8CH
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );

		$instance['tax_slug'] = apply_filters( 'v8ch_carousel_widget_tax_slug', $instance['tax_slug'], $args, $instance );

		include( $this->getTemplate( 'widget-v8ch-carousel' ) );

	}

	/**
	 * Loads theme file from WP hierarchy
	 *
	 * @param string $slug template file without extension
	 *
	 * @return template path
	 * @author V8CH
	 **/

	public function getTemplate( $slug ) {

		$template = '';

		if ( $override = locate_template( array( $slug . '.php' ) ) ) {
			$template = $override;
		} else {
			$template = 'views/' . $slug . '.php';
		}

		return $template;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = array();
		$instance['tax_slug'] = ( ! empty( $new_instance['tax_slug'] ) ) ? strip_tags( $new_instance['tax_slug'] ) : '';

		return $instance;
	}

	/**
	 * Form UI
	 *
	 * @param object $instance Widget Instance
	 *
	 * @author V8CH
	 */
	public function form( $instance ) {

		$tax_slug = ! empty( $instance['tax_slug'] ) ? $instance['tax_slug'] : '';
		?>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'tax_slug' ); ?>"><?php _e( 'Carousel Tag:', 'v8ch_carousel_widget' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'tax_slug' ); ?>"
			        id="<?php echo $this->get_field_id( 'tax_slug' ); ?>">
				<?php if ( $instance['tax_slug'] == '' ) : ?>
					<option
						value=""<?php selected( $instance['tax_slug'], '' ); ?>><?php _e( '-- Select --', 'v8ch_carousel_widget' ); ?></option>
				<?php endif; $options = get_terms( 'carousels' ); foreach ( $options as $option ) : ?>
				<option
					value="<?php echo $option->slug ?>"<?php selected( $instance['tax_slug'], $option->slug ); ?>><?php echo $option->name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Admin header css
	 *
	 * @author V8CH
	 */
	public function admin_head() {
		?>
		<style type="text/css">
		</style>
		<?php
	}

	/**
	 * Render an array of default values.
	 *
	 * @return array default values
	 */
	private static function get_defaults() {

		$defaults = array(
			'tax_slug' => '',
		);

		return $defaults;
	}
}
