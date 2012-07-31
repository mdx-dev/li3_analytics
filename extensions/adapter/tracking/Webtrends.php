<?php

namespace li3_analytics\extensions\adapter\tracking;

class Webtrends extends \li3_analytics\extensions\adapter\Tracker {
	/**
	 * Webtrends Data Collection Server ID
	 *
	 * @var string
	 */
	protected $_DCSID;

	/**
	 * Analytics version to use
	 * @var string
	 */
	protected $_version = '10.2.29';

	/**
	 * Domain to be tracked
	 * @var string
	 */
	protected $_domain = null;

	/**
	 * What section of the page should the script be loaded?
	 * @var string
	 */
	protected $_section = "append_body";

	/**
	 * Way to load tracker
	 * `block`, `inline`
	 * `block` loads a javascript block
	 * `inline` loads a javascript link.
	 * @var string
	 */
	protected $_type = "block";

	protected $_uri = "//statse.webtrendslive.com/";

	/**
	 * Location of the script
	 * relative to webroot
	 *
	 * @var array
	 */
	protected $_script = '/js/webtrends.js';

	protected $_autoConfig = array('DCSID', 'domain', 'version', 'section', 'uri', 'script', 'configuration', 'custom');

	/**
	 * Tracking account used
	 *
	 * @return string tracking account
	 */
	public function DCSID() {
		return $this->_DCSID;
	}

	/**
	 * Unified method to get account details
	 * @return string
	 */
	public function key(){
		return $this->DCSID();
	}

	/**
	 * Returns domain var set by config
	 * @return string
	 */
	public function domain(){
		return $this->_domain;
	}

	/**
	 * Returns full location of script
	 * @return [type] [description]
	 */
	public function script(){
		return $this->_script;
	}

	/**
	 * Webtrends Version
	 * @return [type] [description]
	 */
	public function version(){
		return $this->_version;
	}

	public function configuration(){
		return !empty($this->_configuration) ? $this->_configuration : false;
	}

	public function custom(){
		return !empty($this->_custom) ? $this->_custom : false;
	}

}