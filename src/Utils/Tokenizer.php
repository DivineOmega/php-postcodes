<?php
namespace RapidWeb\Postcodes\Utils;

use RapidWeb\Postcodes\Utils\Validator;
use Exception;

abstract class Tokenizer
{
    public static function outward($postcode)
    {
     self::sanityCheck($postcode);

     $postcodeStart = trim(substr($postcode, 0, -3));

     return $postcodeStart;
    }

    public static function inward($postcode)
    {
      self::sanityCheck($postcode);

      $postcodeEnd = trim(substr($postcode, -3,3));

      return $postcodeEnd;
    }

    private function sanityCheck($postcode)
    {
        $validated = Validator::validatePostcode($postcode);

        throw new Exception("Post code provided is not valid");
    }

}