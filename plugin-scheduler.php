<?php
/**
 * Plugin Name: Plugin Scheduler
 * Plugin URI:
 * Description: Schedule when a plugin is activated or deactivated
 * Author: Dan Beil
 * Author URI: add_action_dan.me
 * Version: 0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

require_once( 'inc/plugin-scheduler.php' );

wp_get_active_and_valid_plugins();