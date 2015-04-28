<?php
/**
 * Runes Registery Class
 * 
 * @package    Harmony
 * @subpackage Runes
 * @author     Simon Holloway <holloway.sy@gmail.com>
 * @license    http://opensource.org/licenses/MIT MIT
 */

namespace Harmony\Runes;

use ArrayAccess;
use IteratorAggregate; 
use ArrayIterator;

/**
 * Class Registery
 *
 * The registery hold global(ish) data so packages and modules can share
 * components/config/instances/ect... Also known as a service locator
 * 
 * @author  Simon Holloway <holloway.sy@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
class Registery extends Map 
{
	/**
	 * The currently used registery instance
	 * 
	 * @var Registery
	 */
	private static $instance;
	
	/**
	 * Get the current instance, will generate a new one if none available
	 * 
	 * @return Registery
	 */
	public static function get_instance()
	{
		if ( ! self::$instance ) {
			self::new_instance();
		}

		return self::$instance;	
	}

	/**
	 * Set the current registery instance to passed object.
	 * 
	 * @param Registery $newRegistery
	 */
	public static function set_instance(Registery $newRegistery)
	{
		self::$instance = $newRegistery;	
	}

	/**
	 * Set the current registery instance to a new instance of this object.
	 */
	public static function new_instance()
	{
		self::$instance = new self;	
	}

	/**
	 * Call a method stored in the registery using the first param
	 * to locate the callable and the second param will be passed 
	 * into the callable as args.
	 * 
	 * @param string $key
	 * @param array $args
	 * @return mixed
	 */
	public static function call($key, $args = array())
	{
		if ($this->data[$key] && is_callable($this->data[$key])) {
			return call_user_func_array($this->data[$key], $args);
		}
	}
	
	
	/**
	 * Call a method stored in the registery using the first param
	 * to locate the callable, and the rest of the params will be 
	 * passed into the callable as args.
	 * 
	 * @param string $key
	 * @return mixed
	 */
	public static function callWith($key)
	{
		$args = func_get_args();
		array_shift($args);
		
		if ($this->data[$key] && is_callable($this->data[$key])) {
			return call_user_func_array($this->data[$key], $args);
		}
	}
}
