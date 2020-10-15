<?php
$this->seiteninhalt = "<h1>Login</h1>";

$formular = "<form action='' method='post'>";
$formular .= "Email: <input type='text' name='email' />";
$formular .= "Passwort: <input type='password' name='passwort' />";
$formular .= "<button name='login'>Login</button>";
$formular .= "</form>";

$this->seiteninhalt .= $formular;
?>