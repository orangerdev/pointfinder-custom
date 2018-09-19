<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wp-expert-indonesia.com
 * @since      1.0.0
 *
 * @package    Pfcm
 * @subpackage Pfcm/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pfcm
 * @subpackage Pfcm/public
 * @author     Ridwan Arifandi <orangerdigiart@gmail.com>
 */
class Pfcm_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		wp_register_style 	('owl-theme'	,'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css',[],'2.3.4','all');
		wp_register_style	('owlcarousel'	,'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css',['owl-theme'],'2.3.4','all');
		wp_enqueue_style	($this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pfcm-public.css',['owlcarousel'], $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_register_script	('owlcarousel'	,'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',['jquery'],'2.3.4',true);
		wp_enqueue_script	( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pfcm-public.js',['jquery','owlcarousel'], $this->version, true );

	}

	/**
	 * Display image
	 * @param  [type] $images  [description]
	 * @param  [type] $post_id [description]
	 * @return [type]          [description]
	 */
	public function display_image($featured_images,$post_id)
	{
		$images = get_post_meta($post_id,'webbupointfinder_item_images');

		if(1 < count($images)) :
			ob_start();
			require PFCM_DIR.'/public/partials/shop-image-carousel.php';
			$featured_images = ob_get_contents();
			ob_end_clean();
		endif;
		return $featured_images;
	}

}
