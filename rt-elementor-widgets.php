<?php
/**
 * Plugin Name:			RT Elementor Widgets
 * Plugin URI:			https://rigorousthemes.com/rt-elementor-widgets/
 * Description:			Add some new widgets to the popular free page builder Elementor.
 * Version:				1.0.0
 * Author:				Rigorous Theme
 * Author URI:			https://rigorousthemes.com/
 * Requires at least:	5.0
 * Tested up to:		5.0.3
 *
 * Text Domain: rt-elementor-widgets
 * Domain Path: /languages/
 *
 * @package RT_Elementor_Widgets
 * @author Rigorous Theme
 */
 // tested on wordpress version 5.7
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * RT Elementor Widget Compatibility
 */
if ( ! class_exists( 'RT_Elementor_Widgets' ) ) :

	/**
	 * RT Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class RT_Elementor_Widgets {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			add_action( 'init', array( $this, 'helper_function' ) );

			add_action( 'init', array( $this, 'image_size' ) );

			add_action( 'plugins_loaded', array( $this, 'admin_notice' ), 11 );

			// Add locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

			add_action( 'elementor/init', [ $this, 'register_category' ] );

			add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );

			// Register Elementor Widget Scripts
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

			// Register Elementor Widget Style
			add_action( 'elementor/frontend/after_register_styles', array( $this, 'widget_styles' ) );
		}

		/**
		 * Load the localisation file.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'rt-elementor-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
		/**
		 * Add Image Size.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function image_size(){
			add_image_size( 'rt_elementor_team', 223, 246, true ); 
			add_image_size( 'rt_elementor_blog', 358, 463, true ); 
			add_image_size( 'rt_elementor_slider', 1300, 585, true ); 
			add_image_size( 'rt_elementor_woo', 243, 265, true );

		}

		public function admin_notice() {
			if( ! defined('ELEMENTOR_PATH') && ! class_exists('Elementor\Widget_Base')) { ?>
				<div class="error">
					<p><?php esc_html_e( 'RT Elementor Widgets is enabled but not effective. It requires Elementor in order to work.', 'rt-elementor-widgets' ); ?></p>
				</div>
			<?php }
		}		

		/**
		 * Setup all the things.
		 * @return void
		 */
		public function helper_function() {	
			require_once( plugin_dir_path( __FILE__ ) .'/includes/helpers.php' );				
		}


		/**
		 * Register Locations
		 *
		 * @since 1.0.0
		 * @param object $manager Location manager.
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();
		}	

		/**
		 * Register Elementor Category
		 *
		 *
		 */
		public function register_category()	{

			// Register widget block category for Elementor section
			\Elementor\Plugin::instance()->elements_manager->add_category( 'rt-elements', array(
				'title' => esc_html__( 'RT Widgets', 'rt-elementor-widgets' ),
			), 1 );
		}


		/**
		 * Registers widgets scripts
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function widget_scripts() {

			wp_register_script( 'owl-carousel', plugins_url( '/assets/js/owl.carousel.js', __FILE__ ), [ 'jquery' ], false, true );

			wp_register_script( 'rt-elementor-widgets-counter', plugins_url( '/assets/js/counter.js', __FILE__ ), [ 'jquery' ], false, true );

			wp_register_script( 'rt-elementor-widgets-testimonial', plugins_url( '/assets/js/testimonial.js', __FILE__ ), [ 'jquery',  'owl-carousel' ], false, true );	

			wp_register_script( 'rt-elementor-widgets-carousel', plugins_url( '/assets/js/post-carousel.js', __FILE__ ), [ 'jquery', 'owl-carousel' ], false, true );	

			if ( class_exists( 'WooCommerce' ) ) {
				wp_register_script( 'rt-elementor-widgets-woo-carousel', plugins_url( '/assets/js/woo-carousel.js', __FILE__ ), [ 'jquery','owl-carousel' ], false, true );				
			}		
		}
		/**
		 * Registers Style
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function widget_styles() {			
			wp_enqueue_style( 'owl-carousel-css', plugins_url( '/assets/css/owl.carousel.css', __FILE__ ) );
			wp_enqueue_style( 'owl-theme-css', plugins_url( '/assets/css/owl.theme.css', __FILE__ ) );
			wp_enqueue_style( 'rt-elementor-widgets-style', plugins_url( '/assets/css/style.css', __FILE__ ) );
		}					

		/**
		 * Register Elementor Widget
		 *
		 */	
		public function register_widgets() {	
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/rt-post-carousel.php' );
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/rt-counter.php' ); 
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/rt-team.php' ); 
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/rt-testimonial.php' ); 
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/rt-blog.php' ); 
			require_once(plugin_dir_path( __FILE__ ) .'/widgets/rt-woo-carousel.php' ); 
		}			

		
	}
/**
 * Kicking this off by calling 'get_instance()' method
 */
RT_Elementor_Widgets::get_instance();	

endif;
