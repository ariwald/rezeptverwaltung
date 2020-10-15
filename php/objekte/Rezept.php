<?php
namespace php\objekte;
use php\objekte\pdo\Datenbank;

/*
Rezept
- Name
- Beschreibung
- Bild
- Zutaten
- Zubereitung
- Bewertung
- Kommentare
*/
class Rezept
{
	protected $id = "";
	protected $name = "";
	protected $beschreibung = "";
	protected $bild = "";
	protected $zutaten = "";
	protected $zubereitung = "";
	protected $bewertung = "";
	protected $kommentare = "";

	public function __construct($array)
	{
		$this->datenFuellen($array); # Umleitung auf eine Methode
	}
	
	public function datenFuellen($array)
	{
		# Neue lokale Variablen $eigenschaft => $wert
		foreach($array as $eigenschaft => $wert)
		{
			# immer alles klein schreiben
			$eigenschaft = strtolower($eigenschaft);
			# prüfen ob die Funktion vorhanden ist (z.B. setName() )
			if(method_exists($this, "set".ucfirst($eigenschaft))) # ucfirst = erster Buchstabe groß schreiben
			{
				#$this->$eigenschaft = $wert;
				$methode = "set".ucfirst($eigenschaft);
				$this->$methode($wert);
			}
		}		
	}	
	
	public function ladeRezepte()
	{
		$db = new Datenbank();
		$datensaetze = $db->lesen("select * from rezepte");		
		$rezepte = array();
		foreach($datensaetze as $zeile => $rezept)
		{
			$rezepte[] = $rezept;
		}
	}
	
	public function ladeRezept($id)
	{
		$db = new Datenbank();
		$datensaetze = $db->lesen("select * from rezepte ");		
		
	}

	public function getId()
	{
		return $this->id;
	}	
	public function setId($id)
	{
		$this->id = $id;
	}

	public function getName()
	{
		return $this->name;
	}	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getBeschreibung()
	{
		return $this->beschreibung;
	}	
	public function setBeschreibung($beschreibung)
	{
		$this->beschreibung = $beschreibung;
	}

	public function getBild()
	{
		return $this->bild;
	}	
	public function setBild($bild)
	{
		$this->bild = $bild;
	}
	
	public function getZutaten()
	{
		return $this->zutaten;
	}	
	public function setZutaten($zutaten)
	{
		$this->zutaten = $zutaten;
	}
	
	public function getZubereitung()
	{
		return $this->zubereitung;
	}	
	public function setZubereitung($zubereitung)
	{
		$this->zubereitung = $zubereitung;
	}
	
	public function getBewertung()
	{
		return $this->bewertung;
	}	
	public function setBewertung($bewertung)
	{
		$this->bewertung = $bewertung;
	}
	
	public function getKommentare()
	{
		return $this->kommentare;
	}	
	public function setKommentare($kommentare)
	{
		$this->kommentare = $kommentare;
	}

	
	public function __toString()
	
	{
		return "<h1>Objekt</h1> '".$this->name;
	}

	
	public function ausgeben()
	{
		#print_r ("uploads/".$this->getBild()); server - pfad/browser
		if(!file_exists("uploads/".$this->getBild()))
		{
			$bilderAnzeigen = PFAD_KORREKTUR."uploads/standard.jpg";
		}
		else
		{
			$bilderAnzeigen = PFAD_KORREKTUR."uploads/".$this->getBild();
		}
		return
			"
			<div>
				<div>".$this->getId()."</div>
				<div>".$this->getName()."</div>
				<div>".$this->getBeschreibung()."</div>
				<img src='$bilderAnzeigen' />
				<div>".$this->getZutaten()."</div>
				<div>".$this->getZubereitung()."</div>
				<div>".$this->getBewertung()."</div>
				<div>".$this->getKommentare()."</div>
				<a href='/".BASIS_PFAD."/beitragen/rezept_loeschen/?id=".$this->getId()."'>Löschen</a>
			</div>
			";
		
	}
}

####################################################################
?>