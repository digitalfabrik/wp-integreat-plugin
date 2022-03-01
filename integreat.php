<?php 
/**
 * Plugin Name: Integreat App
 * Description: This plugin embeds a search bar of the App Integreat. 
 * Plugin URI:  https://integreat.app
 * Version:     1.0
 * Author:      Johannes Stock
 * Text Domain: integreat
 * Author URI:  none
 * Domain Path: /languages
 */

wp_register_style( 'namespace', plugin_dir_url(__FILE__) . 'assets/styles.css' );
wp_enqueue_style('namespace');

add_action( 'plugins_loaded', function() {
    load_plugin_textdomain( 'integreat-translation', false, basename(dirname(__FILE__) . '\languages'));
});

// function ig_ac_generate_selection_box() {
// 	add_meta_box( 'ig_ac_metabox', __( 'Live-Content', 'ig-attach-content' ), 'ig_ac_create_metabox', 'page', 'side' );
// }
// add_action( 'add_meta_boxes_page', 'ig_ac_generate_selection_box' );

require 'functions/integreat_setting.php';
require 'functions/integreat_shortcode.php';

?>
