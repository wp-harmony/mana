<?php
/**
 * Mana - Foundation and Utilities
 * 
 * Part of the Harmony Group
 * 
 * Plugin Name: Harmony Mana
 * 
 * @package    Harmony
 * @subpackage Mana
 * @author     Simon Holloway <holloway.sy@gmail.com>
 * @license    http://opensource.org/licenses/MIT MIT
 * @version    2.0.0
 */

use Harmony\Mana\Container;
use Harmony\Mana\Autoloader;

function harmony_load()
{
	$container = harmony_init();

	do_action('harmony_register', $container);
	do_action('harmony_boot', $container);
	do_action('harmony_loaded', $container);

	return $container;
}

add_action('wp_loaded', 'harmony_load');

function harmony_init()
{
	require('src/Autoloader.php');
	require('functions.php');

	$autoloader = new Autoloader;
	$autoloader->register();
	$autoloader['Harmony\Mana'] = __DIR__ . '/src';
	
	$container = Container::get_instance();
	$container['Harmony\Mana\Autoloader'] = $autoloader;
	$container->alias('autoloader', 'Harmony\Mana\Autoloader');

	return $container;
}