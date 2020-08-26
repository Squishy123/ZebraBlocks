<?php
/**
 * Plugin Name: ZebraBlocks
 * Plugin URI: https://github.com/squishy123/zebrablocks
 * Description: ZebraBlocks is a funnelbuilder plugin
 * Author: squishy123
 * Author URI: cwang.work
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';


/**
 * Menu Setup
 */
require_once plugin_dir_path( __FILE__ ) . 'src/settings.php';
