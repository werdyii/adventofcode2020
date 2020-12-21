<?php
/*
--- Day 9: Encoding Error ---
--- Part Two ---
The final step in breaking the XMAS encryption relies on the invalid number you just found: you must find a contiguous set of at least two numbers in your list which sum to the invalid number from step 1.

Again consider the above example:

35
20
15
25
47
40
62
55
65
95
102
117
150
182
127
219
299
277
309
576
In this list, adding up all of the numbers from 15 through 40 produces the invalid number from step 1, 127. (Of course, the contiguous set of numbers in your actual list might be much longer.)

To find the encryption weakness, add together the smallest and largest number in this contiguous range; in this example, these are 15 and 47, producing 62.

What is the encryption weakness in your XMAS-encrypted list of numbers?

*/

$lines = file('adventofcode.com_2020_day_9_input.txt');

foreach ($lines as $line_num => $line ) {
	$line = trim( $line );
	$data[$line_num] = intval($line);
}

// print_r( $data ); die();
$part1 = 1930745883;
$line = 0;
$round = 1;
$sum = $data[$line];

while (TRUE) {
	if( $sum == $part1 ){
		$a = array_slice($data, $line, $round - $line);
		// echo "\n a= ".count($a)." line= ".$line." r=".$round;
		echo "\n ".( min($a) + max($a) );
		return ;
	}
	if( $sum < $part1 ){
		$sum += $data[$round];
		$round++;
	}
	if( $sum > $part1 ){
		$sum -= $data[$line];
		$line++;
	}
}

echo "\nOK"; //268878261
?>