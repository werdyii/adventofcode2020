<?php
// Get a file into an array.  In this example we'll go through HTTP to get
// the HTML source of a URL.
$lines = file('adventofcode.com_2020_day_1_input.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$data = array();
// Loop through our array, show HTML source as HTML source; and line numbers too.
foreach ($lines as $line_num => $l) {
	$line = intval($l);
	foreach ($data as $v2) {
		foreach ($data as $v) {
			if ( $line + $v2 + $v == 2020 ){
				echo "Výsledok ".$line."x".$v2."x".$v." = ", $line * $v2 * $v;
				return;
			};
		}
	}

	$data[$line_num+1] = $line;
}
//echo print_r($data);
echo "OK - koniec";


// Another example, let's get a web page into a string.  See also file_get_contents().
// $html = implode('', file('http://www.example.com/'));

// Using the optional flags parameter since PHP 5
// $trimmed = file('somefile.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>