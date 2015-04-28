<?php
/**
 * Mana Container Class
 * 
 * @package    Harmony
 * @subpackage Mana
 * @author     Simon Holloway <holloway.sy@gmail.com>
 * @license    http://opensource.org/licenses/MIT MIT
 */

namespace Harmony\Mana;

/**
 * Class Container
 *
 * The Container hold global(ish) data so packages and modules can share
 * components/config/instances/ect... Also known as a service locator
 * 
 * @author  Simon Holloway <holloway.sy@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
class Container extends Map 
{
	/**
	 * The currently used container instance
	 * 
	 * @var Container
	 */
	private static $instance;
	
	/**
	 * Get the current instance, will generate a new one if none available
	 * 
	 * @return Container
	 */
	public static function get_instance()
	{
		if ( ! self::$instance ) {
			self::new_instance();
		}

		return self::$instance;	
	}

	/**
	 * Set the current container instance to passed object.
	 * 
	 * @param Container $newcontainer
	 */
	public static function set_instance(Container $newContainer)
	{
		self::$instance = $newContainer;	
	}

	/**
	 * Set the current container instance to a new instance of this object.
	 */
	public static function new_instance()
	{
		self::$instance = new self;	
	}

	/**
	 * Call a method stored in the container using the first param
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
	 * Call a method stored in the container using the first param
	 * to locate the callable, and the rest of the params will be 
	 * passed into the callable as args.
	 * 
	 * @param string $key
	 * @return mixed
	 */
	public static function call_with($key)
	{
		$args = func_get_args();
		array_shift($args);
		
		if ($this->data[$key] && is_callable($this->data[$key])) {
			return call_user_func_array($this->data[$key], $args);
		}
	}

	/**
	 *
	 * 
	 * @param string $key
	 * @return mixed
	 */
	public static function alias($key)
	{
		
	}
}
