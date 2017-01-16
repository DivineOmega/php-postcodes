<?php
namespace RapidWeb\Postcodes\Utils;

abstract class Validator
{
    public static function validatePostcode($postcode)
    {
        $postcode = strtoupper($postcode);

        $regex = '#^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$#';

        $result = preg_match($regex, $postcode);

        return $result ? true : false;
    }
}