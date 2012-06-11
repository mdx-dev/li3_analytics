<?php

namespace li3_analytics\tests\cases\extensions\adapter\tracking;

use li3_analytics\extensions\adapter\tracking\GoogleAnalytics;

class GoogleAnalyticsTest extends \lithium\test\Unit
{
	function test_default()
	{
		$ga = new GoogleAnalytics(array(
			'account' => 'abc123'
		));

		$this->assertEqual('abc123', $ga->account());
		$expected = array(
			array('_setAccount', 'abc123'),
			array('_trackPageview'),
		);
		$this->assertEqual($expected, $ga->commands());
	}

	function test_commands()
	{
		$ga = new GoogleAnalytics(array(
			'account' => 'abc123',
			'commands' => array(
				array('_hello'),
				array('a', 'b', 'c', 'd'),
			)
		));

		$expected = array(
			array('_setAccount', 'abc123'),
			array('_hello'),
			array('a', 'b', 'c', 'd'),
		);

		$this->assertEqual($expected, $ga->commands());
	}
}