<?php
/*
--- Day 6: Custom Customs ---
--- Part Two ---
As you finish the last group's customs declaration, you notice that you misread one word in the instructions:

You don't need to identify the questions to which anyone answered "yes"; you need to identify the questions to which everyone answered "yes"!

Using the same example as above:

abc

a
b
c

ab
ac

a
a
a
a

b
This list represents answers from five groups:

In the first group, everyone (all 1 person) answered "yes" to 3 questions: a, b, and c.
In the second group, there is no question to which everyone answered "yes".
In the third group, everyone answered yes to only 1 question, a. Since some people did not answer "yes" to b or c, they don't count.
In the fourth group, everyone answered yes to only 1 question, a.
In the fifth group, everyone (all 1 person) answered "yes" to 1 question, b.
In this example, the sum of these counts is 3 + 0 + 1 + 1 + 1 = 6.

For each group, count the number of questions to which everyone answered "yes". What is the sum of those counts?
*/

$lines = file('adventofcode.com_2020_day_6_input.txt');
$i = 1;
$total = 0;
$group = array();
$line_goup = 0;

foreach ($lines as $line_num => $line) {
	$line = trim( $line );
	// echo $line."\n";
	if( strlen($line) > 0 ){
		if( array_key_exists( $i, $group) ){
			$group[$i]['line'] = array_intersect( $group[$i]['line'] , str_split($line) );
		}else{
			$group[$i]['line'] = str_split($line);
		}
		$group[$i]['answer'] = count($group[$i]['line']);
	}else{
		$total += $group[$i]['answer'];
		$i++;
	}
	// echo "\n";
}
$group[$i]['line'] = array_intersect($group[$i]['line'], str_split($line));
$group[$i]['answer'] = count($group[$i]['line']);
$total += $group[$i]['answer'];

// print_r( $group );
echo "\nID total: ". $total;
echo "\nOK - koniec";
?>