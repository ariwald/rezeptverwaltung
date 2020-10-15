<?php
#unset($_SESSION["bildliste_tmp"]);
if(!isset($_SESSION["bildliste_tmp"]))
{
	$_SESSION["bildliste_tmp"] = array();
}

if(isset($_FILES["bilder"]))
{
	#echo "<pre>";
	#print_r($_FILES["bilder"]);
	#echo "</pre>";

	$array = array();
	$array["bildliste"] = array(); # Alle Bilder
	$array["hexwert"] = ""; # die Farbauswahl
	$array["rgb"] = array(); # Die RGB-Werte	
	
	for($bildnr = 0; $bildnr < count($_FILES["bilder"]["name"]); $bildnr++)
	{
		$neuer_name = uniqid().".jpg";
		$array["bildliste"][] = $neuer_name;
		
		# kopieren
		move_uploaded_file($_FILES["bilder"]["tmp_name"][$bildnr],"tmp/".$neuer_name);

		if($bildnr == 0) # hexwert für das erste Bild
		{
			$dateiname = "tmp/$neuer_name";
			
			$width = 10;
			$height = 10;
			
			list($width_orig, $height_orig) = getimagesize($dateiname);
			$ratio_orig = $width_orig/$height_orig;

			if ($width/$height > $ratio_orig) {
			   $width = $height*$ratio_orig;
			} else {
			   $height = $width/$ratio_orig;
			}		

			$image_p = imagecreatetruecolor($width, $height);
			$image = imagecreatefromjpeg($dateiname);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);			
			
			
			$rgb = imagecolorat($image_p, $width/2, $height/2);
			#print_r($rgb);
			#echo "<hr />";

			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			
			$array["rgb"] = array("r" => $r, "g" => $g, "b" => $b);		
			
			# umwandelung von decimal in hex
			$rhex = dechex($r);
			if(strlen($rhex) == 1)
			{
				$rhex = "0".$rhex;
			}
			$ghex = dechex($g);
			if(strlen($ghex) == 1)
			{
				$ghex = "0".$ghex;
			}
			$bhex = dechex($b);
			if(strlen($bhex) == 1)
			{
				$bhex = "0".$bhex;
			}
			#var_dump($r, $g, $b);		
			#echo "<hr />";
			

			$hexzahl = "#$rhex$ghex$bhex";			
			$array["hexwert"] = $hexzahl;
		}
	}

	$_SESSION["bildliste_tmp"][] = $array;
}

# Neue Bilder hochladen
$formular = "<form action='/".BASIS_PFAD."/beitragen/neues_rezept/' method='post' enctype='multipart/form-data'>";

$formular .= "<input type='file' name='bilder[]' multiple /><br /><br />";

$formular .= "<button name='step' value='1'>Bildhochladen</button>";

$formular .= "</form>";


# Anzeige aller Bilder
$formular .= "<form action='/".BASIS_PFAD."/beitragen/neues_rezept/' method='post'>";
$formular .= "<input type='hidden' name='step1_bilder' />"; # für die IF-Abfrage
foreach($_SESSION["bildliste_tmp"] as $hexwert => $uploads)
{
	foreach($uploads["bildliste"] as $bilddatei)
	{
		$formular .= "<img src='".PFAD_KORREKTUR."/tmp/$bilddatei' height='150' />";
	}
	#$formular .= "<br />";
	
	
}
$formular .= "<button name='step' value='2'>Weiter zu Step 2</button>";
$formular .= "</form>";

$this->seiteninhalt .= $formular;

?>