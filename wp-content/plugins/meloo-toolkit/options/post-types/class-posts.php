<?php
/**
 * Rascals Register MetaBox
 *
 * Register Posts
 *
 * @author Rascals Themes
 * @category Core
 * @package Meloo Toolkit
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Meloo_Toolkit_Posts' ) ) {
	class Meloo_Toolkit_Posts {
		
		/*
		Public variables
		 */
		public $plugin_path = null;

		/**
		 * Constructor.
		 * @return void
		 */
		public function __construct() {
			$this->init();
		}

		/**
		 * Initialize class
		 * @return void
		 */
		public function init() {

			// Set plugin path
			$this->plugin_path = RASCALS_TOOLKIT_PATH;

			// Include main RascalsBox class
			include_once( $this->plugin_path . '/core/cpt/class-cpt.php' );

			$this->includesPosts();

		}


		/**
		 * Register Post Type
		 * @return void
		 */
		public function includesPosts() {

			include_once( $this->plugin_path . '/options/post-types/class-artists.php' );
			$artists = new MelooToolkitArtists();

			include_once( $this->plugin_path . '/options/post-types/class-events-manager.php' );
			$events = new MelooToolkitEventsManager();

			include_once( $this->plugin_path . '/options/post-types/class-gallery.php' );
			$gallery = new MelooToolkitGallery();

			include_once( $this->plugin_path . '/options/post-types/class-music.php' );
			$music = new MelooToolkitMusic();

			include_once( $this->plugin_path . '/options/post-types/class-videos.php' );
			$videos = new MelooToolkitVideos();

			include_once( $this->plugin_path . '/options/post-types/class-tracks-libary.php' );
			$videos = new MelooToolkitTracksLibary();
		
		}


		/**
		 * Get Revo Slider list
		 * @param  null
		 * @version 1.1.0 [compatible with Revo Slider 6+]
		 * @return array
		 */
		public function getRevoSliders(){
		    $intro_revslider = array( array( 'name' => esc_html__( 'Select slider...', 'angio-toolkit' ), 'value' => '' ) );
		    if ( class_exists( 'RevSlider' ) && function_exists( 'rev_slider_shortcode' ) ) {
		    	if ( defined('RS_REVISION') && version_compare( RS_REVISION, '6.0.0' ) >= 0 ) {
			        $rev_slider = new RevSlider();
			        $slides = $rev_slider->get_sliders();
			        if ( ! empty( $slides ) ) {
			            $count = 1;
			            foreach ($slides as $slide) {
			                $alias = $slide->alias;
		                    $title = $slide->title;
			                $intro_revslider[$count]['name'] = $title;
				            $intro_revslider[$count]['value'] = $alias;
			                $count++;
			            }
			        }
			    }
		    } 
		    return $intro_revslider;
		}


		/**
		 * Get Slider list
		 * @param  post_name string
		 * @return array
		 */
		public function getSlider( $post_name = null ){
		    global $wpdb;

		    $intro_slider = array( array( 'name' => esc_html__( 'Select slider...', 'angio-toolkit' ), 'value' => '' ) );
		    
			$slider_post_type = $post_name;
			$slider_query = $wpdb->prepare(
				"
			    SELECT
					{$wpdb->posts}.id,
					{$wpdb->posts}.post_title
			  	FROM 
					{$wpdb->posts}
			  	WHERE
					{$wpdb->posts}.post_type = %s
				AND 
					{$wpdb->posts}.post_status = 'publish'
				",
				$slider_post_type
			);

			$sql_slider = $wpdb->get_results( $slider_query );
			  
			if ( $sql_slider ) {
				$count = 1;
				foreach( $sql_slider as $slider_post ) {
					$intro_slider[$count]['name'] = $slider_post->post_title;
					$intro_slider[$count]['value'] = $slider_post->id;
					$count++;
				}
			}

		    return $intro_slider;
		}


		/**
		 * Get Music Tracks
		 * @param  post_name string
		 * @return array
		 */
		function getTracks( $post_name = null ){
			global $wpdb;

			/* Get Audio Tracks  */
			$tracks = array( array( 'name' => esc_html__( 'Select tracks...', 'angio-toolkit' ), 'value' => 'none' ) );

			$tracks_post_type = $post_name;
			$tracks_query = $wpdb->prepare(
				"
			    SELECT
					{$wpdb->posts}.id,
					{$wpdb->posts}.post_title
			  	FROM 
					{$wpdb->posts}
			  	WHERE
					{$wpdb->posts}.post_type = %s
				AND 
					{$wpdb->posts}.post_status = 'publish'
				",
				$tracks_post_type
			);

			$sql_tracks = $wpdb->get_results( $tracks_query );
			  
			if ( $sql_tracks ) {
				$count = 1;
				foreach( $sql_tracks as $track_post ) {
					$tracks[$count]['name'] = $track_post->post_title;
					$tracks[$count]['value'] = $track_post->id;
					$count++;
				}
			}

			return $tracks;
		}


		/**
		 * Get Custom Sidebars
		 * @param  $panel_name
		 * @param  $option_name
		 * @return array
		 */
		function getSidebars( $panel_name = null, $option_name = 'custom_sidebars' ){
			
			$panel_options = get_option( $panel_name );

			if ( isset( $panel_options[ $option_name ] ) ) {
				$s_list = $panel_options[ $option_name ];
				$temp_list = array();
				foreach ($s_list as $key => $li) {
					$temp_list[$key]['name'] = $li['name'];
					$temp_list[$key]['value'] = sanitize_title_with_dashes( $li['name'] );
				}
				$s_list = $temp_list;

			} else {
				$s_list = null;
			}
			return $s_list;
		}


		/**
		 * Get all registered KC sections
		 * @return array
		 */
		public function getKCSections( ) {

			$kc_sections = array( array( 'name' => esc_html__( 'Select Section', 'angio-toolkit' ), 'value' => 'none' ) );
			if ( function_exists('kc_add_map') ) {
				$kc_posts = get_posts( array('post_type' => 'kc-section', 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1 ) ); 
				if ( isset( $kc_posts ) && is_array( $kc_posts ) ) {
					$count = 1;
					foreach ( $kc_posts as $post ) {
						$kc_sections[$count]['name'] = $post->post_title;
						$kc_sections[$count]['value'] = $post->ID;
						$count++;
					}
				}
			}

			return $kc_sections;
		}

	}

	return new Meloo_Toolkit_Posts();
}