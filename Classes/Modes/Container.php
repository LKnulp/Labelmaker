<?php

require_once __DIR__."/../LabelSet.php";
require_once __DIR__."/../Interfaces/LabelmakerInterface.php";

class Container extends LabelSet implements LabelmakerInterface
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
		//foreach container-group, add as many labels as given plus one for container
		$this->startCount = 1;
		$this->currentCount = $this->startCount;
		for($i=1; $i<=$this->request->containers1; $i++) {
			for($j=1; $j<=$this->request->containerLabels1+1; $j++) {
				$this->containers[] = $this->currentCount;
			}
			$this->currentCount++;
		}
	}
	
	private function setValidationRules() {
		$this->rules['containerCount'] = ['type'=>'regex', 'pattern'=>"/[1-9]+/"];
		if($this->request->containerCount >= 1) {	
			for ($i = 1; $i <= $this->request->containerCount; $i++) {	
				$this->rules['containerLabels'.$i] = ['type'=>'regex', 'pattern'=>"/[1-9]+/"];
				$this->rules['containers'.$i] = ['type'=>'regex', 'pattern'=>"/[1-9]+/"];				
			}
		}
	}
	
	private function calculateLabelcount() {
		$this->labelCount = count($this->containers);
	}
<<<<<<< HEAD
}
=======
}
>>>>>>> 46676496da67c63965c20e8c925477892f50ecb0
