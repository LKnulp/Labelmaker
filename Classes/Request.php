<?php

class Request
{
	public $title;
	public $class;
	public $subject;
	public $date;
	public $debugFrame;
	
	private $mode;
	
	/**
	* set all values to class-attributes
	* reedit mode
	*/
	function __construct() {
		foreach ($_POST as $field => $value) {
			$this->{$field} = $value;
		}
		$this->setMode();
	}
	
	/**
	* GETTER
	*/
	public function getMode() {
		return $this->mode;
	}
	
	/**
	* SETTER
	*/
	/**
	* set mode-number as value
	*/
	private function setMode() {
		$this->mode = substr($this->mode, -1);
	}
}