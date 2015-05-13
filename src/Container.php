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
	 * Alias map for item in the container
	 * 
	 * @var array
	 */
	private $aliases = array();

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
	 * Get data
	 *
	 * @param string  $index   (optional) get data from key provided else return all data 
	 * @param mixed   $default (optional) returns when index not found 
	 * @param boolean $strict  (optional) passing false will fail if the value is empty 
	 * @return mixed
	 */
	public function get($index = null, $default = null, $strict = true)
	{
		if (isset($this->aliases[$index])) {
			$index = $this->aliases[$index];
		}

		return parent::get($index, $default, $strict);	
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
	public function call($key, $args = array())
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
	public function call_with($key)
	{
		$args = func_get_args();
		array_shift($args);
		
		if ($this->data[$key] && is_callable($this->data[$key])) {
			return call_user_func_array($this->data[$key], $args);
		}
	}

	/**
	 * Define an alias for an item, when the alias is called, the concrete is
	 * returned.
	 * 
	 * @param string $alias
	 * @param string $concrete
	 * @return mixed
	 */
	public function alias($alias, $concrete)
	{
		$this->aliases[$alias] = $concrete;
	}
}
