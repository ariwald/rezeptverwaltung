<?php
abstract class debug {

public static function debugAusgabeString($style, $text) {
	if(DEBUG) {
		$string = "<p class='" . $style . "'>" . $text . "</p>\n";
		echo $string;
	}
}

public static function debugAusgabeArray($style, $array) {
	if(DEBUG) {
			echo "<pre class='" . $style . "'>n";
			print_r($array);
			echo "</pre>";
		}
	}

}

?>