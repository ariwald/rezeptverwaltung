<?php
namespace php\objekte\mysqli;
/*
Aufgaben:
- Verbindung aufbauen
- Verbindung schließen
- Tabelle auswählen
- Antwort der Datenbank auswerten
- select (Antwort: Die getroffene Auswahl an Datensätze)
- insert (Antwort: Der Primärschlüssel)
- update (Antwort: Die Anzahl der geänderten Datensätze)
- delete (Antwort: Die Anzahl der gelöschten Datensätze)
*/
class Datenbank
{
	public $verbindung;
	public $host = "localhost";
	public $user = "root";
	public $passwort = "";
	public $datenbank = "onlineshop";
	
	public function __construct()
	{
		echo "<h1>Konstruktor wird gestartet (MYSQLI)</h1>";
		$this->verbindung = mysqli_connect($this->host,$this->user,$this->passwort,$this->datenbank);
		$this->sql_abfrage("SET NAMES utf8");
	}
	public function __destruct()
	{
		echo "<h1>Destruktor wird gestartet (MYSQLI)</h1>";
		mysqli_close($this->verbindung);
	}
	public function sql_abfrage($befehl, $daten = array())
	{
		#$ergebnis = mysqli_query($this->verbindung, $befehl);
		
		/*
		# Variante 1: nur mit ? Platzhalter
		// Befehl ohne Daten vorbereiten
		$prepare = $this->verbindung->prepare($befehl);
		#print_r($prepare);
		#print_r($daten);
		#echo "<hr />";
		
		// Daten in den Befehl füllen
		if(count($daten) >= 1)
		{
			#print_r($daten);
			#					s = String
			$prepare->bind_param("s", $daten[0]);
		}		
		
		# Ausführen
		$prepare->execute();
		
		// Ergebnis holen
		$ergebnis = $prepare->get_result();
		#print_r($ergebnis);
		# ENDE Variante 1
		*/
		
		# VARIANTE 2
		foreach($daten as $schluessel => $wert)
		{
			$daten[$schluessel] = mysqli_real_escape_string($this->verbindung, $wert);
			$befehl = str_replace(":".$schluessel, "'".$wert."'", $befehl);
		}
		// Senden
		$ergebnis = mysqli_query($this->verbindung, $befehl);	
		# Ende VARIANTE 2
		
		return $ergebnis;
	}
	

	public function einfuegen($befehl, $daten = array())
	{
		$antwort = $this->sql_abfrage($befehl, $daten);
		if($this->verbindung->insert_id > 0)
		{
			return $this->verbindung->insert_id; # der neue Primärschlüssel
		}
		else
		{
			echo "Fehler beim Insert:";
			echo $befehl;
		}
	}
	public function aktualisieren($befehl, $daten = array())
	{
		$antwort = $this->sql_abfrage($befehl, $daten);
		#var_dump($antwort);
		if($antwort === true)
		{
			$string = "Änderungen erfolgreich:";
			$string .= $this->verbindung->affected_rows."x Datensätze verändert";
			return $string;
		}
		else
		{
			return "Fehler:".$befehl;
		}
	}
	public function loeschen($befehl, $daten = array())
	{
		$antwort = $this->sql_abfrage($befehl, $daten);
		#var_dump($antwort);
		if($antwort === true)
		{
			$string = "Löschen erfolgreich:";
			$string .= $this->verbindung->affected_rows."x Datensätze gelöscht";
			return $string;
		}
		else
		{
			return "Fehler:".$befehl;
		}
	}

	public function lesen($befehl, $daten = array())
	{
		$antwort = $this->sql_abfrage($befehl, $daten);
		$datensaetze = array();
		while($datensatz = mysqli_fetch_assoc($antwort))
		{
			$datensaetze[] = $datensatz;
		}
		return $datensaetze;
	}	
}



####################################################################################################

#$db = new Datenbank();

#$db->einfuegen("insert into farben (farbbezeichnung) values('orange')");

#echo $db->einfuegen("insert into farben (farbbezeichnung) values(?)", array("orange"));

#echo $db->einfuegen("insert into farben (farbbezeichnung) values(:farbe)", array("farbe" => "navy101"));

#echo $db->aktualisieren("update farben set farbbezeichnung = 'Orange' where farbbezeichnung='orange13'");
#echo $db->loeschen("delete from farben where farbbezeichnung = 'orange'");
#$datensaetze = $db->lesen("select * from farben");

#echo "<pre>";
#print_r($datensaetze);
#echo "<pre>";
?>