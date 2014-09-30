<?php
/**
 * Adds a new widget which outputs an image abd some blurb in various layouts.
 *
 * @category Widget
 * @package  Widget
 * @author   James Roberts
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 or later
 *
 * @wordpress
 * Plugin Name: Genesis Content Blurbs
 * Plugin URI: https://llamapress.com
 * Description: Adds a new widget which outputs an image and some blurb in various layouts for the Genesis framework.
 * Version: 1.0
 * Author: LlamaPress
 * Author URI: https://llamapress.com
 * License: GPL v2.0 or later
 */

//include plugins
include( plugin_dir_path( __FILE__ ) . 'inc/plugins/plugins.php');

add_action( 'widgets_init', create_function( '', "register_widget( 'lp_content_widget' );" ) );

/**
 * Content blurb widget class.
 *
 * @package Widget
 * @author LlamaPress
 */
class lp_content_widget extends WP_Widget {

	/**
	 * The plugin version, used as the version for dependencies.
	 *
	 * @since 1.0
	 */
	const version = '1.0';

	/**
	 * The text domain for localization.
	 *
	 * @since 1.0
	 */
	const domain = 'lp';

	/**
	 * Sets up the widget initilisation.
	 *
	 * @since 1.0
	 */
	public function __construct() {

		if( ! load_plugin_textdomain( self::domain, false, '/wp-content/languages/' ) )
			load_plugin_textdomain( self::domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		$widget_options = array(
			'classname'   => 'lp-content-blurb', // Class name of front-end of widget
			'description' => __( 'This widget adds a customisable content blurb with an image', self::domain ), // Description of widget on Widgets screen
		);
		parent::__construct(
				'lp-content-blurb',  // Base ID for the front-end of the widget, has to be unique
				__( 'Content Blurbs by LlamaPress', self::domain ), // Name of widget displayed on Widgets screen
				$widget_options,
				$control_options
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'blurb_dependencies' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'blurb_dependencies' ) );

	}

	/**
	 * Output widget content to front-end.
	 *
	 * @since 1.0
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args
	 * @param array $instance
	 * @return null Returns null if no category IDs are given.
	 */
	public function widget( $args, $instance ) {

		extract( $args );

		// Defaults
		$instance = wp_parse_args( (array) $instance, array(
			'title'       => '',  // Widget title
			'lp-blurb'       => '',  // Blurb
			'lp-blurb-image'       => '',  // Blurb image url
			'lp-blurb-link'       => '',  // Blurb link url
                            'lp-blurb-layout'       => '',  // Layout
		) );

		// Open widget markup
		echo $before_widget;

		// Retrieve widget values
                $title = esc_attr( $instance['title'] );
                $text = '<p>' . wpautop( $instance['lp-blurb'] ) . '</p>' ;
                $layout = esc_attr( $instance['lp-blurb-layout'] );
                $img_url = esc_attr( $instance['lp-blurb-image'] );
                $link = esc_attr( $instance['lp-blurb-link'] );
                if( $link != "" ){
                    $image = "<a href='$link'><img alt='$title' src='$img_url'/></a>";
                    $title = "<h3><a href='$link'>$title</a></h3>";
                }
                else{
                    $image = "<img alt='$title' src='$img_url'/>";
                    $title = "<h3>$title</h3>";
                }

		include plugin_dir_path( __FILE__ ) . 'views/widget.php';

		echo $after_widget;

	}

	/**
	 * Validate the input values as they are updated.
	 *
	 * @since 1.0.0
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance The submitted values
	 * @param type $old_instance The previously saved values
	 * @return array The validated submitted values
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['lp-blurb']       = strip_tags( $new_instance['lp-blurb'] );
		$instance['lp-blurb-image']       = strip_tags( $new_instance['lp-blurb-image'] );
		$instance['lp-blurb-link']       = strip_tags( $new_instance['lp-blurb-link'] );
		$instance['lp-blurb-layout']       = strip_tags( $new_instance['lp-blurb-layout'] );

		return $instance;

	}

	/**
	 * Display widget options.
	 *
	 * @since 1.0.0
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values
	 */
	public function form( $instance ) {

		// Ensure value exists
		$instance = wp_parse_args( (array) $instance, array(
			'title'       => '',
			'lp-blurb'       => '',
			'lp-blurb-image'       => '',
			'lp-blurb-link'       => '',
			'lp-blurb-layout'       => '',
		) );

		include plugin_dir_path( __FILE__ ) . 'views/admin.php';


	}

	/**
	 * Register style and scripts for front-end and back-end.
	 *
	 * If WP_DEBUG is defined as true, then references are made to the
	 * un-minified (development) versions, rather than the minified production
	 * versions of the files.
	 *
	 * @since 1.0
	 */
	public function blurb_dependencies() {

		global $current_screen;

		// If debugging, reference unminified files, with a constantly fresh cache buster.
		$suffix = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '.dev' : '';
		$version = ( defined ( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : self::version;

		if( is_admin() && 'widgets' == $current_screen->id ) {
			wp_enqueue_script( __CLASS__,  plugins_url( 'js/admin' . $suffix . '.js', __FILE__ ), array( 'jquery' ), $version, true );
			wp_enqueue_style(__CLASS__, plugins_url( 'css/admin' . $suffix . '.css', __FILE__ ), false, $version );
		} elseif ( ! is_admin() && is_active_widget( false, false, $this->id_base ) ) {
			wp_enqueue_style(__CLASS__, plugins_url( 'css/widget' . $suffix . '.css', __FILE__ ), false, $version );
		}

	}

}