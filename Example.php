<?php
require_once 'vendor/autoload.php';
use \RapidWeb\Postcodes\Utils\Generator;
use \RapidWeb\Postcodes\Utils\Validator;
use \RapidWeb\Postcodes\Objects\IdealPostcodes;
use \RapidWeb\Postcodes\Objects\PostcodeAnywhere;

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
