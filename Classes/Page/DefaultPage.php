<?php

class DefaultPage
{
	protected $format;
	protected $orientation;
	protected $unit;
	protected $pageMarginHor;
	protected $pageMarginVert;
	
	function __construct() {
		$this->format 			= 'A4';
		$this->orientation 		= 'P';
		$this->unit 			= 'mm';
		$this->pageMarginHor 	= 2;
		$this->pageMarginVert	= 4.5;
	}
	
	public function getPageMarginHor() {
		return $this->pageMarginHor;
	}
	
	public function getPageMarginVert() {
		return $this->pageMarginVert;
	}
	
	public function getFormat() {
		return $this->format;
	}
	
	public function getOrientation() {
		return $this->orientation;
	}
	
	public function getUnit() {
		return $this->unit;
	}
}