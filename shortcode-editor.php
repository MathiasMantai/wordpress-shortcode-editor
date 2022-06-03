<?php
/**
 * Plugin Name:      Shortcode Editor
 * Plugin URI:       http://www.mywebsite.com/my-first-plugin
 * Description:      Shortcode Editor für
 * Version:          1.0.0
 * License:          GPL2
 * Author:           Mathias Mantai
 * Author URI:       http://www.mywebsite.com
 * Text Domain:      shortcode-editor
 */

if (!defined('ABSPATH')) { exit; }
require_once 
function initPlugin() {
    initDB();
}

function initDB() {
    global $table_prefix, $wpdb;
	$table = $table_prefix . 'shortcode-editor';

		$sql = "CREATE TABLE IF NOT EXISTS `$table` (";
		$sql .= " `id` int(11) NOT NULL auto_increment, ";
		$sql .= " `label` varchar(20) NOT NULL, ";
		$sql .= " `shortcode` varchar(500) NOT NULL, ";
		$sql .= " PRIMARY KEY `customer_id` (`id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

		require_once(ABSPATH.'/wp-admin/includes/upgrade.php');
		dbDelta($sql);	
}

function initShortcodes() {
    $short = "";
    $shortcodes = getShortcodes();
    foreach($shortcodes as $shortcode) {
        $short = $shortcode->shortcode;
        add_shortcode($shortcode->label, function() use($short) {print $short;});
    }
}


initShortcodes();

register_activation_hook(__FILE__, 'initPlugin');

?>