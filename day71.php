<?php
/*
--- Day 7: Handy Haversacks ---
You land at the regional airport in time for your next flight. In fact, it looks like you'll even have time to grab some food: all flights are currently delayed due to issues in luggage processing.

Due to recent aviation regulations, many rules (your puzzle input) are being enforced about bags and their contents; bags must be color-coded and must contain specific quantities of other color-coded bags. Apparently, nobody responsible for these regulations considered how long they would take to enforce!

For example, consider the following rules:

light red bags contain 1 bright white bag, 2 muted yellow bags.
dark orange bags contain 3 bright white bags, 4 muted yellow bags.
bright white bags contain 1 shiny gold bag.
muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
dark olive bags contain 3 faded blue bags, 4 dotted black bags.
vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
faded blue bags contain no other bags.
dotted black bags contain no other bags.
These rules specify the required contents for 9 bag types. In this example, every faded blue bag is empty, every vibrant plum bag contains 11 bags (5 faded blue and 6 dotted black), and so on.

You have a shiny gold bag. If you wanted to carry it in at least one other bag, how many different bag colors would be valid for the outermost bag? (In other words: how many colors can, eventually, contain at least one shiny gold bag?)

In the above rules, the following options would be available to you:

A bright white bag, which can hold your shiny gold bag directly.
A muted yellow bag, which can hold your shiny gold bag directly, plus some other bags.
A dark orange bag, which can hold bright white and muted yellow bags, either of which could then hold your shiny gold bag.
A light red bag, which can hold bright white and muted yellow bags, either of which could then hold your shiny gold bag.
So, in this example, the number of bag colors that can eventually contain at least one shiny gold bag is 4.

How many bag colors can eventually contain at least one shiny gold bag? (The list of rules is quite long; make sure you get all of it.)
148
*/
$i = 1; $total = 0;
$lines = file('adventofcode.com_2020_day_7_input.txt');
foreach ($lines as $line_num => $line) {
	$line = trim( $line );
	$words = explode(" ", $line);
	$part = substr_count($line, ',');
	//preg_match_all('/\s+/', $line, $words);
	$data[$i] = array(
		"id" => $i,
		"bag" => $words[0].$words[1],
		"use" => 0,
		"parent_id" => 0,
	);
	$parent_id = $i;
	$i++;
	if( $words[4] == "no" ) continue;
	for($n = 0; $n <= $part; $n++){
		$data[$i] = array(
			"id" => $i,
			"bag" => $words[5 + ($n * 4)].$words[6 + ($n * 4)],
			"count" => $words[4 + ($n * 4)],
			"parent_id" => $parent_id,
		);
		$i++;
	}

	// print_r( $words );
	// echo "\n";
}
// print_r( $data );
function travers($bag_color, $data)
{
	$total = 0; $result = array();
	foreach ($data as $bag) {
		if(( $bag['bag'] == $bag_color ) && ( $bag['parent_id'] > 0) ){
			// echo "\n farba: ".$bag_color." v ".$data[ $bag['parent_id'] ][ 'bag' ];
			$result[] = $data[ $bag['parent_id'] ][ 'bag' ];
			$return_travers = travers( $data[ $bag['parent_id'] ][ 'bag' ] , $data );
			foreach ($return_travers as $value) {
				$result[] = $value;
			}
		}
		if(( $bag['bag'] == $bag_color ) && ( $bag['parent_id'] == 0) ){
			$result[] = $bag_color;
		}
	}
	return $result;
}

$total = array_unique(travers("shinygold", $data));

//echo "\nID total: ". $total;
echo "\nID total: ".( count( $total) - 1);
// print_r($total);
echo "\nOK - koniec";
?>