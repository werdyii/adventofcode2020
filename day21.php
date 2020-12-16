<?php
$lines = file('adventofcode.com_2020_day_2_input.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$pocet_pravda = 0;
$pocet_celkom = 0;

foreach ($lines as $line_num => $l) {
	$pocet_celkom++;
	$line = intval($l);
	list($interval, $pismeno, $heslo) = explode(" ", $l);
	$pismeno = substr(trim($pismeno),0,1);
	$heslo = str_split(trim($heslo));
	list($min, $max) = explode("-",$interval);

	$pocet_p_v_heslo = 0;

	foreach ($heslo as $p ) {
		if( $p == $pismeno ) $pocet_p_v_heslo++;
	}

	if( ($pocet_p_v_heslo >= $min ) && ($pocet_p_v_heslo <= $max)) $pocet_pravda++;

	// echo "interval od ".$min." do ". $max." pismeno ". $pismeno ." v hesle".$heslo."\n";
}
echo "Pravda: ". $pocet_pravda."\n";
echo "Celkom: ". $pocet_celkom."\n";
echo "OK - koniec";


// Another example, let's get a web page into a string.  See also file_get_contents().
// $html = implode('', file('http://www.example.com/'));

// Using the optional flags parameter since PHP 5
// $trimmed = file('somefile.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>