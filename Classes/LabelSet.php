<?php

require_once(__DIR__.'/Validator.php');
require_once(__DIR__.'/Page/Page.php');
require_once(__DIR__.'/Label/Label.php');
require_once(__DIR__.'/../inc/fpdf/fpdf.php');
require_once(__DIR__.'/Traits/PrinterTrait.php');
require_once(__DIR__.'/Request.php');

abstract class LabelSet extends FPDF
{
	use PrinterTrait;
	
	protected $labelCount;
	protected $containers;
	protected $containerLabels;
	protected $startCount;
	protected $currentCount;
	protected $rules;
	protected $request;
	
	protected $validator;
	protected $label;
	protected $labelPage;
	
	protected $labelsPerRow;
	protected $labelsPerPage;
	
	protected function init($request) {
		$this->request = $request;
		$this->label = new Label($this->request);
		$this->labelPage = new Page();
		$this->setLabelsPerRow();
	}
	
	protected function setValidator() {
		$this->validator = new Validator($this->rules);
	}
	
	public function validate() {
		$this->validator->validate($this->request);
	}
	
	public function hasErrors() {
		return $this->validator->hasErrors();
	}
	
	public function getErrors() {
		return $this->validator->getErrors();
	}
	
	public function getPageMarginHor() {
		return $this->labelPage->getPageMarginHor();	
	}
	
	public function getPageMarginVert() {
		return $this->labelPage->getPageMarginVert();
	}
	
	private function setLabelsPerRow() {
		$this->labelsPerRow = floor($this->GetPageWidth() / floatval($this->label->getLabelWidth()));
		$this->labelsPerPage = intval($this->labelsPerPage);
	}
	
	public function getLabelsPerRow() {
		return $this->labelsPerRow;
	}
	
	public function getStartCount() {
		return $this->startCount;
	}
	
	public function getContainers() {
		return $this->containers;
	}
}