<?php
/*
--- Day 7: Handy Haversacks ---
It's getting pretty expensive to fly these days - not because of ticket prices, but because of the ridiculous number of bags you need to buy!

Consider again your shiny gold bag and the rules from the above example:

faded blue bags contain 0 other bags.
dotted black bags contain 0 other bags.
vibrant plum bags contain 11 other bags: 5 faded blue bags and 6 dotted black bags.
dark olive bags contain 7 other bags: 3 faded blue bags and 4 dotted black bags.
So, a single shiny gold bag must contain 1 dark olive bag (and the 7 bags within it) plus 2 vibrant plum bags (and the 11 bags within each of those): 1 + 1*7 + 2 + 2*11 = 32 bags!

Of course, the actual rules have a small chance of going several levels deeper than this example; be sure to count all of the bags, even if the nesting becomes topologically impractical!

Here's another example:

shiny gold bags contain 2 dark red bags.
dark red bags contain 2 dark orange bags.
dark orange bags contain 2 dark yellow bags.
dark yellow bags contain 2 dark green bags.
dark green bags contain 2 dark blue bags.
dark blue bags contain 2 dark violet bags.
dark violet bags contain no other bags.
In this example, a single shiny gold bag must contain 126 other bags.

How many individual bags are required inside your single shiny gold bag?
*/
$lines = file('adventofcode.com_2020_day_7_input.txt');

foreach ($lines as $line_num => $line) {
	$line = trim( $line );
	$words = explode(" ", $line);
	$part = substr_count($line, ',');
	//preg_match_all('/\s+/', $line, $words);
	$strom[ $words[0].$words[1] ] = array();
	if( $words[4] == "no" ) continue;
	for($n = 0; $n <= $part; $n++){
		$strom[ $words[0].$words[1] ] [
			$words[5 + ($n * 4)].$words[6 + ($n * 4)]
		] =  $words[4 + ($n * 4)];
	}
	// print_r( $words );
	// echo "\n";
}
//print_r( $strom ); die();


function travers($strom, $node)
{
	$pocet = 1;
	foreach ( $strom[$node] as $sused => $mnozstvo ) {
		echo "\n node: ".$node." sused: ".$sused." pocet: ".$mnozstvo;
		$pocet += $mnozstvo * travers( $strom, $sused);
	}
	return $pocet;
}

// $total = array_unique(travers("shinygold", $data));

// echo "\nID total: ". $total;
echo "\nID total: ". ( travers( $strom, "shinygold") - 1 );
// echo "\nID total: ".( count( $total) - 1);
// print_r($total);
echo "\nOK - koniec";
?>