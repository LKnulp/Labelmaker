<?php

require_once __DIR__."/../LabelSet.php";
require_once __DIR__."/../Interfaces/LabelmakerInterface.php";

class Replication extends LabelSet implements LabelmakerInterface
{
	function __construct($pageSettings) {
		parent::__construct($pageSettings);
		$this->init($GLOBALS['request']);
		$this->setValidationRules();
		$this->setValidator();		
		$this->calculateLabelcount();
	}
	
	public function setValues() {
		$this->startCount = 1;
		$this->containerLabels = $this->labelCount;
		for($i=$this->startCount; $i<=$this->containerLabels; $i++) {
			$this->containers[] = '';
		}
	}
	
	private function setValidationRules() {
		$this->rules['replications'] = ['type'=>'regex', 'pattern'=>"/[\d]+/"];
	}
	
	private function calculateLabelcount() {
		$this->labelCount = $this->request->replications;
	}
	
}
