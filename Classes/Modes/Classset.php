<?php

require_once __DIR__."/../LabelSet.php";
require_once __DIR__."/../Interfaces/LabelmakerInterface.php";

class Classset extends LabelSet implements LabelmakerInterface
{
	public function __construct($pageSettings) {
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
		$this->startCount = $this->request->startInt;
		$this->containerLabels = $this->labelCount;
		for($i=$this->startCount; $i<=$this->containerLabels; $i++) {
			$this->containers[] = $i;
		}
	}
	
	private function setValidationRules() {
		$this->rules['startInt'] = ['type'=>'regex', 'pattern'=>"/[\d]+/"];
		$this->rules['itemCount'] = ['type'=>'regex', 'pattern'=>"/[\d]+/"];			
	}
	
	private function calculateLabelcount() {
<<<<<<< HEAD
		$this->labelCount = $this->request->itemCount + $this->request->startInt -1;
	}
}
=======
		$this->labelCount = $this->request->itemCount + $this->request->startInt -1;
	}
}
>>>>>>> 46676496da67c63965c20e8c925477892f50ecb0
