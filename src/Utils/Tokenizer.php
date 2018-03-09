<?php

namespace RapidWeb\Postcodes\Utils;

use RapidWeb\Postcodes\Exceptions\InvalidPostcodeException;

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

        $postcodeEnd = trim(substr($postcode, -3, 3));

        return $postcodeEnd;
    }

    private static function sanityCheck($postcode)
    {
        $validated = Validator::validatePostcode($postcode);
        if (!$validated) {
            throw new InvalidPostcodeException('Post code provided is not valid');
        }
    }
}
