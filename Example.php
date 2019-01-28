<?php

require_once 'vendor/autoload.php';
use DivineOmega\Postcodes\Objects\IdealPostcodes;
use DivineOmega\Postcodes\Objects\PostcodeAnywhere;
use DivineOmega\Postcodes\Utils\Generator;
use DivineOmega\Postcodes\Utils\Validator;

$postcode = Generator::generatePostcode();

var_dump($postcode);

$validated = Validator::validatePostcode($postcode);

var_dump($validated);

$idealPostcodes = new IdealPostCodes('API_KEY');
$addresses = $idealPostcodes->getAddressesByPostcode('ST16 3DP');
var_dump($addresses);

$postcodeAnywhere = new PostcodeAnywhere('API_KEY');
$addresses = $postcodeAnywhere->getAddressesByPostcode('ST16 3DP');
var_dump($addresses);
