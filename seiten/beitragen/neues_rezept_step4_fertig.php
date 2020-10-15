<?php
$this->seiteninhalt .= "<h3>Fertig</h3>";

$rezept = $db->einfuegen("insert into rezepte (rezept_name, rezept_beschreibung, rezept_zutaten, rezept_zubereitung, rezept_bild)
				values (:name, :beschreibung, :zutaten, :zubereitung, :rezept_bild)",
				array("name"			=> $_SESSION["step2_basisdaten"]["name"],
					  "beschreibung"	=> $_SESSION["step2_basisdaten"]["beschreibung"],
					  "zutaten"			=> $_SESSION["step2_basisdaten"]["zutaten"],
					  "zubereitung" 	=> $_SESSION["step2_basisdaten"]["zubereitung"],
					  "rezept_bild" => $_SESSION["bildliste_tmp"][0]["bildliste"][0]));
					  
					  #print_r ($_SESSION);
					  
	if($_SESSION["bildliste_tmp"][0]["bildliste"][0] !== "")
	{
		$quelle = "tmp/".$_SESSION["bildliste_tmp"][0]["bildliste"][0];
		$ziel = "uploads/".$_SESSION["bildliste_tmp"][0]["bildliste"][0];
		copy($quelle, $ziel);
	}	
?>