<?php

namespace li3_analytics\extensions\helper;

use li3_analytics\extensions\Trackers;
use lithium\template\View;
use lithium\g11n\Message;
use lithium\core\Environment;
use lithium\core\ConfigException;

class Analytics extends \lithium\template\Helper {

	protected $_locations = array();
	protected $_view;
	protected $_sections;

	public function _init(){
		$this->_sections = Trackers::get();
		parent::_init();
	}

	/**
	 * Build out tracking scripts for header trackers
	 * @return string
	 */
	public function head($area = null) {

		if($area == 'prepend'){

			if(!empty($this->_sections['prepend_head']) && $section = $this->_sections['prepend_head']){

				foreach($section as $tracker){
					// print_r($tracker);
					echo $this->_track($tracker);
				}

			}

		}

		if($area == 'append'){

			if(!empty($this->_sections['append_head']) && $section = $this->_sections['append_head']){

				foreach($section as $tracker){
					// print_r($tracker);
					echo $this->_track($tracker);
				}

			}

		}

		// Just return blank
		return null;

	}

	public function __call($method, $options){

		$tracker = Trackers::get($method);

		if(!empty($tracker)){

			echo $this->_track($tracker);

		}

	}

	/**
	 * Render the tracker info from the oject configuration
	 * @param  object $tracker Tracker adapter
	 * @return [type]          [description]
	 */
	protected function _track($tracking){

		// Tracking object
		$class = get_class($tracking);
		// Adapter Name
		$adapter = mb_substr($class, mb_strrpos($class, '\\')+1);
		// Element Template Name
		$template = mb_strtolower($adapter);

		$library = 'li3_analytics';

		if($tracking->type() == 'inline'){

			return $this->_context->html->script("{$tracking->uri()}{$tracking->project()}") . "\n\t";

		}

		if($tracking->type() == 'block'){

			// initialize the template object
			$view = $this->renderView();

			return $view->render('element',
				compact('tracking'),
				compact('template', 'library')
			);

		}


	}

	/**
	 * Renders view element
	 * @return object
	 */
	protected function renderView() {
		if (!isset($this->_view)) {
			$this->_view = new View(array(
				'paths' => array(
					'element' => '{:library}/views/elements/{:template}.{:type}.php',
				),
				'outputFilters' => Message::aliases(),
			));
		}
		return $this->_view;
	}

}