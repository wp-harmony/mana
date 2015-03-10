<?php
/**
 * Runes - Utility Library
 * 
 * Part of the Harmony Group
 * 
 * Plugin Name: Harmony Runes
 * 
 * @package    Harmony
 * @subpackage Runes
 * @author     Simon Holloway <holloway.sy@gmail.com>
 * @license    http://opensource.org/licenses/MIT MIT
 * @version    2.0.0
 */

$onReady = require('autoloader.php');

/**
 * Initialize Runes
 * 
 * @return void
 */
$onReady(function ()
{
	define('RUNES_LOADED', true);
	do_action('runes_loaded');
});
