<?php

namespace li3_analytics\extensions\adapter;

abstract class Tracker extends \lithium\core\Object {
	
    abstract protected function key();

    abstract protected function section();

    abstract protected function type();

}

?>