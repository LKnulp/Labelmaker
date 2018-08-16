<?php

trait PrinterTrait
{
	private $currentRow = 1;
	
	/*  METHODS  */
	/**
	* @brief adds page margin-top.
	* @param [in] int $xval absolute value without margin.
	* @return int.
	*/
	protected function addY($yval) {
		return $this->labelPage->getPageMarginVert() + $yval;
	}
	/**
	* @brief adds page margin-left.
	* @param [in] int $yval absolute value without margin.
	* @return int.
	*/
	protected function addX($xval) {
		return $this->labelPage->getPageMarginHor() + $xval;			
	}
	
	/**
	* @brief resets curser to left side and one line below under consideration of page margins 
	* increases the row-counter by 1.
	*/
	public function nextLine() {
		$y = $this->currentRow * $this->label->getLabelHeight();
		$this->SetXY($this->addX(0), $this->addy($y));
		$this->currentRow++;
		if($this->GetPageHeight()-$this->GetY() < floatval($this->label->getLabelHeight())) {
			$this->AddPage();
		}
	}

	/**
	* @brief callback for AddPage().
	* resets row-counter to 1.
	*/
	public function Header() {
		$this->SetXY(
			$this->labelPage->getPageMarginHor(),
			$this->labelPage->getPageMarginVert()
		);
		$this->currentRow = 1;
	}
	
	/**
	* @brief Template for a single cell.
	* @return Inserts directly to the handle.
	*/
	public function getLabel($id) {
		$x = $this->GetX();
		$y = $this->GetY();

		//headlines
		$this->SetFont('arial', 'B', 12);
		$this->SetXY($x+2,$y+2);
		$this->Write(6, 'Titel: ');
		$this->SetFont('arial', '', 11);
		$this->Write(6, utf8_decode(htmlspecialchars($this->label->getTitle())));
		
		$this->SetXY($x+2,$y+10);
		$this->SetFont('arial', 'B', 12);
		$this->Write(6, 'Klasse: ');
		$this->SetFont('arial', '', 11);
		$this->Write(6, utf8_decode(htmlspecialchars($this->label->getClass())));

		$this->SetXY($x+2,$y+18);
		$this->SetFont('arial', 'B', 12);
		$this->Write(6, 'Fach: ');
		$this->SetFont('arial', '', 11);
		$this->Write(6, utf8_decode(htmlspecialchars($this->label->getSubject())));
		
		$this->SetXY($x+2,$y+26);
		$this->SetFont('arial', 'B', 12);		
		$this->Write(6, 'Anschaffung: ');
		$this->SetFont('arial', '', 11);
		$this->Write(6, utf8_decode(htmlspecialchars($this->label->getDate())));
		
		//number
		$this->SetFont('arial', 'B', 28);
		$this->SetXY($x+2,$y+37);
		$this->Write(6, '# ');
		$this->SetFont('arial', '', 24);
		$this->Write(6, utf8_decode(htmlspecialchars($id)));
		
		//disclaimer
		$this->SetFont('arial', '', 7);
		$this->SetXY($x+$this->label->getLabelWidth()/2-4, $y+$this->label->getLabelHeight()/2-2);
		$this->MultiCell($this->label->getLabelWidth()/2,3, utf8_decode($this->label->getDisclaimer()),0,'C');
		$this->SetFont('arial');
	
		//image
		$this->SetXY($x+$this->label->getLabelWidth()/2-2, $y);
		$this->Image($this->label->getImgPath(), $this->GetX(),$this->GetY(),$this->label->getLabelWidth()/2-2,0);
		
		//check format with frame
		if($this->request->debugFrame == 'on') {
			$this->Rect($x,$y,$this->label->getLabelWidth(),$this->label->getLabelHeight());
		}
		
		$this->SetXY($x+$this->label->getLabelWidth(), $y);
	}
}
