<?php
/**
 * Author Peter Fisher
 * Email: work@peterfisher.me.uk
 * 
 * Basic example of how a NHS Number is validated.
 * For more info on NHS numbers visit:
 *  http://www.datadictionary.nhs.uk/data_dictionary/attributes/n/nhs_number_de.asp
 */
$NHSNumbers = array(
    "401023213",
    "4010232137",
);


foreach ($NHSNumbers as $NHSNumber)
{
    print "NHS Number Used: " . $NHSNumber . "\n";
    if (ValidateNHSNumber($NHSNumber))
    {
	print "This is a CORRECT NHS Number \n";
    } else
    {
	print "This is NOT a NHS Number \n";
    }
}

function ValidateNHSNumber($number)
{
    $multipers = array
	(
	1 => 10,
	2 => 9,
	3 => 8,
	4 => 7,
	5 => 6,
	6 => 5,
	7 => 4,
	8 => 3,
	9 => 2
    );
    $currentNumber = 0;
    $currentSum = 0;
    $currentMultipler = 0;
    $checkNumber = substr($number, 9, 1);
    $checkDigit = null;
    $remainder = 0;

    for ($i = 0; $i <= 8; $i++)
    {
	$currentNumber = substr($number, $i, 1);
	$currentMultipler = $multipers[$i + 1];
	$currentSum = $currentSum + ($currentNumber * $currentMultipler);
    }

    $remainder = $currentSum % 11;
    $total = 11 - $remainder;

    if ($total == 11)
    {
	$total = 0;
    }
    if ($total == 10)
    {
	return false;
    }
    if ($total == $checkNumber)
    {
	return true;
    } else
    {
	return false;
    }
}

?>