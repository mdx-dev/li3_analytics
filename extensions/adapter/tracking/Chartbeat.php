<?php

namespace li3_analytics\extensions\adapter\tracking;

use \li3_analytics\extensions\Trackers;
use \li3_analytics\extensions\adapter\tracking\Shell;


class Chartbeat extends \li3_analytics\extensions\adapter\Tracker {

	protected $_type = "block";

	protected $_config = array();

	protected $_section = "append_body";

	protected $_shells = array();

	protected $_uid;

	protected $_domain;

	protected $_autoConfig = array('type', 'uid', 'domain', 'config' => 'merge', 'section');

	public function __construct($config){

		parent::__construct($config);

		$this->_shells[] = new Shell(array(
			'name' => 'chartbeat-init',
			'section' => "prepend_head",
			'element' => "chartbeat-init",
			'config' => array()
		));

	}

	public function key(){
		return $this->_uid;
	}

	public function config(){
		if(!isset($this->_config['config'])) $this->_config['config'] = array();
		return $this->_config['config'] + array('uid' => $this->key(), 'domain' => $this->_domain);
	}

}