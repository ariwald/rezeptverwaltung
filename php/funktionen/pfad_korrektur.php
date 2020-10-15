<?php
function pfad_korrektur()
{
	#print_r($_SERVER["REQUEST_URI"]);
	
	$anfrage_url = explode("/",$_SERVER["REQUEST_URI"]);
	
	unset($anfrage_url[0]); # 1. Element entfernen
	unset($anfrage_url[count($anfrage_url)]); # letzte Element entfernen
	
	#echo "<hr />";
	
	$anfrage_url = implode("/", $anfrage_url);
	
	#print_r($anfrage_url);
	
	echo "<hr />";
	
	$script_name = explode("/",$_SERVER["SCRIPT_NAME"]);
	unset($script_name[0]);
	unset($script_name[count($script_name)]);
	$script_name = implode("/",$script_name);	
	
	#print_r($script_name);
	
	define("BASIS_PFAD", $script_name);
	
	$ergebnis_string = str_replace($script_name, "", $anfrage_url);
	define("SEITENAUSWAHL", $ergebnis_string);

	#echo "<hr />";
	#print_r(SEITENAUSWAHL);


	$ordner = explode("/", $ergebnis_string);
	unset($ordner[0]);
	$anzahl = count($ordner);

	$pfad_korrektur = "";
	for($zahl = 1; $zahl <= $anzahl; $zahl++)
	{
		$pfad_korrektur .= "../";
	}

	define("PFAD_KORREKTUR", $pfad_korrektur);

	
}