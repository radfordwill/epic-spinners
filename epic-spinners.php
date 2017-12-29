<?php
/**
 * Plugin Name: Epic Spinners For Wordpress
 *
 * Description: Epic Spinners plugin for Wordpress. Simple to use with shortcodes, widgets and editor buttons.
 * Plugin URI: https:/radford.online
 * Version: 1.0.0
 * Author: Will Radford
 * Author URI: https:/radford.online
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * @package epic-spinners
 * Text Domain: epic-spinners
 * Domain Path: /languages
 *
 *
 */

class epic_spinners {
	/**
	 * This plugin's identifier
	 */

	const ID = 'epic-spinners';

	/**
	 * This plugin's name
	 */

	const NAME = 'Epic Spinners for Wordpress';

	/**
	 * This plugin's version
	 */

	const VERSION = '1.0.0';

	/**
	 * This plugin's folder name and location, text domain (also slug name for wordpress.org)
	 */

	const FOLDERNAME = 'epic-spinners';


	/**
	 * This plugin's folder name and location, text domain (also slug name for wordpress.org)
	 */

	const TEXTDOMAIN = 'epic-spinners';

	/**
	 * Has the internationalization text domain been loaded?
	 * @var bool
	 */

	protected $loaded_textdomain = false;

	/**
	 * @var instance
	 *
	 */

	public static $instance;

	/**
	 * Set up __construct function for this class
	 *
	 * @return void
	 *
	 */

	public

