<?php
$this->seiteninhalt .= "<h2>Alle Daten in der Übersicht:</h2>";
$formular = "";
# Basisdaten
$formular .= "<h2>Basisdaten</h2>";
$formular .= "Name: ";
$formular .= @$_SESSION["step2_basisdaten"]["name"];
$formular .= "<br />";
$formular .= "Beschreibung: ";
$formular .= @$_SESSION["step2_basisdaten"]["beschreibung"];
$formular .= "<br />";
$formular .= "Zutaten: ";
$formular .= @$_SESSION["step2_basisdaten"]["zutaten"];
$formular .= "<br />";
$formular .= "Zubereitung: ";
$formular .= @$_SESSION["step2_basisdaten"]["zubereitung"];

# Bild
$formular .= "<h3>Bild</h3>";

$tabelle = "<table border='1'>";

foreach($_SESSION["bildliste_tmp"] as $nr => $uploads)
{
	foreach($uploads["bildliste"] as $bilddatei)
	{
		$tabelle .= "<td><img src='".PFAD_KORREKTUR."/tmp/$bilddatei' height='150' /></td>";
	}
	
	$bild = $uploads["hexwert"];
	$bildname = $_SESSION["bildliste_tmp"][0]["bildliste"][0];
	#echo $bildname;

}
$tabelle .= "</table>";

$formular .= $tabelle;

$formular .= "<form action='/".BASIS_PFAD."/beitragen/neues_rezept/' method='post'>";
$formular .= "<input type='hidden' name='step4_fertig' />";
$formular .= "<button name='step' value='4'>Speichern</button>";

$formular .= "</form>";

$this->seiteninhalt .= $formular;

?>