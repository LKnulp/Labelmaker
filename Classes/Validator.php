<?php

class Validator
{
	private $rules = array();
	private $errors = array();
	
	function __construct($rules) {
		$this->setDefaultRules();
		foreach ($rules as $field => $rule) {
			$this->rules[$field] = $rule;
			
		}
	}
	
	public function hasErrors() {
		return count($this->errors);
	}
	
	public function getErrors() {
		return $this->errors;
	}
	
	/**
	* Returns all characters which not matches the pattern 
	* If there is another validation-mode necessary in the future, change here.
	*/
	public function validate($request) {
		foreach ($request as $field => $value) {
			if(array_key_exists($field, $this->rules)) {
				$badChars = preg_replace($this->rules[$field]['pattern'], '', $value);
				if(strlen($badChars)) {
					$this->errors[$field] = ['original' => $value, 'badChars' => $badChars];
				}
			}
		}
	}
	
	private function setDefaultRules() {
		$this->rules['title'] = ['type'=>'regex', 'pattern'=>"/[\s\w'\/-]+/"];
		$this->rules['class'] = ['type'=>'regex', 'pattern'=>"/[\s\w'\/-]+/"];
		$this->rules['subject'] = ['type'=>'regex', 'pattern'=>"/[a-zA-Z]+/"];
		$this->rules['date'] = ['type'=>'regex', 'pattern'=>"/[\d]{2}\.[\d]{2}\.[\d]{4}/"];
	}
}