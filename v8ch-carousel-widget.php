<?php

/*
Plugin Name: V8CH Rice Paper Carousel Widget
Plugin URI: http://www.v8ch.com
Description: Widget for creating layout carousels from a custom post type. Designed to work with the Rice Paper theming framework.
Version: 0.1.1-b1
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
	protected $configs;

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

		add_action( 'wp_enqueue_scripts', array( $this, 'v8ch_carousel_widget_scripts' ) );
	}

	public function get_carousel_options() {

		$opts = array(
			'adaptive_height'   =>  array (
				'slick_option'      =>  'adaptiveHeight',
				'default'           =>  'true',
			),
			'autoplay'          =>  array (
				'slick_option'      =>  'autoplay',
				'default'           =>  'true',
			),
			'autoplay_speed'    =>  array (
				'slick_option'      =>  'autoplaySpeed',
				'default'           =>  '3',
			),
			'dots'              =>  array (
				'slick_option'      =>  'dots',
				'default'           =>  'true',
			),
			'fade'              =>  array (
				'slick_option'      =>  'fade',
				'default'           =>  'true',
			),
			'lazyload'          =>  array (
				'slick_option'      =>  'lazyLoad',
				'default'           =>  'progressive',
			),
			'tax_slug'   =>  array (
				'default'           =>  '',
			),
		);

		return $opts;
	}

	public function v8ch_carousel_widget_scripts() {

		wp_register_style( 'slick', plugins_url( 'assets/css/slick.css', __FILE__ ) );
		wp_enqueue_style( 'slick' );

		wp_register_style( 'slick-theme', plugins_url( 'assets/css/slick-theme.css', __FILE__ ) );
		wp_enqueue_style( 'slick-theme' );

		wp_register_script( 'slick-js', plugins_url( 'assets/js/slick.js', __FILE__ ), array( 'jquery' ), false, true );
		wp_enqueue_script( 'slick-js' );

		wp_register_script( 'v8ch_carousel_widget_js', plugins_url( 'assets/js/v8ch-carousel-widget.js', __FILE__ ), array( 'jquery', 'slick-js' ), false, true );
		wp_enqueue_script( 'v8ch_carousel_widget_js' );

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

		$carousel_id = 'carousel-' . uniqid();

		$data_slick = $this->format_slick_options( $instance );

		include( $this->getTemplate( 'widget-v8ch-carousel' ) );

		$this->configs[] = $carousel_id;

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
		$instance          = $old_instance;
		$new_instance      = wp_parse_args( (array) $new_instance, self::get_defaults() );

		$instance['tax_slug']           = $new_instance['tax_slug'];
		$instance['adaptive_height']    = $new_instance['adaptive_height'];
		$instance['autoplay_speed']     = abs( $new_instance['autoplay_speed'] );
		$instance['dots']               = $new_instance['dots'];
		$instance['dots']               = $new_instance['dots'];

		return $instance;
	}

	/**
	 * Form UI
	 *
	 * @param object $instance Widget Instance
	 *
	 * @author V8CH
	 */
	public function form( $new_instance ) {

		$instance      = wp_parse_args( (array) $new_instance, self::get_defaults() );

		// Helper variables
		$booleans = array(
			'false',
			'true',
		); ?>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'tax_slug' ); ?>"><?php _e( 'Carousel Tag:', 'v8ch_carousel_widget' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'tax_slug' ); ?>"
			        id="<?php echo $this->get_field_id( 'tax_slug' ); ?>">
				<?php if ( $instance['tax_slug'] == '' ) : ?>
					<option
						value=""<?php selected( $instance['tax_slug'], '' ); ?>><?php _e( '-- Select --', 'v8ch_carousel_widget' ); ?></option>
				<?php endif;
				$options = get_terms( 'carousels' );
				foreach ( $options as $option ) : ?>
					<option
						value="<?php echo $option->slug ?>"<?php selected( $instance['tax_slug'], $option->slug ); ?>><?php echo $option->name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'adaptive_height' ); ?>"><?php _e( 'Adaptive Height:', 'v8ch_carousel_widget' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'adaptive_height' ); ?>"
			        id="<?php echo $this->get_field_id( 'adaptive_height' ); ?>">
				<?php
				foreach ( $booleans as $bool ) : ?>
					<option
						value="<?php echo $bool ?>"<?php selected( $instance['adaptive_height'], $bool ); ?>><?php echo $bool; ?></option>
				<?php endforeach; ?>
			</select></p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Autoplay:', 'v8ch_carousel_widget' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'autoplay' ); ?>"
			        id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
				<?php
				foreach ( $booleans as $bool ) : ?>
					<option
						value="<?php echo $bool ?>"<?php selected( $instance['autoplay'], $bool ); ?>><?php echo $bool; ?></option>
				<?php endforeach; ?>
			</select></p>

		<p><label
				for="<?php echo $this->get_field_id( 'autoplay_speed' ); ?>"><?php _e( 'Autoplay Speed (in seconds)', 'v8ch_card_widget' ); ?>
				:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'autoplay_speed' ); ?>"
			       name="<?php echo $this->get_field_name( 'autoplay_speed' ); ?>" type="text"
			       value="<?php echo esc_attr( strip_tags( $instance['autoplay_speed'] ) ); ?>"/></p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Show Dots:', 'v8ch_carousel_widget' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'dots' ); ?>"
			        id="<?php echo $this->get_field_id( 'dots' ); ?>">
				<?php
				foreach ( $booleans as $bool ) : ?>
					<option
						value="<?php echo $bool ?>"<?php selected( $instance['dots'], $bool ); ?>><?php echo $bool; ?></option>
				<?php endforeach; ?>
			</select></p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'fade' ); ?>"><?php _e( 'Fade Transition', 'v8ch_carousel_widget' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'fade' ); ?>"
			        id="<?php echo $this->get_field_id( 'fade' ); ?>">
				<?php
				foreach ( $booleans as $bool ) : ?>
					<option
						value="<?php echo $bool ?>"<?php selected( $instance['fade'], $bool ); ?>><?php echo $bool; ?></option>
				<?php endforeach; ?>
			</select></p>
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
	private function get_defaults() {

		$opts = $this->get_carousel_options();
		$defaults = array();

		foreach( $opts as $key => $props ) {
			$defaults[ $key ] = $props['default'];
		}
		return $defaults;
	}

	private function format_slick_options( $instance ) {

		$opts = $this->get_carousel_options();

		// Build our config
		$options = '{';

		$i = 0;
		foreach( $opts as $key => $option ) {
			$i++;
			if ( array_key_exists( 'slick_option', $option ) ) {
				if ( $i != 1 ) {
					$options .= ',';
				}
				switch ( $key ) {
					case 'autoplay_speed':
						$options .= '"' . $option['slick_option'] . '":' . floatval( $instance[ $key ] ) * 1000;
						break;
					case 'lazyload':
						$options .= '"' . $option['slick_option'] . '":"' . $option['default'] . '"';
						break;
					default:
						$options .= '"' . $option['slick_option'] . '":' . $instance[ $key ];
				}
			}
		}

		$options .= '}';

		return $options;
	}
}
