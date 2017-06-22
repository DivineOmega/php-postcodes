<?php
require_once 'vendor/autoload.php';

use RapidWeb\Postcodes\Objects\PostcodeAnywhere;

$postcodeAnywhere = new PostcodeAnywhere('API_KEY');

$postcodeAnywhere->getAddressesByPostcode('st163jr');