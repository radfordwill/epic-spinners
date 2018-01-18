<?php
/**
 * Plugin Name: Epic Spinners For Wordpress
 *
 * Description: Epic Spinners plugin for Wordpress. Simple to use with shortcodes, widgets and editor buttons.
 * Plugin URI: http://radford.online
 * Version: 1.0.2
 * Author: Will Radford
 * Author URI: http:/radford.online
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * @package epic-spinners
 * Text Domain: epic-spinners
 * Domain Path: /languages
 *
 *
 */

if ( ! class_exists( 'epic_spinners' ) ) {
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

	const VERSION = '1.0.2';

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
			//$this->register_settings();
			add_action('admin_init', array(& $this, 'register_settings'));
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
			// add shortcodes
			add_shortcode( 'epicspin', array( $this, 'es_shortcodes' ) );
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
	 * @since 1.0.0
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
	 * @since    1.0.0
	 */

	public

	function enqueue_styles_public() {
		// epic spinners public css
		wp_enqueue_style( self::NAME, plugin_dir_url( __FILE__ ) . 'public/css/epic-spinners-public.css', array(), self::VERSION, 'all' );
	}

	/**
	 * Register the inline styles for the public-facing side of the site.
	 *
	 * @since    1.0.1
	 */

	public

	function enqueue_styles_inline_public($inline_css="") {
		// epic spinners public css
		wp_register_style( 'epic-spinners-public-inline', false );
		wp_enqueue_style( 'epic-spinners-public-inline' );
		wp_add_inline_style( 'epic-spinners-public-inline', $inline_css );
	}


	/**
	 * Register the javascript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */

	public

	function enqueue_scripts_public() {
		// no js yet
			wp_enqueue_script( 'epic-spinners-public', plugin_dir_url( __FILE__ ) . 'public/js/epic-spinners-public.js', array( 'jquery' ), self::VERSION );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
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
		// change to codemirror for shortcode display in settings
		wp_enqueue_style( 'codemirror', plugin_dir_url( __FILE__ ) . 'admin/css/codemirror/codemirror.css', array(), '5.3.2' );
		// one-dark codemirror theme by aerobird98
		wp_enqueue_style( 'one-dark-code-editor', plugin_dir_url( __FILE__ ) . 'admin/css/default.css', array(), self::VERSION );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
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
		// codemirror v5.3.2
		wp_enqueue_script( 'codemirror', plugin_dir_url( __FILE__ ) . 'admin/js/codemirror/codemirror.js', array( 'jquery' ), '5.3.2', false );
		wp_enqueue_script( 'codemirror-js', plugin_dir_url( __FILE__ ) . 'admin/js/codemirror/mode/javascript/javascript.js', array( 'jquery' ), '5.3.2', false );
		wp_enqueue_script( 'codemirror-js-active', plugin_dir_url( __FILE__ ) . 'admin/js/codemirror/selection/active-line.js', array( 'jquery' ), '5.3.2', false );
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
	 * @since    1.0.0
	 *
	 */

	public

	function get_plugin_data() {
		$plugin_data = get_plugin_data( plugin_dir_path( __FILE__ ) . 'epic-spinners.php', $markup = true, $translate = true );
		return $plugin_data;
	}

	/**
	 * Add shortcode support to the front end pages and html widgets
	 *
	 * @since    1.0.0
	 *
	 */

	public

	function es_shortcodes( $atts, $content ) {
		// [kiip_ad_shortcode "fullscreen"]	[kiip_ad_shortcode "moment_type"]
		$atts = $this->we_normalize_attributes( $atts );
		// Attributes
		$atts = shortcode_atts(
			array(
				'type' => '',
				'color'=> '',
				'size'=> '',
			),
			$atts,
			'epicspin'
		);
		if ( $atts[ 'type' ] == true ) {
			$nick_name = $atts[ 'type' ];
		} else {
			$nick_name = 'atom-spinner';
		}
		if ( $atts[ 'color' ] == true ) {
			$spinner_color  = $atts[ 'color' ];
		} else {
			$spinner_color = '#000';
		}
		if ( $atts[ 'size' ] == true ) {
			$spinner_size  = $atts[ 'size' ];
		} else {
			$spinner_size = '60px';
		}
			ob_start();
			echo $this->epic_spinners_html_output( $nick_name, $spinner_color, $spinner_size );
			return ob_get_clean();
  }

	/**
	 * Shortcode output html
	 *
	 * @since    1.0.1
	 *
	 */

	// Display html output for shortcode
	public

	function epic_spinners_html_output( $nick_name = "", $spinner_color = "", $spinner_size = ""  ) {
		// output html for epic spinner shortcodes
		$output_html = '';
		// inline style for spinner
		$inline_css = '';
		// output each spinner with unique class name
		if ($nick_name == "orbit-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.orbit-spinner-' . $random_string_thingy . ' .orbit:nth-child(-n+3){border-color:' . $spinner_color  . ';}.orbit-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="orbit-spinner orbit-spinner-' . $random_string_thingy . '"><div class="orbit"></div><div class="orbit"></div><div class="orbit"></div></div>';
		}
		if ($nick_name == "atom-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.atom-spinner-' . $random_string_thingy . ' .spinner-line{border-left-color:' . $spinner_color  . ';}.atom-spinner-' . $random_string_thingy . ' .spinner-circle{color:' . $spinner_color  . ';}.atom-spinner-' . $random_string_thingy . '{height:' . $spinner_size. ';width:' . $spinner_size. ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="atom-spinner atom-spinner-' . $random_string_thingy . '"><div class="spinner-inner"><div class="spinner-line"></div><div class="spinner-line"></div><div class="spinner-line"></div><div class="spinner-circle">&#9679;</div></div></div>';
		}
		if ($nick_name == "flower-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.flower-spinner-' . $random_string_thingy . '{color:' . $spinner_color  . ';height:' . $spinner_size . ';width:' . $spinner_size. ';}.flower-spinner-' . $random_string_thingy . ' .bigger-dot{color:' . $spinner_color  . ';background:' . $spinner_color  . ';}.flower-spinner-' . $random_string_thingy . ' .smaller-dot{color:' . $spinner_color  . ';background:' . $spinner_color  . ';}.flower-spinner .dots-container{height:calc(' . $spinner_size. '/7)' . ';width:calc(' . $spinner_size. '/7);}@keyframes flower-spinner-bigger-dot-animation{0%,100% {box-shadow: 0px 0px 0px currentColor, 0px 0px 0px currentColor, 0px 0px 0px currentColor, 0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor;}50%{transform: rotate(180deg);}25%,75% {box-shadow: calc(' . $spinner_size. '/2.7) 0px 0px currentColor, calc(-' . $spinner_size. '/2.7) 0px 0px currentColor, 0px calc(' . $spinner_size. '/2.7) 0px currentColor,0px calc(-' . $spinner_size. '/2.7) 0px currentColor, calc(' . $spinner_size. '/3.7) calc(-' . $spinner_size. '/3.7) 0px currentColor, calc(' . $spinner_size. '/3.7) calc(' . $spinner_size. ' / 3.7) 0px currentColor, calc(-' . $spinner_size. '/3.7) calc(-' . $spinner_size. '/3.7) 0px currentColor, calc(-' .  $spinner_size. '/3.7) calc(' .  $spinner_size. '/3.7) 0px currentColor;}100%{transform: rotate(360deg);box-shadow: 0px 0px 0px currentColor, 0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor;}}@keyframes flower-spinner-smaller-dot-animation{0%,100%{box-shadow:0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor;}25%,75%{box-shadow:calc(' . $spinner_size. '/5) 0px 0px currentColor,calc(-' . $spinner_size. '/5) 0px 0px currentColor,0px calc(' . $spinner_size. '/5) 0px currentColor,0px calc(-' . $spinner_size. '/5) 0px currentColor, calc(' . $spinner_size. '/7) calc(-' . $spinner_size. '/7) 0px currentColor,calc(' . $spinner_size. '/7) calc(' . $spinner_size. '/7) 0px currentColor, calc(-' . $spinner_size. '/7) calc(-' . $spinner_size. '/7) 0px currentColor, calc(-' . $spinner_size. '/7) calc(' . $spinner_size. '/7) 0px currentColor;}100% {box-shadow:0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor,0px 0px 0px currentColor;}}';
		self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="flower-spinner flower-spinner-' . $random_string_thingy . '"><div class="dots-container"><div class="bigger-dot"><div class="smaller-dot"></div></div></div></div>';
		}
		if ($nick_name == "pixel-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.pixel-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.pixel-spinner-' . $random_string_thingy . ' .pixel-spinner-inner{color:' . $spinner_color  . ';background:' . $spinner_color  . ';height:calc(' . $spinner_size . '/7);width:calc(' . $spinner_size. '/7);box-shadow:calc(' . $spinner_size . '/4.6) calc(' . $spinner_size . '/4.6) 0 0, calc(-' . $spinner_size . '/4.6) calc(-' . $spinner_size . '/4.6) 0 0, calc(' . $spinner_size . '/4.6) calc(-' . $spinner_size . '/4.6) 0 0, calc(-' . $spinner_size . '/4.6) calc(' . $spinner_size . '/4.6) 0 0, 0 calc(' . $spinner_size . '/4.6) 0 0, calc(' . $spinner_size . '/4.6) 0 0 0, calc(-' . $spinner_size . '/4.6) 0 0 0, 0 calc(-' . $spinner_size . '/4.6) 0 0;}@keyframes pixel-spinner-animation{50%{box-shadow:calc(' . $spinner_size . '/3.7) calc(' . $spinner_size . '/3.7) 0px 0px, calc(-' . $spinner_size . '/3.7) calc(-' . $spinner_size . '/3.7) 0px 0px, calc(' . $spinner_size . '/3.7) calc(-' . $spinner_size . '/3.7) 0px 0px, calc(-' . $spinner_size . '/3.7) calc(' . $spinner_size . '/3.7) 0px 0px, 0px calc(' . $spinner_size . '/7) 0px 0px, calc(' . $spinner_size . '/7) 0px 0px 0px, calc(-' . $spinner_size . '/7) 0px 0px 0px, 0px calc(-' . $spinner_size . '/7) 0px 0px;}75%{box-shadow: calc(' . $spinner_size . '/3.7) calc(' . $spinner_size . '/3.7) 0px 0px, calc(-' . $spinner_size . '/3.7) calc(=' . $spinner_size . '/3.7) 0px 0px, calc(' . $spinner_size . '/3.7) calc(-' . $spinner_size . '/3.7)0px 0px, calc(-' . $spinner_size . '/3.7) calc(' . $spinner_size . '/3.7) 0px 0px, 0px calc(' . $spinner_size . '/3.7) 0px 0px, calc(' . $spinner_size . '/3.7) 0px 0px 0px, calc(-' . $spinner_size . '/3.7) 0px 0px 0px, 0px calc(-' . $spinner_size . '/3.7) 0px 0px;}100%{transform: rotate(360deg);}}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="pixel-spinner pixel-spinner-' . $random_string_thingy . '"><div class="pixel-spinner-inner pixel-spinner-inner"></div></div>';
		}
		if ($nick_name == "hollow-dots-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.hollow-dots-spinner-' . $random_string_thingy . '{height:' . $spinner_size. ';width:calc(calc(' . $spinner_size. '*2)*3);}.hollow-dots-spinner-' . $random_string_thingy . ' .dot{height:' . $spinner_size . ';width:' . $spinner_size. ';color:' . $spinner_color . ';margin:0 calc(' . $spinner_size. '/2);border:calc(' . $spinner_size. '/5) solid currentColor;}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="hollow-dots-spinner hollow-dots-spinner-' . $random_string_thingy . '" :style="spinnerStyle"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>';
		}
		if ($nick_name == "intersecting-circles-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.intersecting-circles-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.intersecting-circles-spinner-' . $random_string_thingy . ' .spinnerBlock{height:calc(' . $spinner_size. '/2);width:calc(' . $spinner_size. '/2);}.intersecting-circles-spinner-' . $random_string_thingy . ' .circle:nth-child(2){left:calc(calc(' . $spinner_size. '/2)*-0.36);top:calc(calc(' . $spinner_size. '/2) * 0.2);}.intersecting-circles-spinner-' . $random_string_thingy . ' .circle:nth-child(3){left:calc(calc(' . $spinner_size. '/2)*-0.36);top:calc(calc(' . $spinner_size. '/2)*-0.2);}.intersecting-circles-spinner-' . $random_string_thingy . ' .circle:nth-child(4){left:0;top:calc(calc(' . $spinner_size. '/2)*-0.36);}.intersecting-circles-spinner-' . $random_string_thingy . ' .circle:nth-child(5){left:calc(calc(' . $spinner_size. '/2)*0.36);top:calc(calc(' . $spinner_size. '/2)*-0.2);}.intersecting-circles-spinner-' . $random_string_thingy . ' .circle:nth-child(6){left:calc(calc(' . $spinner_size. '/2)*0.36);top:calc(calc(' . $spinner_size. '/2)*0.2);}.intersecting-circles-spinner-' . $random_string_thingy . ' .circle:nth-child(7){left:0;top:calc(calc(' . $spinner_size. '/2)*0.36);}.intersecting-circles-spinner-' . $random_string_thingy . ' .circle{color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="intersecting-circles-spinner intersecting-circles-spinner-' . $random_string_thingy . '"><div class="spinnerBlock"><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span></div></div>';
		}
		if ($nick_name == "radar-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.radar-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';} .radar-spinner-' . $random_string_thingy . ' .circle-inner{color:' . $spinner_color . ';}.radar-spinner-' . $random_string_thingy . ' .circle:nth-child(1){padding:calc(' . $spinner_size . '*5*2*0/110);} .radar-spinner-' . $random_string_thingy . ' .circle:nth-child(2){padding:calc(' . $spinner_size . '*5*2*1/110);}.radar-spinner-' . $random_string_thingy . ' .circle:nth-child(3){padding:calc(' . $spinner_size . '*5*2*2/110);}.radar-spinner-' . $random_string_thingy . ' .circle:nth-child(4){padding:calc(' . $spinner_size . '*5*2*3/110);}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="radar-spinner radar-spinner-' . $random_string_thingy . '" :style="spinnerStyle"><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div></div>';
		}
		if ($nick_name == "scaling-squares-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.scaling-squares-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.scaling-squares-spinner-' . $random_string_thingy . ' .square{height:calc(' . $spinner_size. ' * 0.25 / 1.3);width:calc(' . $spinner_size. ' * 0.25 / 1.3);border:calc(' . $spinner_size. ' * 0.04 / 1.3) solid currentColor; color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="scaling-squares-spinner scaling-squares-spinner-' . $random_string_thingy . '" :style="spinnerStyle"><div class="square"></div><div class="square"></div><div class="square"></div><div class="square"></div></div>';
		}
		if ($nick_name == "half-circle-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.half-circle-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.half-circle-spinner-' . $random_string_thingy . ' .circle{border: calc(' . $spinner_size. ' / 10) solid transparent;}.half-circle-spinner-' . $random_string_thingy . ' .circle,.circle-1{color:' . $spinner_color . ';}.circle,.circle-2{color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="half-circle-spinner half-circle-spinner-' . $random_string_thingy . '"><div class="circle circle-1"></div><div class="circle circle-2"></div></div>';
		}
		if ($nick_name == "trinity-rings-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.trinity-rings-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.trinity-rings-spinner-' . $random_string_thingy . ' .circle:nth-child(1){height:' . $spinner_size . ';width:' . $spinner_size. ';}.trinity-rings-spinner-' . $random_string_thingy . ' .circle:nth-child(2){height:calc(' . $spinner_size . ' * 0.65);width:calc(' . $spinner_size . ' * 0.65);}.trinity-rings-spinner-' . $random_string_thingy . ' .circle:nth-child(3){height:calc(' . $spinner_size . '*0.1);width:calc(' . $spinner_size . '*0.1);}.trinity-rings-spinner-' . $random_string_thingy . ' .circle{color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="trinity-rings-spinner trinity-rings-spinner-' . $random_string_thingy . '"><div class="circle"></div><div class="circle"></div><div class="circle"></div></div>';
		}
		if ($nick_name == "fulfilling-square-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.fulfilling-square-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';color:' . $spinner_color . ';}.fulfilling-square-spinner-' . $random_string_thingy . ' .spinner-inner{background-color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="fulfilling-square-spinner fulfilling-square-spinner-' . $random_string_thingy . '"><div class="spinner-inner"></div></div>';
		}
		if ($nick_name == "circles-to-rhombuses-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.circles-to-rhombuses-spinner-' . $random_string_thingy . '{height:' . $spinner_size . '; width:calc( (' . $spinner_size. ' + ' . $spinner_size. '*1.125)*3 );}.circles-to-rhombuses-spinner-' . $random_string_thingy . ' .circle{height:' . $spinner_size . ';width:' . $spinner_size. ';margin-left:calc(' . $spinner_size. '*1.125);color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="circles-to-rhombuses-spinner circles-to-rhombuses-spinner-' . $random_string_thingy . '"><div class="circle"></div><div class="circle"></div><div class="circle"></div></div>';
		}
		if ($nick_name == "semipolar-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.semipolar-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.semipolar-spinner-' . $random_string_thingy . ' .ring{border:calc(' . $spinner_size. '*0.05) solid transparent;border-top-color:' . $spinner_color . ';border-left-color:' . $spinner_color . ';color:' . $spinner_color . ';}.semipolar-spinner-' . $random_string_thingy . ' .ring:nth-child(1){height:calc(' . $spinner_size . ' - ' . $spinner_size . '*0.2*0);width:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*0);top:calc(' . $spinner_size . '*0.1*0);left:calc(' . $spinner_size . '*0.1*0);}.semipolar-spinner-' . $random_string_thingy . ' .ring:nth-child(2){height:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*1);width:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*1);top:calc(' . $spinner_size . '*0.1*1);left:calc(' . $spinner_size . '*0.1*1);}.semipolar-spinner-' . $random_string_thingy . ' .ring:nth-child(3){height:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*2);width:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*2);top:calc(' . $spinner_size . '*0.1*2);left:calc(' . $spinner_size . '*0.1*2);}.semipolar-spinner-' . $random_string_thingy . ' .ring:nth-child(4){height:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*3);width:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*3);top:calc(' . $spinner_size . '*0.1*3);left:calc(' . $spinner_size . '*0.1*3);}.semipolar-spinner-' . $random_string_thingy . ' .ring:nth-child(5){height:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*4);width:calc(' . $spinner_size . '-' . $spinner_size . '*0.2*4);top:calc(' . $spinner_size . '*0.1*4);left: calc(' . $spinner_size . '*0.1*4);}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="semipolar-spinner semipolar-spinner-' . $random_string_thingy . '" :style="spinnerStyle"><div class="ring"></div><div class="ring"></div><div class="ring"></div><div class="ring"></div><div class="ring"></div></div>';
		}
		if ($nick_name == "self-building-square-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.self-building-square-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';top: calc( calc(-' . $spinner_size. ' /4)*2/3);}.self-building-square-spinner-' . $random_string_thingy . ' .square{height:calc(' . $spinner_size. '/4);width: calc(' . $spinner_size. '/4);top:calc(calc(-' . $spinner_size. '/4)*2/3);margin-right:calc(calc(' . $spinner_size. '/4)/3);margin-top:calc(calc(' . $spinner_size. '/4)/3);background:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="self-building-square-spinner self-building-square-spinner-' . $random_string_thingy . '"><div class="square"></div><div class="square"></div><div class="square"></div><div class="square clear"></div><div class="square"></div><div class="square"></div><div class="square clear"></div><div class="square"></div><div class="square"></div></div>';
		}
		if ($nick_name == "swapping-squares-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.swapping-squares-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.swapping-squares-spinner-' . $random_string_thingy . ' .square{height:calc(' . $spinner_size . '*0.25/1.3);width:calc(' . $spinner_size . '*0.25/1.3);color:' . $spinner_color . ';}';
		self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="swapping-squares-spinner swapping-squares-spinner-' . $random_string_thingy . '" :style="spinnerStyle"><div class="square"></div><div class="square"></div><div class="square"></div><div class="square"></div></div>';
		}
		if ($nick_name == "fulfilling-bouncing-circle-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.fulfilling-bouncing-circle-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.fulfilling-bouncing-circle-spinner-' . $random_string_thingy . ' .orbit{height:' . $spinner_size . ';width:' . $spinner_size. ';border: calc(' . $spinner_size . '  * 0.03) solid currentColor;color:' . $spinner_color . ';}.fulfilling-bouncing-circle-spinner-' . $random_string_thingy . ' .circle{height:' . $spinner_size . ';width:' . $spinner_size. ';border:calc(' . $spinner_size . '*0.1) solid currentColor;color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="fulfilling-bouncing-circle-spinner fulfilling-bouncing-circle-spinner-' . $random_string_thingy . '"><div class="circle"></div><div class="orbit"></div></div>';
		}
		if ($nick_name == "fingerprint-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.fingerprint-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring{color:' . $spinner_color . ';}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(1){height:calc(' . $spinner_size . '/9+0*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+0*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(2){height:calc(' . $spinner_size . '/9+1*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+1*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(3){height: calc(' . $spinner_size . '/9+2*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+2*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(4){height: calc(' . $spinner_size . '/9+3*' . $spinner_size . '/9);width: calc(' . $spinner_size . '/9+3*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(5){height:calc(' . $spinner_size . '/9+4*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+4*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(6){height:calc(' . $spinner_size . '/9+5*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+5*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(7){height:calc(' . $spinner_size . '/9+6*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+6*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(8){height:calc(' . $spinner_size . '/9+7*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+7*' . $spinner_size . '/9);}.fingerprint-spinner-' . $random_string_thingy . ' .spinner-ring:nth-child(9){height:calc(' . $spinner_size . '/9+8*' . $spinner_size . '/9);width:calc(' . $spinner_size . '/9+8*' . $spinner_size . '/9);}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="fingerprint-spinner fingerprint-spinner-' . $random_string_thingy . '"><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div></div>';
		}
		if ($nick_name == "spring-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.spring-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.spring-spinner-' . $random_string_thingy . ' .spring-spinner-part{height:calc(' . $spinner_size . '/2);width:' . $spinner_size. ';}.spring-spinner-' . $random_string_thingy . ' .spring-spinner-rotator{height:' . $spinner_size . ';width:' . $spinner_size. ';border:calc(' . $spinner_size. '/7) solid transparent;border-right-color: ' . $spinner_color . ';border-top-color:' . $spinner_color . ';color:' . $spinner_color . ';}@keyframes spring-spinner-animation{0%{border-width: calc(' . $spinner_size . '/7);}25%{border-width:calc(' . $spinner_size . '/23.33);}50%{transform: rotate(115deg);border-width:calc(' . $spinner_size . '/7);}75%{border-width:calc(' . $spinner_size . '/23.33);}100%{border-width:calc(' . $spinner_size . '/7);}}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="spring-spinner spring-spinner-' . $random_string_thingy . '"><div class="spring-spinner-part top"><div class="spring-spinner-rotator"></div></div><div class="spring-spinner-part bottom"><div class="spring-spinner-rotator"></div></div></div>';
		}
		if ($nick_name == "looping-rhombuses-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.looping-rhombuses-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:calc(' . $spinner_size. '*4);}.looping-rhombuses-spinner-' . $random_string_thingy . ' .rhombus{height:' . $spinner_size . ';width:' . $spinner_size. ';left:calc(' . $spinner_size. '*4);color:' . $spinner_color . ';}';
    self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="looping-rhombuses-spinner looping-rhombuses-spinner-' . $random_string_thingy . '"><div class="rhombus"></div><div class="rhombus"></div><div class="rhombus"></div></div>';
		}
		if ($nick_name == "breeding-rhombus-spinner") {
		$random_string_thingy = self::generateRandomString(10);
		$inline_css = '.breeding-rhombus-spinner-' . $random_string_thingy . '{height:' . $spinner_size . ';width:' . $spinner_size. ';}.breeding-rhombus-spinner-' . $random_string_thingy . ' .rhombus{height:calc(' . $spinner_size . '/7.5);width: calc(' . $spinner_size . '/7.5);top:calc(' . $spinner_size . '/2.3077);left:calc(' . $spinner_size . '/2.3077);color:' . $spinner_color . ';}.breeding-rhombus-spinner-' . $random_string_thingy . ' .rhombus.big{height:calc(' . $spinner_size . '/3);width:calc(' . $spinner_size . '/3);top:calc(' . $spinner_size . '/3);left:calc(' . $spinner_size . '/3);}';
		self::enqueue_styles_inline_public($inline_css);
		$output_html = '<div class="breeding-rhombus-spinner breeding-rhombus-spinner-' . $random_string_thingy . '"><div class="rhombus child-1"></div><div class="rhombus child-2"></div><div class="rhombus child-3"></div><div class="rhombus child-4"></div><div class="rhombus child-5"></div><div class="rhombus child-6"></div><div class="rhombus child-7"></div><div class="rhombus child-8"></div><div class="rhombus big"></div></div>';
		}
		return $output_html;
	}

	/**
	 * create a button for wp editor
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
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
	 * @since 1.0.0
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
	 * @since 1.0.0
	 *
	 * @param  array  $links List of existing plugin action links.
	 * @return array         List of modified plugin action links.
	 */

	public

	function epic_spinners_plugin_action_link( $links ) {
		$links = array_merge( array(
			'<i class="wp-menu-image dashicons-before dashicons-admin-tools"></i><a href="' . esc_url( admin_url( 'admin.php?page=epic-spinners/admin/partials/epic-spinners-admin-display.php' ) ) . '">' . __( 'Settings', epic_spinners::TEXTDOMAIN ) . '</a> | <i class="wp-menu-image dashicons-before dashicons-share-alt"></i><a href="' . esc_url( 'https://paypal.me/kiipforwordpress' ) . '" style="color:#00ff0a; font-weight:bold;">' . __( 'Donate', epic_spinners::TEXTDOMAIN ) . '</a> | <i class="wp-menu-image dashicons-before dashicons-star-filled"></i><a href="' . esc_url( 'https://wordpress.org/support/plugin/epic-spinners/reviews/' ) . '">' . __( 'Review', epic_spinners::TEXTDOMAIN ) . '</a>'
		), $links );
		return $links;
	}

	/**
	 * shortcode text area with codemirror js
	 *
	 * @since    1.0.0
	 *
	 */

	// Display textarea on admin settings page.
	public

	function epic_spinners_admin_page_textarea() {
		// output text area
		$textarea =
			"<textarea rows=\"30\" cols=\"40\" class=\"CodeMirror-linenumbers\" id=\"newcontent\" name=\"newcontent\">\n\n&#91;epicspin type=\"orbit-spinner\"&#93;\n\n&#91;epicspin type=\"atom-spinner\"&#93;\n\n&#91;epicspin type=\"flower-spinner\"&#93;\n\n&#91;epicspin type=\"pixel-spinner\"&#93;\n\n&#91;epicspin type=\"hollow-dots-spinner\"&#93;\n\n&#91;epicspin type=\"intersecting-circles-spinner\"&#93;\n\n&#91;epicspin type=\"radar-spinner\"&#93;\n\n&#91;epicspin type=\"scaling-squares-spinner\"&#93;\n\n&#91;epicspin type=\"half-circle-spinner\"&#93;\n\n&#91;epicspin type=\"trinity-rings-spinner\"\n\n&#91;epicspin type=\"fulfilling-square-spinner\"&#93;\n\n&#91;epicspin type=\"circles-to-rhombuses-spinner\"&#93;\n\n&#91;epicspin type=\"semipolar-spinne\"&#93;\n\n&#91;epicspin type=\"self-building-square-spinner\"&#93;\n\n&#91;epicspin type=\"swapping-squares-spinner\"&#93;\n\n&#91;epicspin type=\"fulfilling-bouncing-circle-spinner\"&#93;\n\n&#91;epicspin type=\"fingerprint-spinner\"&#93;\n\n&#91;epicspin type=\"spring-spinner\"&#93;\n\n&#91;epicspin type=\"looping-rhombuses-spinner\"&#93;\n\n&#91;epicspin type=\"breeding-rhombus-spinner\"&#93;\n</textarea>";
		return $textarea;
	}

	/**
	 * attribute function
	 *
	 * @since    1.0
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
	 * @since    1.0
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
	 * @since    1.0
	 *
	 */

	public

	function epic_spinners_the_url() {
		/* url to the folder. */
		$url = trailingslashit( plugins_url( basename( __DIR__ ) ) );
		return ( $url );
	}

	/**
	 * generate a random alpha\num string
	 *
	 * @since    1.0.1
	 *
	 */

  public

  function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

}
}
/**
 * The instantiated version of this plugin's main class
 */

$epic_spinners = epic_spinners::init();

/**
 * path to directory function (outside class) @TODO: move to widget class
 *
 * @since    1.0
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
 * @since    1.0
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
 * @since    1.0
 *
 */

function es_admin_get_current_screen() {
    global $current_screen;
    if ( ! isset( $current_screen ) )
        return null;
    return $current_screen->id;
}
