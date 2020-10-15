<?php
namespace php\objekte\pdo;
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
	public $datenbank = "rezeptverwaltung";
	
	public function __construct()
	{
		$this->verbindung = new \PDO("mysql:host=".$this->host."; dbname=".$this->datenbank.";", 
									$this->user, 
									$this->passwort,
									
									array(
										\PDO::ATTR_ERRMODE 					=> \PDO::ERRMODE_WARNING,
										\PDO::ATTR_DEFAULT_FETCH_MODE 		=> \PDO::FETCH_ASSOC,
										\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY 	=> true,
										\PDO::MYSQL_ATTR_INIT_COMMAND 		=> "SET NAMES utf8"
									)
									
									);		
	}	
	public function __destruct()
	{
	}	
	
	protected function sql_abfrage($befehl, $daten = array())
	{
		#$ergebnis = $this->verbindung->query($befehl); # direkt ausführen
		$prepare = $this->verbindung->prepare($befehl); # Vorbereiten
		$execute = $prepare->execute($daten); # Ausführen
		return array($prepare,$execute);
	}	


	public function einfuegen($befehl, $daten = array())
	{
		$antwort = $this->sql_abfrage($befehl, $daten);
		if($this->verbindung->lastInsertId() > 0)
		{
			return $this->verbindung->lastInsertId(); # der neue Primärschlüssel
		}
		else
		{
			return "Fehler beim Insert:".$befehl;
		}		
		
	}	
	public function aktualisieren($befehl, $daten = array())
	{
		$antwort = $this->sql_abfrage($befehl, $daten);
		var_dump($antwort);
		if($antwort[1] === true)
		{
			$string = "Änderungen erfolgreich:";
			$string .= $antwort[0]->rowCount()."x Datensätze verändert";
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
		if($antwort[1] === true)
		{
			$string = "Löschen erfolgreich:";
			$string .= $antwort[0]->rowCount()."x Datensätze gelöscht";
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
		$datensaetze = $antwort[0]->fetchAll();
		return $datensaetze;		
	}		
}


####################################################################################################

#$db = new Datenbank();

#echo $db->loeschen("delete from rezepte where rezept_id = 2");


?>