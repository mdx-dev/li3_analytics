<?php

namespace li3_analytics\extensions;

use lithium\util\String;
use lithium\util\Inflector;

class Trackers extends \lithium\core\Adaptable {
	/**
	 * Which session variable will be used to store the commands.
	 *
	 * @var string
	 */
	public static $name = 'Trackers';

	/**
	 * To be re-defined in sub-classes.
	 *
	 * @var object `Collection` of configurations, indexed by name.
	 */
	protected static $_configurations = array();

	/**
	 * Groups trackers by the section they're supposed to be loaded from
	 * @var array
	 */
	public static $_sections = array();

	/**
	 * Path where to look for tracking adapters.
	 *
	 * @var string
	 */
	protected static $_adapters = 'adapter.tracking';

	/**
	 * Class dependencies.
	 *
	 * @var array
	 */
	protected static $_classes = array(
		'session' => 'lithium\\storage\\Session'
	);

	public static function configs(){
		return static::$_configurations;
	}

	public static function add($name, array $config = array()) {

		$session = static::$_classes['session'];

		$name = self::_normalizeName($name);

		$defaults = array(
			'adapter'     => '',
			'name' => $name
		);

		return static::$_configurations[$name] = $config + $defaults;
	}

	/**
	 * Obtain the tracker
	 */
	public static function get($name = null, array $options = array()) {

		if($name === null){

			foreach(static::$_configurations as $name => $config){

				$tracker = static::adapter($name);

				$views = $tracker->views();
				foreach($views as $section => $view) {
					static::$_sections[$section][$tracker->name()] = array(
						'tracker' => $tracker,
						'view' => $view
					);
				}

			}

			return static::$_sections;

		}

		$name = self::_normalizeName($name);

		if (!isset(static::$_configurations[$name])) {
			return null;
		}

		$settings = static::$_configurations[$name];

		return static::adapter($name);

	}

	/**
	 * Standard way of validating/filtering the name
	 *
	 * @param  string $name
	 * @return string
	 */
	protected static function _normalizeName($name) {
		return strtolower(Inflector::slug($name));
	}

	/**
	 * Push a command to be run by the tracker.
	 *
	 * {{{
	 * Trackings::push('_setDomain', 'example.org');
	 * }}}
	 */
	// public static function push(/* anything */) {
	// 	$name = 'default';
	// 	$session = static::$_classes['session'];

	// 	$commands = $session::read(static::$name, compact('name')) ?: array();
	// 	$commands[] = func_get_args();
	// 	$session::write(static::$name, $commands, compact('name'));
	// }

}