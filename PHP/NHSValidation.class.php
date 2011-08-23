<?php

/**
 * @author Peter Fisher
 * @package NHSNumberValidation
 * @copyright Peter Fisher
 * 
 * Validates a NHS number
 */
class NHSNumberValidation
{

    /**
     *
     * The check number. This is the 9th number of the NHSNumber
     * @var int 
     */
    private $checkNumber;

    /**
     * The NHSNumber 
     * @var string 
     */
    private $NHSNumber;

    /**
     * The multiplers used when validating the NHSNumber
     * @var array 
     */
    private $multipers = array(
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

    /**
     *  Is the supplied NHSNumber Valid
     * @var bool 
     */
    private $isValid = true;

    /**
     * Validates that the string is valid
     * Validates that the string is an NHS number
     * @param String $NHSNumber 
     */
    public function __construct($NHSNumber)
    {
	// Remove any spaces from the $NHSNumber
	// Set the NHSNumber
	$this->NHSNumber = trim($NHSNumber);
	// Make sure that the input is valid
	$this->validateInput();
	// Perform NHSNumber validation
	$this->validateionNHSNumber();
    }

    /**
     * Checks that $this->NHSNumber is a valid input
     * The string must follow these rules:
     * - Is numeric 
     * - Is exactly 9 characters long
     * 
     * If the string is not valid $this->isValid is set to false
     */
    protected function validateInput()
    {
	if (!preg_match("/^{0-9, 9}$/", $this->NHSNumber))
	{
	    $this->isValid = false;
	}
	$this->isValid = true;
    }

    /**
     * Get the status of the NHSNumber
     * @return Bool 
     */
    public function getIsValid()
    {
	return $this->isValid;
    }

    /**
     * Validates the NHSNumber 
     * @return bool 
     */
    protected function validateionNHSNumber()
    {
	// The current number being used
	$currentNumber = 0;
	// The current sum of the multiplers
	$currentSum = 0;
	// The current multipler being used
	$currentMultipler = 0;
	// The check number
	$this->checkNumber = substr($this->NHSNumber, 9, 1);
	// The reminder after the calculations
	$remainder = 0;
	
	// Loop over each number in the string and calculate the current sum
	for ($i = 0; $i <= 8; $i++)
	{
	    $currentNumber = substr($this->NHSNumber, $i, 1);
	    $currentMultipler = $this->multipers[$i + 1];
	    $currentSum = $currentSum + ($currentNumber * $currentMultipler);
	}
	// Calculate the remainder
	$remainder = $currentSum % 11;
	$total = 11 - $remainder;

	// Now we have out total we can validate it
	if ($total == 11)
	{
	    $total = 0;
	}
	if ($total == 10)
	{
	    $this->isValid = false;
	}
	if ($total == $this->checkNumber)
	{
	    $this->isValid = true;
	} else
	{
	    $this->isValid = false;
	}

	return $this->isValid;
    }

}


// The NHSNumbers to check
$NHSNumbers = array(
    "401023213",
    "4010232137",
);

// Loop over all NHSNumbers and check if they are valid
foreach ($NHSNumbers as $NHSNumber)
{
    print "NHS Number Used: " . $NHSNumber . "\n";
    $check = new NHSNumberValidation($NHSNumber);

    if ($check->getIsValid())
    {
	print "This is a CORRECT NHS Number \n";
    } else
    {
	print "This is NOT a NHS Number \n";
    }
}
?>