	function __construct() {
		$this->initialize();
		global $admin_menu_link;
		if ( is_admin() ) {
			$this->load_plugin_textdomain();
			// load admin files
			add_action( 'admin_enqueue_scripts', array( $this,  'enqueue_styles_admin' ) );
			add_action( 'admin_enqueue_scripts', array( $this,  'enqueue_scripts_admin' ) );
			// add settings to db from settings api
			$this->register_settings();
			if ( is_multisite() ) {
				$admin_menu = 'network_admin_menu';
				$this->admin_menu_link = self::FOLDERNAME . '/admin/partials/epic-spinners-admin-display.php';
			} else {
				$admin_menu = 'admin_menu';
				$this->admin_menu_link = self::FOLDERNAME . '/admin/partials/epic-spinners-admin-display.php';
			}
			add_action( $admin_menu, array( & $this, 'epic_spinners_admin_menu' ) );
			// add custom links to this plugin's page entry
			add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( & $this, 'epic_spinners_plugin_action_link' ) );
			// add shortcode button to rich editor
			add_action( 'admin_head', array( & $this, 'epic_spinners_add_mce_button' ) );
		} else if (!is_admin()) {
			// load public files
			add_action( 'wp_enqueue_scripts', array( $this,  'enqueue_styles_public' ) );
			add_action( 'wp_enqueue_scripts', array( $this,  'enqueue_scripts_public' ) );
		}
	}

	/**
	 * Sets the object's properties and options
	 *
	 * This is separated out from the constructor to avoid undesirable
	 * recursion.
	 *
	 * @return void
	 *
	 */

	protected

	function initialize() {
		//dummy
		global $wpdb;
		//global $wp_query;
		//global $pagenow;
	}

	/**
	 * Singleton
	 *
	 * Assume one instance only runs.
	 * @since 3.16
	 *
	 */

	public

	static

	function init() {
		if ( is_null( self::$instance ) )
			self::$instance = new epic_spinners();
		return self::$instance;
	}

	/**
	 * A centralized way to load the plugin's textdomain for
	 * internationalization
	 * @return void
	 */

	protected

	function load_plugin_textdomain() {
		if ( !$this->loaded_textdomain ) {
			load_plugin_textdomain( self::TEXTDOMAIN, false, self::TEXTDOMAIN . '/languages' );
			$this->loaded_textdomain = true;
		}
	}

	/**
	 * Save initial data for the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    Adds meta data for the plugin options. (TODO need to add this to install function instead)
	 */

	public

	function register_settings() {
		//registering settings
		register_setting( 'epic-spinners-settings-group', 'epic-spinners-setting' );
	}

	/**
	 * Add menu link with icon in admin
	 *
	 * @since    1.0.0
	 *
	 */

	// Admin Menu Main page.
	public

	function epic_spinners_admin_menu() {
		// admin menu slug links for settings sub menu
	   add_submenu_page(
            'options-general.php', __( 'Epic Spinners Settings', self::FOLDERNAME ), 'Epic Spinners', 'manage_options', $this->admin_menu_link, ''
        );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */

	public

	function enqueue_styles_public() {
		// epic spinners public css
		wp_enqueue_style( self::NAME, plugin_dir_url( __FILE__ ) . 'public/css/epic-spinners-public.css', array(), self::VERSION, 'all' );
	}

	/**
	 * Register the javascript for the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */

	public

	function enqueue_scripts_public() {
		// no js yet
			wp_enqueue_script( 'epic-spinners-public', plugin_dir_url( __FILE__ ) . 'public/js/epic-spinners-public.js', array( 'jquery' ), self::VERSION );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.2
	 */

	public

	function enqueue_styles_admin() {
		wp_enqueue_style( self::NAME, plugin_dir_url( __FILE__ ) . 'admin/css/epic-spinners-admin.css', array(), self::VERSION, 'all' );
		// Load only on plugin id orour settings page, id for $current_screen does not get called soon enough to load in header??
		if ( ( 'epic-spinners/admin/partials/epic-spinners-admin-display' != es_admin_get_current_screen() ) ) {
			return;
		}
		// bootstrap 3 affects other admin pages when loaded without conditions to exclude it from the rest of the admin.
		wp_enqueue_style( 'bootstrap.v3', plugin_dir_url( __FILE__ ) . 'admin/css/bootstrap/bootstrap.min.css', array(), '3.3.7' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.2
	 */

	public

	function enqueue_scripts_admin() {
		// get page id  or page name and load js only on this plugins settings page
		if ( 'epic-spinners/admin/partials/epic-spinners-admin-display' != es_admin_get_current_screen() ) {
			return;
		}
		// admin js
		wp_enqueue_script( self::NAME, plugin_dir_url( __FILE__ ) . 'admin/js/epic-spinners-admin.js', array( 'jquery' ), self::VERSION, false );
		// bootstrap v3.3.7
		wp_enqueue_script( 'bootstrap.v3', plugin_dir_url( __FILE__ ) . 'admin/js/bootstrap/bootstrap.min.js', array( 'jquery' ), '3.3.7', false );
	}

	/**
	 * Retrieve the meta data in an array for the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    Returns meta data for the plugin options in array.
	 */

	public

	function epic_spinners_options_array() {
		$epic_spinners_setting = sanitize_text_field( get_option( 'epic-spinners-setting' ) );
		// add data to pass in js
		$dataToBePassed = array(
			'epic_spinners_setting' => $epic_spinners_setting,);
		return $dataToBePassed;
	}

	/**
	 * Get version from public class file
	 *
	 * @since    1.0.2
	 *
	 */

	public

	function get_plugin_data() {
		$plugin_data = get_plugin_data( plugin_dir_path( __FILE__ ) . 'epic-spinners.php', $markup = true, $translate = true );
		return $plugin_data;
	}


	/**
	 * create a button for wp editor
	 *
	 * @since 3.1.6
	 *
	 */

	public

	function epic_spinners_add_tinymce_plugin( $plugin_array ) {
		$plugin_array[ 'epic_spinners_add_mce_button' ] = plugin_dir_url( __FILE__ ) . 'admin/js/shortcodes/tinymce-shortcode-buttons.js';
		return $plugin_array;
	}

	/**
	 * register the button for wp editor
	 *
	 * @since 3.1.6
	 *
	 */

	public

	function epic_spinners_register_button( $buttons ) {
		array_push( $buttons, "epic_spinners_add_mce_button" );
		return $buttons;
	}

	/**
	 * Add shortcode buttons to wordpress tiny mce rich text editor
	 *
	 * @since 3.1.6
	 *
	 */

	public

	function epic_spinners_add_mce_button( $typenow ) {
		global $typenow;
		// check user permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		// verify the post type
		if ( !in_array( $typenow, array( 'post', 'page' ) ) )
			return;
		// check if WYSIWYG is enabled
		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_external_plugins', array( & $this, 'epic_spinners_add_tinymce_plugin' ) );
			add_filter( 'mce_buttons', array( & $this, 'epic_spinners_register_button' ) );
		}
	}

	/**
	 * Add plugin action links.
	 *
	 * Add a link to the settings page on the plugins.php page.
	 *
	 * @since 3.1.3
	 *
	 * @param  array  $links List of existing plugin action links.
	 * @return array         List of modified plugin action links.
	 */

	public

	function epic_spinners_plugin_action_link( $links ) {
		$links = array_merge( array(
			'<i class="wp-menu-image dashicons-before dashicons-admin-tools"></i><a href="' . esc_url( admin_url( 'admin.php?page=epic-spinners/admin/partials/epic-spinners-admin-display.php' ) ) . '">' . __( 'Settings', epic_spinners::TEXTDOMAIN ) . '</a> | <i class="wp-menu-image dashicons-before dashicons-share-alt"></i><a href="' . esc_url( 'https://paypal.me/kiipforwordpress' ) . '" style="color:#00ff0a; font-weight:bold;">' . __( 'Donate', epic_spinners::TEXTDOMAIN ) . '</a>'
		), $links );
		return $links;
	}

	/**
	 * attribute function
	 *
	 * @since    1.0.3
	 *
	 */

	public

	function we_normalize_attributes( $atts ) {
		foreach ( $atts as $key => $value ) {
			if ( is_int( $key ) ) {
				$atts[ $value ] = true;
				unset( $atts[ $key ] );
			}
		}
		return $atts;
	}

	/**
	 * path to directory function
	 *
	 * @since    3.1.3
	 *
	 */

	public

	function epic_spinners_the_path() {
		/* constant path to the folder. */
		$path = trailingslashit( plugin_dir_path( __FILE__ ) );
		return ( $path );
	}

	/**
	 * url of plugin folder function
	 *
	 * @since    3.1.3
	 *
	 */

	public

	function epic_spinners_the_url() {
		/* url to the folder. */
		$url = trailingslashit( plugins_url( basename( __DIR__ ) ) );
		return ( $url );
	}
}
/**
 * The instantiated version of this plugin's main class
 */

$epic_spinners = epic_spinners::init();

/**
 * path to directory function (outside class) @TODO: move to widget class
 *
 * @since    3.1.3
 *
 */

function epic_spinners_the_path() {
	/* constant path to the folder. */
	$path = trailingslashit( plugin_dir_path( __FILE__ ) );
	return ( $path );
}

/**
 * url of plugin folder function (outside class) @TODO: move to widget class
 *
 * @since    3.1.3
 *
 */

function epic_spinners_the_url() {
	/* url to the folder. */
	$url = trailingslashit( plugins_url( basename( __DIR__ ) ) );
	return ( $url );
}

/**
 * get the screen id, runs too late inside the main class
 *
 * @since    3.1.8
 *
 */

function es_admin_get_current_screen() {
    global $current_screen;
    if ( ! isset( $current_screen ) )
        return null;
    return $current_screen->id;
}

function es_override_mce_options($initArray)
{
  $opts = '*[*]';
  $initArray['valid_elements'] = $opts;
  $initArray['extended_valid_elements'] = $opts;
  return $initArray;
 }
 add_filter('tiny_mce_before_init', 'es_override_mce_options');
