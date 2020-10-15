<?php
namespace php\objekte;

use php\objekte\pdo\Datenbank; # Datenbank eintragen

/*
Aufgaben:
-	Benutzerinteraktion auswerten
-	Unterseite auswählen
*/
class Navigation
{
	# Eigenschaften
	public $links = array("Startseite" 	=> "/".BASIS_PFAD,
						  "Rezepte" 	=> "/".BASIS_PFAD."/rezepte/",
						  #"Beitragen" 	=> "/".BASIS_PFAD."/beitragen/",
						  "Impressum"	=> "/".BASIS_PFAD."/impressum/",
						  "Kontakt"		=> "/".BASIS_PFAD."/kontakt/");
	
	public $loginstatus = "";
	public $erfolgsmeldung = "";
	public $fehlermeldung = "";
	
	public $seiteninhalt = "leer";		

	# Methoden
	public function __construct() # in der index.php: $navigation = new Navigation();
	{
		$this->linkauswertung();
	}

	public function links_erstellen()
	{
		$string = "";
		foreach($this->links as $bezeichnung => $url )
		{
			$string .="<a href='$url'>$bezeichnung</a> ";
		}
		return $string;
	}

	protected function linkauswertung()
	{
		$seitenauswahl = SEITENAUSWAHL;
		if(isset($_POST["login"]))
		{			
			$db = new Datenbank();
			$daten = $db->lesen("select * from users where user_email=:daten",
						array(	"daten" => $_POST["email"]));
			#var_dump($daten);						
			
			#echo password_hash($_POST["passwort"], PASSWORD_DEFAULT );
			
			if(count($daten) > 0)
			{
				$hash = $daten[0]["user_passwort"];
			}
			else
			{
				$hash = "";
			}	

			if( password_verify($_POST["passwort"], $hash) )
			{
				$_SESSION["eingeloggt"] = true;
				echo $this->erfolgsmeldung = "Login hat funktioniert";
			}
			else
			{
				echo $this->fehlermeldung = "Login hat nicht geklappt";
			}			
		}
		
		if($seitenauswahl == "/logout")
		{
			unset($_SESSION["eingeloggt"]);
		}		
		
		if(isset($_SESSION["eingeloggt"]))
		{
			#$seitenauswahl = "";
			$this->loginstatus = "Du bist eingeloggt";
			$this->links["Beitragen"] = "/".BASIS_PFAD."/beitragen/";
			$this->links["Logout"] = "/".BASIS_PFAD."/logout/";
		}
		else
		{
			$this->loginstatus = "";
			$this->links["Login"] = "/".BASIS_PFAD."/login/";
			$this->links["Registrierung"] = "/".BASIS_PFAD."/registrierung/";
		}	
		#echo "<pre>";
		#print_r($_POST);
		#echo "</pre>";
		
		if(isset($_POST["reg_button"]))
		{
			$vorname 		= $_POST["reg_vorname"];
			$nachname 		= $_POST["reg_nachname"];
			$email			= $_POST["reg_email"];
			$stadtviertel	= $_POST["reg_stadtviertel"];
			$passwort1		= password_hash($_POST["reg_passwort1"], PASSWORD_DEFAULT);			
		
			if($_POST["reg_passwort1"] == $_POST["reg_passwort2"])
			{		
				$db = new Datenbank();
				$pk = $db->einfuegen("insert into users
										(user_vorname,user_nachname,user_email,user_stadtviertel,user_passwort)
									values 
									(:user_vorname,:user_nachname,:user_email,:user_stadtviertel,:user_passwort)",
									array
										(
											"user_vorname" 		=> $vorname,
											"user_nachname" 	=> $nachname,
											"user_email" 		=> $email,
											"user_stadtviertel" => $stadtviertel,
											"user_passwort" 	=> $passwort1,
										)
									);		
				$this->erfolgsmeldung = "Die Registrierung wurde mit der ID $pk abgeschlossen";
				$seitenauswahl = "/login";
			}
			else
			{
				$this->fehlermeldung = "Die Registrierung ist fehlgeschlagen";
			}		
		}
		
		#switch($_GET["seite"])
		switch($seitenauswahl)
		{
			case "":							$this->startseite();				break;
			case "/rezepte":					$this->rezepte();					break;
			case "/impressum":					$this->impressum();					break;		
			case "/kontakt":					$this->kontakt();					break;			
			case "/beitragen":					$this->beitragen();					break;
			case "/beitragen/neues_rezept": 	$this->neues_rezept();				break;
			case "/beitragen/rezept_loeschen": 	$this->rezept_loeschen();			break;				
			case "/login":						$this->login();						break;		
			case "/logout":	  					$this->logout();					break;
			case "/registrierung":				$this->registrierung();				break;				

			default:						$seiteninhalt = "404 - Seite nicht gefunden";
		}
		
				#	String erzeugen
				#echo new Webseite($this->links_erstellen(),$this->seiteninhalt,$this->loginstatus,$this->erfolgsmeldung,$this->fehlermeldung);

				#	Navigation Objekt

		echo new Webseite($this);
	}	

	protected function startseite()
	{
		include("seiten/startseite.php");	
	}
	protected function rezepte()
	{
		include("seiten/rezepte.php");	# $this->seiteninhalt = "<h1>Rezepte</h1>";
	}

	protected function impressum()
	{
		include("seiten/impressum.php");	
	}	
	
	protected function kontakt()
	{
		include("seiten/kontakt.php");	
	}	

	protected function beitragen()
	{
		include("seiten/beitragen.php");	
	}
	
	protected function login()
	{
		include("seiten/login.php");	
	}
	
	protected function logout()
	{
		include("seiten/logout.php");	
	}
	
	protected function registrierung()
	{
		include("seiten/registrierung.php");	
	}
	
	protected function neues_rezept()
	{
		include("seiten/beitragen/neues_rezept.php");	
	}
	
	protected function rezept_loeschen()
	{
		include("seiten/beitragen/rezept_loeschen.php");	
	}	
}
?>