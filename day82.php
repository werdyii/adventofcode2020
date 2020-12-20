<?php
/*
--- Day 8: Handheld Halting ---
After some careful analysis, you believe that exactly one instruction is corrupted.

Somewhere in the program, either a jmp is supposed to be a nop, or a nop is supposed to be a jmp. (No acc instructions were harmed in the corruption of this boot code.)

The program is supposed to terminate by attempting to execute an instruction immediately after the last instruction in the file. By changing exactly one jmp or nop, you can repair the boot code and make it terminate correctly.

For example, consider the same program from above:

nop +0
acc +1
jmp +4
acc +3
jmp -3
acc -99
acc +1
jmp -4
acc +6
If you change the first instruction from nop +0 to jmp +0, it would create a single-instruction infinite loop, never leaving that instruction. If you change almost any of the jmp instructions, the program will still eventually find another jmp instruction and loop forever.

However, if you change the second-to-last instruction (from jmp -4 to nop -4), the program terminates! The instructions are visited in this order:

nop +0  | 1
acc +1  | 2
jmp +4  | 3
acc +3  |
jmp -3  |
acc -99 |
acc +1  | 4
nop -4  | 5
acc +6  | 6
After the last instruction (acc +6), the program terminates by attempting to run the instruction below the last instruction in the file. With this change, after the program terminates, the accumulator contains the value 8 (acc +1, acc +1, acc +6).

Fix the program so that it terminates normally by changing exactly one jmp (to nop) or nop (to jmp). What is the value of the accumulator after the program terminates?
*/
//$lines = file('adventofcode.com_2020_day_8_input_vzor.txt');
$lines = file('adventofcode.com_2020_day_8_input.txt');

foreach ($lines as $line_num => $line ) {
	$line = trim( $line );
	list($type, $value) = explode(" ", $line);
	$instructions[$line_num] = array(
		'type' => $type,
		'value' => $value,
		'visible' => FALSE,
	);
}
// print_r( $instructions ); die();


function boot( $instructions, $position = 0, $flip = TRUE )
{
	# Už si na konci tak skonči
	if( count($instructions) === $position ) return;

	# Ak som tam už bol vráť zápornu hodnotu mimo rozsah inštrukcii
	if( $instructions[$position]['visible'])
		return -99999;

	# Tak tu si už bol
	$instructions[$position]['visible'] = TRUE;

	// echo "\n Position: ".$position." Instruction: ".$instructions[ $position ]['type']." value: ".$instructions[ $position ]['value']." flip ".( $flip ? "TRUE":"FALSE");

	switch ( $instructions[ $position ]['type'] ) {
		case "jmp":
			# code...
			$memory = [
				boot( $instructions, $position +  $instructions[ $position ]['value'], $flip)
			];
			if( $flip )
				array_push(
					$memory,
					boot( $instructions, $position +  1, FALSE)
				);
			// echo "\n mem: ";print_r($memory);
			return max($memory);
			break;

		case "nop":
			# code...
			$memory = [
				boot($instructions, $position +  1, $flip)
			];
			if( $flip )
				array_push(
					$memory,
					boot( $instructions, $position +  $instructions[ $position ]['value'])
				);
			// echo "\n mem: ";print_r($memory);
			return max($memory);
			break;

		case "acc":
			# code...
			$acc = boot( $instructions, $position +  1, $flip);
			// echo "\n acc ".$instructions[ $position ]['value']." + ".$acc;
			if (  $acc ==  -99999 ){
				return $instructions[ $position ]['value'];
			}else{
				return $instructions[ $position ]['value'] + $acc;
			}
			break;
	}

}
echo "\naccumulator: ". boot($instructions);
// var_dump($vector);
echo "\nOK";
?>