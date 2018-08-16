<?php

class Request
{
	public $title;
	public $class;
	public $subject;
	public $date;
	public $debugFrame;
	
	private $mode;
	private $uploaddir;
	private $logo;
	private $hasLogo = false;
	
	/**
	* set all values to class-attributes
	* reedit mode
	*/
	function __construct() {
		foreach ($_POST as $field => $value) {
			$this->{$field} = $value;
		}
		$this->setMode();
		$this->setImageUpload();
		if($this->logo['size'] > 0) {
			$this->setFile();
		}
	}

	/**
	* delete uploaded images if the object is destroyed
	*/
	function __destruct() {
		unlink($this->uploadfile);
	}

	public function hasLogo() {
		return $this->hasLogo;
	}
	
	/**
	* GETTER
	*/
	public function getMode() {
		return $this->mode;
	}
	
	public function getLogo() {
		return $this->uploadfile;
	}

	/**
	* SETTER
	*/
	/**
	* Set upload-array
	*/
	private function setImageUpload() {
		$this->logo = $_FILES['logo'];
	}

	/**
	* set mode-number as value
	*/
	private function setMode() {
		$this->mode = substr($this->mode, -1);
	}
	
	/**
	* Grab file from upload
	*/
	private function setFile() {
		$this->uploaddir = __DIR__."/../img/temp/";
		if(!is_dir($this->uploaddir)) {
			mkdir($this->uploaddir, 0775, true);
		}
		$this->uploadfile = $this->uploaddir . basename($this->logo['name']);
		if (move_uploaded_file($this->logo['tmp_name'], $this->uploadfile)) {
			$this->hasLogo = true;
			return true;
		}

		echo "Fehler beim Hochladen des Logos!\n";
	}
}
