<?php
/**
 * Runes - Utility Libary
 *
 * Part of the Harmony Group
 * 
 * Plugin Name: Harmony - Runes
 * 
 * @package Divinity
 * @subpackage Runes
 * @author  Simon Holloway <holloway.sy@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @version 2.0.0
 */

if ( ! defined('RUNES_AUTOLOADED') ) {
	require('autoloader.php');
}

require('functions.php');

/**
 * 
 * 
 * @return void
 */
function runes_init()
{
	do_action('runes_loaded');
}

runes_init();
