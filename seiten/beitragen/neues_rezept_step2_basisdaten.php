<?php
$formular = "<form action='/".BASIS_PFAD."/beitragen/neues_rezept/' method='post'>";

$formular .= "<img src='".PFAD_KORREKTUR."/tmp/".$_SESSION["bildliste_tmp"][0]["bildliste"][0]."' 
				height='250'><br />";

$formular .= "<input type='hidden' name='step2_basisdaten' />"; # für die IF-Abfrage
$formular .= "Name<br />";
$formular .= "<input type='text' name='name' value='".@$_SESSION["step2_basisdaten"]["name"]."' /><br /><br />";
$formular .= "Beschreibung<br />";
$formular .= "<input type='text' name='beschreibung' value='".@$_SESSION["step2_basisdaten"]["beschreibung"]."' /><br /><br />";
$formular .= "Zutaten<br />";
$formular .= "<input type='text' name='zutaten' value='".@$_SESSION["step2_basisdaten"]["zutaten"]."' /><br /><br />";
$formular .= "Zubereitung<br />";
$formular .= "<input type='text' name='zubereitung' value='".@$_SESSION["step2_basisdaten"]["zubereitung"]."' /><br />";

$daten = $db->lesen("select * from rezepte");

#print_r ($_SESSION);
foreach($daten as $nr => $datensatz)
{
	$text = $datensatz["rezept_name"];
	$text = $datensatz["rezept_beschreibung"];
	$text = $datensatz["rezept_zutaten"];
	$text = $datensatz["rezept_zubereitung"];
}

$formular .= "</select><br /><br />";

$formular .= "<button name='step' value='3'>Weiter zu Step 3</button>";

$formular .= "</form>";

$this->seiteninhalt .= $formular;
?>