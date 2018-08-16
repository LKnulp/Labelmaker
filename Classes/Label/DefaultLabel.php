<?php

class defaultLabel 
{
	protected $labelsPerPage;
	protected $labelWidth;
	protected $labelHeight;
	protected $labelMarginVert; // singel Value
	protected $labelMarginHor; // singel Value
	protected $pageMarginVert; // singel Value
	protected $pageMarginHor; // singel Value
	protected $imgPath;
	protected $disclaimer;

	public function __construct() {
		$this->labelsPerPage	= 12;
		$this->labelWidth		= 105;
		$this->labelHeight		= 48;
		$this->labelMarginVert	= 0;
		$this->labelMarginHor	= 0;
		$this->imgPath			= '/var/www/html/labelmaker/img/white.png';
		$this->disclaimer		= 'Dieses Schulbuch wurde in das Inventar aufgenommen und soll mehrere Jahre verwendet werden können. Darum dürfen keine Einträge, Unterstreichungen oder Markierungen vorgenommen werden. Zum Schutz des Buches soll es in einem Umschlag eingeschlagen werden.';
	}

	public function getLabelsPerPage() {
		return $this->labelsPerPage;
	}
	public function getLabelWidth() {
		return $this->labelWidth;
	}
	public function getLabelHeight() {
		return $this->labelHeight;
	}
	public function getLabelMarginVert() {
		return $this->labelMarginVert;
	}
	public function getLabelMarginHor() {
		return $this->labelMarginHor;
	}
	public function getPageMarginVert() {
		return $this->pageMarginVert;
	}
	public function getPageMarginHor() {
		return $this->pageMarginHor;
	}
	public function getImgPath() {
		return $this->imgPath;
	}
	public function getDisclaimer() {
		return $this->disclaimer;
	}
}
