<?php
/*
--- Day 5: Binary Boarding ---
Ding! The "fasten seat belt" signs have turned on. Time to find your seat.

It's a completely full flight, so your seat should be the only missing boarding pass in your list. However, there's a catch: some of the seats at the very front and back of the plane don't exist on this aircraft, so they'll be missing from your list as well.

Your seat wasn't at the very front or back, though; the seats with IDs +1 and -1 from yours will be in your list.

What is the ID of your seat?

Your puzzle answer was 594.
*/

$lines = file('adventofcode.com_2020_day_5_input.txt');

$max = 0;
foreach ($lines as $line_num => $line) {
	// $line = trim( $line );
	$row = substr($line, 0, 7);
	$column = substr($line, 7, 3);
	// echo "line: ".$line." row: ".$row." column: ".$column."\n";
	$row = str_replace(array("B","F"),array("1","0"),$row);
	$column = str_replace(array("R","L"),array("1","0"),$column);

	$id = bindec($row) * 8 + bindec($column);
	$row = bindec($row);
	$column = bindec($column);
	if($max < $id) $max = $id;
	$lietadlo[] = $id; // [$row][$column]
	// echo $line.": row ".$row.", column ".$column.", seat ID ".$id.". \n";
}
asort($lietadlo);
for ($i = $max; $i > 0 ; $i--) {
	if( !in_array($i, $lietadlo)){
		echo "\nID me: ".$i;
		break;
	}
}
echo "\nID max: ".$max;
// print_r($lietadlo);
echo "\nOK - koniec";
?>