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

function harmony_load()
{
	$container = harmony_init();

	do_action('harmony_register', $container);
	do_action('harmony_boot', $container);
	do_action('harmony_loaded', $container);

	return $container;
}

add_action('plugins_loaded', 'harmony_load');

function harmony_init()
{
	$autoloader = require('src/Autoloader.php');
	$autoloader['Harmony\Mana'] = __DIR__ . '/src';

	$container = new Container;
	$container['Harmony\Mana\Autoloader'] = $autoloader;
	$container->alias('autoloader', 'Harmony\Mana\Autoloader');

	return $container;
}