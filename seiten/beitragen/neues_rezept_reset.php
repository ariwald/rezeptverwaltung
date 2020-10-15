<?php
/*
echo "Reset";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/
foreach($_SESSION["bildliste_tmp"] as $nr => $bilddaten)
{
	for($bildnr = 0; $bildnr < count($bilddaten["bildliste"]); $bildnr++)
	{
		#echo "<img src='".PFAD_KORREKTUR."/tmp/".$bilddaten["bildliste"][$bildnr]."'>";
		# Alle Bilder löschen
		unlink("tmp/".$bilddaten["bildliste"][$bildnr]);
	}
}

unset($_SESSION["bildliste_tmp"]);
unset($_SESSION["step1_bilder"]);
unset($_SESSION["step2_basisdaten"]);
unset($_SESSION["step3_uebersicht"]);
$_SESSION["step"] = 1;

?>