<?php

require_once(__DIR__."/DefaultLabel.php");

class Label extends DefaultLabel
{
	private $title;
	private $subject;
	private $class;
	private $date;
	private $logo;
	
	function __construct($request) {
		parent::__construct();
		$this->title 	= $request->title;
		$this->subject	= $request->subject;
		$this->class 	= $request->class;
		$this->date 	= $request->date;
		if($request->hasLogo()) {
			$this->imgPath = $request->getLogo();
		}
	}
	
	function getTitle() {
		return $this->title;
	}
	
	function getSubject() {
		return $this->subject;
	}
	
	function getClass() {
		return $this->class;
	}
	
	function getDate() {
		return $this->date;
	}
}
