<?php

namespace li3_analytics\extensions\adapter;

abstract class Tracker extends \lithium\core\Object {
	
	protected $_name;

	protected $_views = array();

	abstract protected function key();

	public function __construct($config){

		parent::__construct($config);

		// Backwards section/element compatibility
		if(isset($config['section']) && isset($config['element'])) {
			// Section and element
			$this->_views[$config['section']] = $config['element'];
		} elseif(isset($config['section']) && count($this->_views) == 1) {
			// Section and single view
			$this->_views[$config['section']] = array_pop($this->_views);
		} elseif(isset($config['element']) && count($this->_views) == 1) {
			// Single view and element
			$keys = array_keys($this->_views);
			$this->_views[$keys[0]] = $config['element'];
		}

		// Name
		$this->name($config['adapter']);

	}

	/**
	 * Will return the config with optional $options provided
	 *
	 * @param  array  $options The optional new options to merge in
	 * @return array
	 */
	public function config(array $options = array()) {
		return $this->_config = $options += $this->_config;
	}

	public function _init(){
		parent::_init();
	}

	/**
	 * Return the tracker views
	 * @return array
	 */
	public function views() {
		return $this->_views;
	}

	/**
	 * returns type var, set by config.
	 * @return string
	 */
	public function type($type = null){;
		if($type !== null) $this->_type = $type;
		return $this->_type;
	}

	public function uri($uri = null){
		
		if($uri !== null) $this->_uri = $uri;
		return $this->_uri;

	}

	public function name($name = null){
		
		if($name !== null) $this->_name = $name;
		return $this->_name;

	}

}

?>