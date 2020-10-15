<?php
use php\objekte\pdo\Datenbank;
use php\objekte\Rezept;
$this->seiteninhalt = "<h1>Rezept löschen</h1>";
$db = new Datenbank();

if(isset($_POST["loeschbestaetigung"]))
{
	if($_POST["loeschbestaetigung"] == "ja")
	{
		$db->loeschen("delete from rezepte where rezept_id = :platzhalter_rezept_id",
								array
								(
									"platzhalter_rezept_id" => $_POST["id"]
								)
			);
		
			
		$_SESSION["flash_notice"] = "Das Rezept wurde gelöscht";												
	}
	# gehe zur Übersichtseite zurück
	header("Location: /".BASIS_PFAD."/rezepte/");	
}
	
#$this->seiteninhalt .= "<img src='".PFAD_KORREKTUR."uploads/".$rezept->getBild()."' height='250'>";

#$this->seiteninhalt .= "<h2>Basisdaten</h2>";

$this->seiteninhalt .= "<h3>Willst du dieses Rezept wirklich löschen?</h3>";
$formular = "<form method='post'>";
$formular .= "<button name='loeschbestaetigung' value='ja'>JA</button>";
$formular .= "<button name='loeschbestaetigung' value='nein'>NEIN</button>";
$formular .= "<input type='hidden' name='id' value='".$_GET["id"]."'>";
$formular .= "</form>";

$this->seiteninhalt .= $formular;
?>