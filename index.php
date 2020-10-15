<?php
session_start();
require_once("php/funktionen/pfad_korrektur.php");
pfad_korrektur();

require_once("php/objekte/Webseite.php");
require_once("php/objekte/Navigation.php");

#require_once("php/objekte/mysqli/Datenbank.php");
require_once("php/objekte/pdo/Datenbank.php");

require_once("php/objekte/Rezept.php"); # nur ein Rezept einzeln
require_once("php/objekte/Rezepte.php"); # eine Produktliste

# automatisch Laden
#function automatisch_laden($ordner_und_datei)
#{
#	echo "<h1>Automatisch laden:".$ordner_und_datei.".php</h1>";
#	require($ordner_und_datei.".php");
#}
#spl_autoload_register("automatisch_laden");

$navigation = new php\objekte\Navigation();
?>