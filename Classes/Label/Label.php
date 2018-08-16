<?php

require_once(__DIR__."/DefaultLabel.php");

class Label extends DefaultLabel
{
	private $title;
	private $subject;
	private $class;
	private $date;
<<<<<<< HEAD
	private $logo;
=======
	private $logo;
>>>>>>> 46676496da67c63965c20e8c925477892f50ecb0
	
	function __construct($request) {
		parent::__construct();
		$this->title 	= $request->title;
		$this->subject	= $request->subject;
		$this->class 	= $request->class;
		$this->date 	= $request->date;
<<<<<<< HEAD

		if($request->hasLogo()) {
			$this->imgPath = $request->getLogo();
		}
=======
		if($request->hasLogo()) {
			$this->imgPath = $request->getLogo();
		}
>>>>>>> 46676496da67c63965c20e8c925477892f50ecb0
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
<<<<<<< HEAD
}
=======
}
>>>>>>> 46676496da67c63965c20e8c925477892f50ecb0
