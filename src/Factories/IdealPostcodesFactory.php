<?php
namespace RapidWeb\Postcodes\Factories;

use RapidWeb\Postcodes\Objects\IdealPostcodes;
use Exception;

abstract class IdealPostCodesFactory
{
    public static function getByAPIKey($apiKey)
    {
        return new IdealPostcodes($apiKey);
    }

    public static function getByEnvironment()
    {
        $envKey = 'IDEAL_POSTCODES_API_KEY';

        $apiKey = getenv($envKey);

        if (!$apiKey) {
            throw new Exception('Environment variable '.$envKey.' is not found or is empty.');
        }

        self::getByAPIKey($apiKey);
    }
}