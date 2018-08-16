<?php

require_once __DIR__."/../LabelSet.php";
require_once __DIR__."/../Interfaces/LabelmakerInterface.php";

class Replication extends LabelSet implements LabelmakerInterface
{
	function __construct($pageSettings) {
		parent::__construct($pageSettings);
<<<<<<< HEAD

		$this->init($GLOBALS['request']);
=======
		$this->init($GLOBALS['request']);
>>>>>>> 46676496da67c63965c20e8c925477892f50ecb0
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
<<<<<<< HEAD
}
=======
	
}
>>>>>>> 46676496da67c63965c20e8c925477892f50ecb0
