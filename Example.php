<?php
require_once 'vendor/autoload.php';
use \RapidWeb\Postcodes\Utils\Validator;
use \RapidWeb\Postcodes\Factories\IdealPostcodesFactory;

$postcode = 'ST163DP';

$validated = Validator::validatePostcode($postcode);

if ($validated) {

    // You should specify IDEAL_POSTCODES_API_KEY in your .env file,
    // or pass it via the getByAPIKey method.

    $idealPostcodes = IdealPostcodesFactory::getByEnvironment();

    $addresses = $idealPostcodes->getAddressesByPostcode('ST163DP');

    var_dump($addresses);

}