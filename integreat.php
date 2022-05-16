<?php 
/**
 * Plugin Name: Integreat Search Widget
 * Description: This plugin embeds a search bar for the app Integreat. 
 * Plugin URI:  https://integreat.app
 * Version:     1.0
 * Author:      Johannes Stock
 * Author URI:  none
 * License:     Apache 2.0
 * License URI: https://www.apache.org/licenses/LICENSE-2.0.txt
 * Text Domain: integreat-search-widget
 * Domain Path: /languages
 */

wp_register_style( 'integreat', plugin_dir_url(__FILE__) . 'assets/styles.css' );
wp_enqueue_style('integreat');

add_action( 'plugins_loaded', function() {
    load_plugin_textdomain( 'integreat-search-widget', false, basename( dirname( __FILE__ )) . '/languages');
});

require 'functions/integreat_setting.php';
require 'functions/integreat_shortcode.php';

?>
