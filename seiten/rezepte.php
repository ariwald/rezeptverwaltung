<?php
$this->seiteninhalt = "<h1>Rezepte</h1>";

$rezepte = new php\objekte\Rezepte();
$rezepte->alleRezepteLaden();

$rezeptliste = $rezepte->getRezeptliste();

#$rezept = $rezeptliste[0];
#$this->seiteninhalt .= $rezept->ausgeben();

#$this->seiteninhalt .= $rezeptliste[2]->ausgeben();
for($zeile = 0; $zeile < count($rezeptliste); $zeile++)
{
	$this->seiteninhalt .= "<div>".$rezeptliste[$zeile]->ausgeben()."</div>";
}
?>