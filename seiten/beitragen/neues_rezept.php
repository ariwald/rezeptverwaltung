<?php
use php\objekte\pdo\Datenbank;
$this->seiteninhalt = "<h1>Neues Rezept</h1>";
$db = new Datenbank();


if(isset($_GET["step"]) && $_GET["step"] == 0)
{
	include("neues_rezept_reset.php");
	header("Location: /".BASIS_PFAD."/beitragen/neues_rezept/");
	exit();
}

if(!isset($_SESSION["step"]))
{
	$_SESSION["step"] = 1;
}

# Formulare-Stepauswahl
if(isset($_POST["step"]))
{		
	$_SESSION["step"] = $_POST["step"];	
}

# URL-Stepauswahl
if(isset($_GET["step"]))
{
	$_SESSION["step"] = $_GET["step"];
}

# bilder
if(isset($_POST["step1_bilder"]))
{
	$_SESSION["step1_bilder"] = $_POST;
}
# basisdaten
if(isset($_POST["step2_basisdaten"]))
{
	$_SESSION["step2_basisdaten"] = $_POST;
}
# uebersicht
if(isset($_POST["step3_uebersicht"]))
{
	$_SESSION["step3_uebersicht"] = $_POST;
}

$this->seiteninhalt .= "<a href='?step=0'>Neues Rezept</a>";
$this->seiteninhalt .= " -> <a href='?step=1'>Bilder</a>";
if(isset($_SESSION["step1_bilder"]))
{
	$this->seiteninhalt .= "-><a href='?step=2'>Basisdaten</a>";
}
if(isset($_SESSION["step2_basisdaten"]))
{
	$this->seiteninhalt .= "-><a href='?step=3'>Übersicht</a>";
}
if(isset($_SESSION["step3_uebersicht"]))
{
	$this->seiteninhalt .= "->Fertig";
}

switch($_SESSION["step"])
{
	case 2:
		# Einzelschritte 2
		include("neues_rezept_step2_basisdaten.php");		
	break;
	case 3:
		# Einzelschritte 3
		include("neues_rezept_step3_uebersicht.php");
	break;
	case 4:
		# Einzelschritte 4
		include("neues_rezept_step4_fertig.php");
	break;
	case 1:
	default:
		# Einzelschritte 1
		include("neues_rezept_step1_bilder.php");
}

?>