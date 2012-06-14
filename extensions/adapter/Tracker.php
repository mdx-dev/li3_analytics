<?php

namespace li3_analytics\extensions\adapter;

abstract class Tracker extends \lithium\core\Object {
	
	abstract protected function key();

	public function shells(){
		return isset($this->_shells) ? $this->_shells : false;
	}

	/**
	 * Return the trackers section
	 * @return string
	 */
	public function section($section = null){
		if($section !== null) $this->_section = $section;
		return $this->_section;
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

}

?>