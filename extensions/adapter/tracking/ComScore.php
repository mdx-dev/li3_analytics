<?php

namespace li3_analytics\extensions\adapter\tracking;

use \li3_analytics\extensions\Trackers;
use \li3_analytics\extensions\adapter\tracking\Shell;


class ComScore extends \li3_analytics\extensions\adapter\Tracker {

	/**
		 * comScore account
		 *
		 * @var string
		 */
		protected $_account;

		/**
		 * What section of the page should the script be loaded?
		 * @var string
		 */
		protected $_section = "append_head";

		/**
		 * Way to load tracker
		 * `block`, `inline`
		 * `block` loads a javascript block
		 * `inline` loads a javascript link.
		 * @var string
		 */
		protected $_type = "block";


		protected $_autoConfig = array('account', 'section');

		/**
		 * Tracking account used
		 *
		 * @return string tracking account
		 */
		public function account() {
			return trim($this->_account);
		}

		/**
		 * Unified method to get account details
		 * @return string
		 */
		public function key(){
			return $this->account();
		}
	}