<?php

namespace li3_analytics\extensions\adapter\tracking;

class Optimizely extends \lithium\core\Object {

	/**
	 * Optimizely Project code
	 *
	 * @var string
	 */
	protected $_project;

	/**
	 * What section of the page should the script be loaded?
	 * @var string
	 */
	protected $_section = "prepend_head";

	protected $_autoConfig = array('project', 'section');

	protected $_uri = "//cdn.optimizely.com/js/";

	/**
	 * Way to load tracker
	 * `block`, `inline`
	 * `block` loads a javascript block
	 * `inline` loads a javascript link.
	 * @var string
	 */
	protected $_type = "inline";

	/**
	 * Return the trackers section
	 * @return string
	 */
	public function section(){
		return $this->_section;
	}

	/**
	 * Optimizely project code
	 *
	 * @return string
	 */
	public function project() {
		return $this->_project;
	}

	public function type(){
		return $this->_type;
	}

	public function uri(){
		return $this->_uri;
	}

}