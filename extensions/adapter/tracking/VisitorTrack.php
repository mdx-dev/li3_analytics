<?php

namespace li3_analytics\extensions\adapter\tracking;

class VisitorTrack extends \li3_analytics\extensions\adapter\Tracker {

	/**
	 * Quantcast Analytics account
	 *
	 * @var string
	 */
	protected $_account;

	/**
	 * What section of the page should the script be loaded?
	 * @var array
	 */
	protected $_views = array(
		'append_body' => 'visitortrack'
	);

	/**
	 * Way to load tracker
	 * `block`, `inline`
	 * `block` loads a javascript block
	 * `inline` loads a javascript link.
	 * @var string
	 */
	protected $_type = "block";

	protected $_autoConfig = array('account', 'section', 'views');

	/**
	 * Tracking account used
	 *
	 * @return string tracking account
	 */
	public function account() {
		return trim($this->_account);
	}

	/**
	 * Unified method to get account details.
	 *
	 * @return string
	 */
	public function key() {
		return $this->account();
	}

	public function configuration() {
		return !empty($this->_configuration) ? $this->_configuration : false;
	}

}