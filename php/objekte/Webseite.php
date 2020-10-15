<?php
namespace php\objekte;
/*
Aufgaben:
-	HTML-Code zur Verfügung stellen
*/
class Webseite
{
	# Eigenschaften
	public $navigationslinks = "Links";
	public $loginstatus = "Unbekannt, noch nicht definierter Inhalt";
	public $seiteninhalt = "Unbekannt, noch nicht definierter Inhalt";
	public $erfolgsmeldung = "Unbekannt, noch nicht definierter Inhalt";
	public $fehlermeldung = "Unbekannt, noch nicht definierter Inhalt";
	
	# Methoden
	public function __construct($navigationsobjekt)
	{
		#print_r($navigationsobjekt); die();
		$this->navigationslinks = $navigationsobjekt->links_erstellen();
		$this->loginstatus = $navigationsobjekt->loginstatus;
		$this->erfolgsmeldung = $navigationsobjekt->erfolgsmeldung;
		$this->fehlermeldung = $navigationsobjekt->fehlermeldung;
		$this->seiteninhalt = $navigationsobjekt->seiteninhalt;
		#$this->navigationslinks = $links;
		#$this->seiteninhalt = $seiteninhalt;
		#$this->loginstatus = $loginstatus;
		#$this->erfolgsmeldung = $erfolgsmeldung;
		#$this->fehlermeldung = $fehlermeldung;
	}	
	public function grundgeruest()
	{
		$string = '<html>
<head>
	<title>zuckerFREIburg</title>
	<link href="'.PFAD_KORREKTUR.'css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div>
'.$this->navigationslinks.'
</div>

<div>
'.$this->seiteninhalt.'
</div>

<div>
'.$this->loginstatus.'
</div>

<div>
'.$this->erfolgsmeldung.'
</div>

<div>
'.$this->fehlermeldung.'
</div>

<body>
</html>		
';
	return $string;
	}
	
	public function __toString()
	{
		return $this->grundgeruest();
	}
}
?>