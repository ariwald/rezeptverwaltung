<?php
namespace php\objekte;
use php\objekte\pdo\Datenbank; # benutze für Datebank den Namespace php\objekte\pdo\
class Rezepte
{
	protected $rezeptliste = array();
	
	public function alleRezepteLaden()
	{
		#$datenbank = new pdo\Datenbank();
		$datenbank = new Datenbank();
		$daten = $datenbank->lesen("select * from rezepte");

		for($zeile = 0; $zeile < count($daten); $zeile++)
		{
			$rezept = new Rezept(array("id" => $daten[$zeile]["rezept_id"],
										"name" => $daten[$zeile]["rezept_name"],
										"beschreibung" => $daten[$zeile]["rezept_beschreibung"],
										"bild" => $daten[$zeile]["rezept_bild"],
										"zutaten" => $daten[$zeile]["rezept_zutaten"],
										"zubereitung" => $daten[$zeile]["rezept_zubereitung"],
										"bewertung" => $daten[$zeile]["rezept_bewertung"],
										"kommentare" => $daten[$zeile]["rezept_kommentare"]
			));
			$this->rezeptHinzufuegen($rezept);
		}
	}

	protected function rezeptHinzufuegen($neues_rezept)
	{
		$this->rezeptliste[] = $neues_rezept;
	}	
	
	public function getRezeptliste()
	{
		return $this->rezeptliste;
	}
	public function setRezeptliste($rezeptliste)
	{
		$this->rezeptliste = $rezeptliste;
	}	
}