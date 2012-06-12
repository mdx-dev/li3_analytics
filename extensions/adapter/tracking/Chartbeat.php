<?php

namespace li3_analytics\extensions\adapter\tracking;
use \li3_analytics\extensions\Trackers;

class Chartbeat extends \li3_analytics\extensions\adapter\Tracker {

	protected $_type = "block";

	protected $_config = array();

	/**
	 * Tracker Location
	 * Array means there are child tracker elements
	 * Primary location should be the first.
	 * @var mixed
	 */
	protected $_section = array("append_body", "prepend_head");

	protected $_uid;

	protected $_domain;

	protected $_autoConfig = array('type', 'uid', 'domain', 'config' => 'merge', 'section');

	public function key(){
		return $this->_uid;
	}

	public function section(){
		return $this->_section[0];
	}

	public function sections(){

		unset($this->_section[0]);

		return $this->_section;
		
	}

	public function type(){
		return $this->_type;
	}

	public function config(){
		if(!isset($this->_config['config'])) $this->_config['config'] = array();
		return $this->_config['config'] + array('uid' => $this->key(), 'domain' => $this->_domain);
	}

}