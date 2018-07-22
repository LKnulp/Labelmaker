<?php

require_once('./Classes/Request.php');
require_once('./Classes/Page/Page.php');

$GLOBALS['request'] = new Request();
$page = new Page();

switch ($request->getMode())
{
	case '1':
		require_once(__DIR__.'/Classes/Modes/Classset.php');
		$LabelSet = new Classset(
							$page->getOrientation(),
							$page->getFormat(),
							$page->getUnit()
						);
		break;

	case '2':
		require_once(__DIR__.'/Classes/Modes/Container.php');
		$LabelSet = new Container(
							$page->getOrientation(),
							$page->getFormat(),
							$page->getUnit()
						);
		break;
	
	case '3':
		require_once(__DIR__.'/Classes/Modes/Replication.php');
		$LabelSet = new Replication(
							$page->getOrientation(),
							$page->getFormat(),
							$page->getUnit()
						);
		break;
}

$LabelSet->validate();
if($LabelSet->hasErrors()) {
	printErrors($LabelSet->getErrors());
}

$LabelSet->setValues();

$LabelSet->AddPage();
$LabelSet->SetFont('arial');
$LabelSet->SetFontSize(11);
$LabelSet->SetAutoPageBreak(true, $LabelSet->getPageMarginVert()-2);
$LabelSet->SetMargins($LabelSet->getPageMarginHor(), $LabelSet->getPageMarginVert());
$LabelSet->SetDrawColor(0,0,0);

$counter = 0;
foreach($LabelSet->getContainers() as $id) {
	$counter++;
	$LabelSet->getLabel($id);
	if($counter == $LabelSet->getLabelsPerRow()) {
		$LabelSet->nextLine();
		$counter = 0;
	}
}

$LabelSet->Output();

function printErrors($errors) {
	foreach($errors as $field => $error) {
		if(strlen($error['badChars']) > 1) {
			$message = 'Die Zeichen "###CHARS###" sind im Feld "###FIELD###" nicht erlaubt.<br />';
			$badChars = str_split($error['badChars']);
			$badChars = implode(', ', $badChars);
		} else {
			$message = 'Das Zeichen "###CHARS###" ist im Feld "###FIELD###" nicht erlaubt.<br />';
			$badChars = $error['badChars'];
		}
		echo str_replace(array('###CHARS###', '###FIELD###'), array($badChars, $field), $message);
	}
}
