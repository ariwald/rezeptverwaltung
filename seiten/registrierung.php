<?php
$this->seiteninhalt = "<h1>Registrierung</h1>";


$formular = "<form action='' method='post'>";

$formular .= "Vorname: <input type='text' name='reg_vorname' /><br />";
$formular .= "Nachname: <input type='text' name='reg_nachname' /><br />";
$formular .= "E-Mail: <input type='text' name='reg_email' /><br />";
$formular .= "Stadtviertel: <textarea name='reg_stadtviertel'></textarea><br />";
$formular .= "Passwort 1: <input type='password' name='reg_passwort1' /><br />";
$formular .= "Passwort 2: <input type='password' name='reg_passwort2' /><br />";
$formular .= "<button name='reg_button'>Registrieren</button>";
$formular .= "</form>";

$this->seiteninhalt .= $formular;
?>