<?php
require_once 'vendor/autoload.php';
use \RapidWeb\Postcodes\Utils\Generator;
use \RapidWeb\Postcodes\Utils\Validator;
use \RapidWeb\Postcodes\Objects\IdealPostCodes;

$postcode = Generator::generatePostcode();

var_dump($postcode);

$validated = Validator::validatePostcode($postcode);

if ($validated) {

    $addresses = new IdealPostCodes('API_KEY');

    var_dump($addresses);

}