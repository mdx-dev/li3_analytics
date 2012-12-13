<?php

namespace li3_analytics\tests\cases\extensions;

use li3_analytics\extensions\Trackers;
use lithium\storage\Session;

class TrackersTest extends \lithium\test\Unit {

	function teardown() {
		Trackers::reset();
	}

	function test_setGoogleAnalytics() {
		$config = array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'test'
		);

		$expected = array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'test',
			'name' => 'test',
		);

		$this->assertEqual($expected, Trackers::add('test', $config));
	}

	function test_getGoogleAnalytics() {

		Trackers::add('test', array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'test'
		));

		$expected = array(
			array('_setAccount', 'test'),
			array('_trackPageview')
		);

		$tracking = Trackers::get('test');

		$this->assertEqual('test', $tracking->account());
		$this->assertEqual($expected, $tracking->commands());

	}

	function test_getFromSession() {

		Session::write(
			Trackers::$name,
			array(
				array('_trackPageview'),
				array('_setDomainName', 'example.org')
			),
			array('name' => 'default')
		);

		Trackers::add('test', array(
			'account' => 'test',
			'adapter' => 'GoogleAnalytics',
			'commands' => array(
				array('_setDomainName', 'example.org'),
			)
		));

		$expected = array(
			array('_setAccount', 'test'),
			array('_trackPageview'),
			array('_setDomainName', 'example.org')
		);

		$tracking = Trackers::get('test');

		$this->assertEqual($expected, $tracking->commands());

	}

	function testWeirdName() {

		Trackers::add('Foo_Bar~baz', array(
			'account' => 'test',
			'adapter' => 'GoogleAnalytics',
			'commands' => array(
				array('_setDomainName', 'example.org'),
			)
		));

		$expected = array(
			array('_setAccount', 'test'),
			array('_trackPageview'),
			array('_setDomainName', 'example.org')
		);

		$tracking = Trackers::get('Foo_Bar~baz');

		$this->assertIdentical($expected, $tracking->commands());

	}

	public function testRetrieveConfig() {
		Trackers::add('foobar', array(
			'account' => 'test',
			'adapter' => 'GoogleAnalytics',
			'commands' => array(
				array('_setDomainName', 'example.org'),
			)
		));

		$tracking = Trackers::get('foobar');

		$expected = array(
			'account' => 'test',
			'adapter' => 'GoogleAnalytics',
			'commands' => array(
				array('_setDomainName','example.org'),
			),
			'name' => 'foobar',
			'filters' => array(),
			'init' => true,
		);

		$this->assertIdentical($expected, $tracking->config());
	}

	public function testUpdateConfig() {
		Trackers::add('foobar', array(
			'account' => 'test',
			'adapter' => 'GoogleAnalytics',
			'commands' => array(
				array('_setDomainName', 'example.org'),
			)
		));

		$tracking = Trackers::get('foobar');

		$tracking->config(array(
			'commands' => array(
				array('_setDomainName','example.com'),
			),
		));

		$expected = array(
			'commands' => array(
				array('_setDomainName','example.com'),
			),
			'account' => 'test',
			'adapter' => 'GoogleAnalytics',
			'name' => 'foobar',
			'filters' => array(),
			'init' => true,
		);

		$this->assertIdentical($expected, $tracking->config());
	}
}