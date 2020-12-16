<?php
/* --- Day 3: Toboggan Trajectory ---
With the toboggan login problems resolved, you set off toward the airport. While travel by toboggan might be easy, it's certainly not safe: there's very minimal steering and the area is covered in trees. You'll need to see which angles will take you near the fewest trees.

Due to the local geology, trees in this area only grow on exact integer coordinates in a grid. You make a map (your puzzle input) of the open squares (.) and trees (#) you can see. For example:

..##.......
#...#...#..
.#....#..#.
..#.#...#.#
.#...##..#.
..#.##.....
.#.#.#....#
.#........#
#.##...#...
#...##....#
.#..#...#.#
These aren't the only trees, though; due to something you read about once involving arboreal genetics and biome stability, the same pattern repeats to the right many times:

..##.........##.........##.........##.........##.........##.......  --->
#...#...#..#...#...#..#...#...#..#...#...#..#...#...#..#...#...#..
.#....#..#..#....#..#..#....#..#..#....#..#..#....#..#..#....#..#.
..#.#...#.#..#.#...#.#..#.#...#.#..#.#...#.#..#.#...#.#..#.#...#.#
.#...##..#..#...##..#..#...##..#..#...##..#..#...##..#..#...##..#.
..#.##.......#.##.......#.##.......#.##.......#.##.......#.##.....  --->
.#.#.#....#.#.#.#....#.#.#.#....#.#.#.#....#.#.#.#....#.#.#.#....#
.#........#.#........#.#........#.#........#.#........#.#........#
#.##...#...#.##...#...#.##...#...#.##...#...#.##...#...#.##...#...
#...##....##...##....##...##....##...##....##...##....##...##....#
.#..#...#.#.#..#...#.#.#..#...#.#.#..#...#.#.#..#...#.#.#..#...#.#  --->
You start on the open square (.) in the top-left corner and need to reach the bottom (below the bottom-most row on your map).

The toboggan can only follow a few specific slopes (you opted for a cheaper model that prefers rational numbers); start by counting all the trees you would encounter for the slope right 3, down 1:

From your starting position at the top-left, check the position that is right 3 and down 1. Then, check the position that is right 3 and down 1 from there, and so on until you go past the bottom of the map.

The locations you'd check in the above example are marked here with O where there was an open square and X where there was a tree:

..##.........##.........##.........##.........##.........##.......  --->
#..O#...#..#...#...#..#...#...#..#...#...#..#...#...#..#...#...#..
.#....X..#..#....#..#..#....#..#..#....#..#..#....#..#..#....#..#.
..#.#...#O#..#.#...#.#..#.#...#.#..#.#...#.#..#.#...#.#..#.#...#.#
.#...##..#..X...##..#..#...##..#..#...##..#..#...##..#..#...##..#.
..#.##.......#.X#.......#.##.......#.##.......#.##.......#.##.....  --->
.#.#.#....#.#.#.#.O..#.#.#.#....#.#.#.#....#.#.#.#....#.#.#.#....#
.#........#.#........X.#........#.#........#.#........#.#........#
#.##...#...#.##...#...#.X#...#...#.##...#...#.##...#...#.##...#...
#...##....##...##....##...#X....##...##....##...##....##...##....#
.#..#...#.#.#..#...#.#.#..#...X.#.#..#...#.#.#..#...#.#.#..#...#.#  --->
In this example, traversing the map using this slope would cause you to encounter 7 trees.

Starting at the top-left corner of your map and following a slope of right 3 and down 1, how many trees would you encounter?

Your puzzle answer was 278.

--- Part Two ---
Time to check the rest of the slopes - you need to minimize the probability of a sudden arboreal stop, after all.

Determine the number of trees you would encounter if, for each of the following slopes, you start at the top-left corner and traverse the map all the way to the bottom:

Right 1, down 1.
Right 3, down 1. (This is the slope you already checked.)
Right 5, down 1.
Right 7, down 1.
Right 1, down 2.
In the above example, these slopes would find 2, 7, 3, 4, and 2 tree(s) respectively; multiplied together, these produce the answer 336.

What do you get if you multiply together the number of trees encountered on each of the listed slopes?

*/
$lines = file('adventofcode.com_2020_day_3_input.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$maps = array();
$moves = [
	[ 'x' => 1 , 'y' => 1 , 'cx' => 0, 'cy' => 0, 'stromy' => 0],
	[ 'x' => 3 , 'y' => 1 , 'cx' => 0, 'cy' => 0, 'stromy' => 0],
	[ 'x' => 5 , 'y' => 1 , 'cx' => 0, 'cy' => 0, 'stromy' => 0],
	[ 'x' => 7 , 'y' => 1 , 'cx' => 0, 'cy' => 0, 'stromy' => 0],
	[ 'x' => 1 , 'y' => 2 , 'cx' => 0, 'cy' => 0, 'stromy' => 0],
];
$pocet_stromov = 1;
foreach ($lines as $line_num => $line) {
	$maps[$line_num] = str_split( trim( $line ));
	$sirka_mapy = count( $maps[$line_num] );
	// posx % maxx
	foreach ($moves as $i => $move ) {
		// echo "line_num ".$line_num."  == cy ". $move['cy'] ." -> ";
		// echo "move ".$i." -> ";
		if( $line_num == $move['cy'] ){
			// echo "PRAVDA";
			$moves[$i]['cy'] += $moves[$i]['y'];
			$moves[$i]['cx'] += $moves[$i]['x'];
			// echo "line_num ".$line_num." | cy ".$move['cy']." | cx ". $move['cx'] ." sirka_mapy ".$sirka_mapy;
			if( $maps[$line_num][ $move['cx'] % $sirka_mapy] == "#"){
				$moves[$i]['stromy']++;
			}
		}
		// echo "\n";
	}
}
// print_r($maps);
foreach ($moves as $m) {
	echo "pohyb x-> ".$m['x']." y-> ".$m['y']." stromov: ". $m['stromy'] ."\n";
	$pocet_stromov *= $m['stromy'];
}
echo "Súčin stromov: ". $pocet_stromov."\n";
echo "OK - koniec";

// Another example, let's get a web page into a string.  See also file_get_contents().
// $html = implode('', file('http://www.example.com/'));

// Using the optional flags parameter since PHP 5
// $trimmed = file('somefile.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>