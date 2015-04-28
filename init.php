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



function load_harmony()
{
	$container = register_harmony_autoloader();

	do_action('harmony_register', $container);
	do_action('harmony_boot', $container);
	do_action('harmony_loaded', $container);

	return $container;
}

add_action('plugins_loaded', 'load_harmony');

function register_harmony_autoloader()
{
	$autoloader = require('src/Autoloader.php');

	$autoloader['Harmony\Mana'] = __DIR__ . '/src';
	$container = Harmony\Mana\Container;
	$container['Harmony\Mana\Autoloader'] = $autoloader;
	$container->alias('autoloader', 'Harmony\Mana\Autoloader');
	$container->factory('test', function() {
		$z = new Y(new X);
		$z->setSomething(new W);
		return $z;
	});

	$container->singleton('test', function() {
		$z = new Y(new X);
		$z->setSomething(new W);
		return $z;
	});

	return $container;
}