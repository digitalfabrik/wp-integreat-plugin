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

require 'functions/integreat_setting.php';
require 'functions/integreat_shortcode.php';

?>
