<?php
/* --- Day 4: Passport Processing ---
--- Part Two ---
The line is moving more quickly now, but you overhear airport security talking about how passports with invalid data are getting through. Better add some data validation, quick!

You can continue to ignore the cid field, but each other field has strict rules about what values are valid for automatic validation:

byr (Birth Year) - four digits; at least 1920 and at most 2002.
iyr (Issue Year) - four digits; at least 2010 and at most 2020.
eyr (Expiration Year) - four digits; at least 2020 and at most 2030.
hgt (Height) - a number followed by either cm or in:
If cm, the number must be at least 150 and at most 193.
If in, the number must be at least 59 and at most 76.
hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
pid (Passport ID) - a nine-digit number, including leading zeroes.
cid (Country ID) - ignored, missing or not.
Your job is to count the passports where all required fields are both present and valid according to the above rules. Here are some example values:

byr valid:   2002
byr invalid: 2003

hgt valid:   60in
hgt valid:   190cm
hgt invalid: 190in
hgt invalid: 190

hcl valid:   #123abc
hcl invalid: #123abz
hcl invalid: 123abc

ecl valid:   brn
ecl invalid: wat

pid valid:   000000001
pid invalid: 0123456789
Here are some invalid passports:

eyr:1972 cid:100
hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926

iyr:2019
hcl:#602927 eyr:1967 hgt:170cm
ecl:grn pid:012533040 byr:1946

hcl:dab227 iyr:2012
ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277

hgt:59cm ecl:zzz
eyr:2038 hcl:74454a iyr:2023
pid:3556412378 byr:2007
Here are some valid passports:

pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980
hcl:#623a2f

eyr:2029 ecl:blu cid:129 byr:1989
iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm

hcl:#888785
hgt:164cm byr:2001 iyr:2015 cid:88
pid:545766238 ecl:hzl
eyr:2022

iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719
Count the number of valid passports - those that have all required fields and valid values. Continue to treat cid as optional. In your batch file, how many passports are valid?
*/

$lines = file('adventofcode.com_2020_day_4_input.txt');

$povinne = [
    'byr' => "/^(19[2-9][0-9]|200[0-2])$/",
	//'cid' => "(Country ID)",
    'ecl' => "/^(amb|blu|brn|gry|grn|hzl|oth)$/",
    'eyr' => "/^(202[0-9]|2030)$/",
    'hcl' => "/^#[0-9a-f]{6}$/",
    'hgt' => "/^((1[5-8][0-9]|19[0-3])cm|(59|6[0-9]|7[0-6])in)$/",
    'iyr' => "/^(201[0-9]|2020)$/",
    'pid' => "/^\d{9}$/",
];
$i = 0;
$min_pocet_povinnych_poloziek = 7;
$pass = array();
$pocet_pasov = 0;
foreach ($lines as $line_num => $line) {
	$line = trim( $line );
	// echo $line."\n";
	if( strlen($line) > 0 ){
		if( array_key_exists( $i, $pass) ){
			$pass[$i]['line'] .= " ".$line;
		}else{
			$pass[$i] = [
				'valid' => 0,
				'line' => $line,
			];
		}
	}else{
		$i++;
	}
	// echo "\n";
}

foreach ($pass as $cislo => $p) {
	$pocet_povinnych_poloziek = 0;
	echo "\n line: ".$p['line'];
	$data = explode(" ", trim( $p['line'] ));
	foreach ($data as $value) {
		list($idx, $val) = explode(":",trim( $value ));
		$pass[$cislo]['items'][$idx] = trim($val);
		//if($idx == "hgt") echo "\n".$val;
	}
	// ksort($pass[$cislo]['items']);
	if( validate( $pass[$cislo]['items'], $povinne ) ) {
		$pass[$cislo]['valid'] = 1;
		$pocet_pasov++;
	}
	// print_r($data);
}

function validate($data, $rules)
{
	// print_r($data);
	foreach ($rules as $item => $rule ) {
		if( !array_key_exists( $item, $data)) return false;
		if( !preg_match( $rule, $data[$item])) return false;
		echo "\n".$rule." -> ". $data[$item]."\n";
		preg_match( $rule, $data[$item], $zhoda);
		print_r($zhoda);
	}
	//die();
	return true;
}
print_r($pass);
echo "\nPočet validných passov ".$pocet_pasov;
echo "\nOK - koniec";

// Another example, let's get a web page into a string.  See also file_get_contents().
// $html = implode('', file('http://www.example.com/'));

// Using the optional flags parameter since PHP 5
// $trimmed = file('somefile.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>