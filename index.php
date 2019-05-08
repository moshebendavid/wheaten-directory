<?php
/*
Plugin Name: Wheaten Directory
Plugin URI: http://moshebendavid.com/
Description: Custom Members and Breeders Directory
Version: 1.0
Author: Moshe BenDavid
Author URI: http://moshebendavid.com
License: GPL
*/
define('WHEATEN_PATH', plugin_dir_path(__FILE__));

define('WHEATEN_URL', plugin_dir_url( __FILE__ ) );

register_activation_hook(__FILE__,'wheaten_directory_install');

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'wheaten_directory_remove' );




if ( is_admin() ){
	add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
  add_filter('pre_option_update_core','__return_null');
  add_filter('pre_site_transient_update_core','__return_null');
	function load_custom_wp_admin_style() {
		wp_enqueue_style( 'fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'bootstrap', WHEATEN_URL.'assets/plugins/bootstrap/css/bootstrap.min.css' );
		wp_enqueue_style( 'style', WHEATEN_URL.'css/style.css' );
		wp_enqueue_style( 'blue', WHEATEN_URL.'css/colors/default-dark.css' );
		wp_enqueue_style( 'select2', WHEATEN_URL.'assets/plugins/select2/dist/css/select2.min.css' );
		wp_enqueue_script( 'html5', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');
		wp_enqueue_script( 'respond', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js' );
		wp_enqueue_script( 'popper', WHEATEN_URL.'assets/plugins/bootstrap/js/popper.min.js' );
		wp_enqueue_script( 'bootstrap', WHEATEN_URL.'assets/plugins/bootstrap/js/bootstrap.min.js' );
				wp_enqueue_script( 'select22', WHEATEN_URL.'assets/plugins/select2/dist/js/select2.full.min.js' );
		wp_enqueue_script( 'slimscroll', WHEATEN_URL.'js/jquery.slimscroll.js' );
		wp_enqueue_script( 'waves', WHEATEN_URL.'js/waves.js' );
		wp_enqueue_script( 'sidebarmenu', WHEATEN_URL.'js/sidebarmenu.js' );
		wp_enqueue_script( 'sticky', WHEATEN_URL.'assets/plugins/sticky-kit-master/dist/sticky-kit.min.js' );
		wp_enqueue_script( 'spark', WHEATEN_URL.'assets/plugins/sparkline/jquery.sparkline.min.js' );
		wp_enqueue_script( 'dataTables', WHEATEN_URL.'assets/plugins/datatables/jquery.dataTables.min.js' );

		wp_enqueue_script( 'dataTablebuttons', 'https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js', true );
		wp_enqueue_script( 'custom', WHEATEN_URL.'js/custom.min.js' );




	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

	add_action('admin_head', 'admin_styles');

	function admin_styles() {
	    echo '<style>
	        .card{
		max-width: 100%;
		padding: initial;
	        }

	    </style>';
	}


add_action( 'admin_menu', 'wheaten_directory_admin_menu' );

function wheaten_directory_admin_menu() {
	add_menu_page( 'Wheaten Club Management', 'Wheaten Club', 'manage_options', 'wheaten-club', 'wheaten_directory_admin_page', 'dashicons-tickets', 6  );
}


/* Call the html code */
function wheaten_directory_admin_page(){
	include (WHEATEN_PATH . 'config/index.php');
	include (WHEATEN_PATH . 'options.php');
}

}
