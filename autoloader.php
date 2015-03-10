<?php
/**
 * Runes Autoloader
 * 
 * @package    Harmony
 * @subpackage Runes
 * @author     Simon Holloway <holloway.sy@gmail.com>
 * @license    http://opensource.org/licenses/MIT MIT
 */


/**
 * Return a callback thats passed an "init" function, this function decides 
 * when its run, so we can listen for dependencies
 *
 * @param string $init_function
 */
$onReady =  function ($init_function) {
    call_user_func($init_function);
};

// If the autoload has already been run...
if (defined('RUNES_AUTOLOADED')) {
    return $onReady;
}

/**
 * PSR-4 Autoloader
 *      
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'Harmony\\Runes\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

// Load the functions file to define all functions
require('functions.php');

// Mark the package as autoloaded
define('RUNES_AUTOLOADED', true);

return $onReady;