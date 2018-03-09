<?php

use PHPUnit\Framework\TestCase;
use RapidWeb\Postcodes\Utils\Validator;
use RapidWeb\Postcodes\Utils\Generator;
use RapidWeb\Postcodes\Utils\Tokenizer;
use RapidWeb\Postcodes\Exceptions\InvalidPostcodeException;

final class BasicUsageTest extends TestCase
{
    public function testValidation()
    {
        $postcodes = ['ST163DP', 'TN30YA', 'ST78PP', 'CM233WE', 'E16AW', 'E106QX'];

        foreach($postcodes as $postcode) {
            $this->assertTrue(Validator::validatePostcode($postcode));
        }
    }

    public function testValidationFailure()
    {
        $postcodes = ['ST163DPA', 'XF2P90', 'Ollie', 'cake'];

        foreach($postcodes as $postcode) {
            $this->assertFalse(Validator::validatePostcode($postcode));
        }
    }

    public function testGeneration()
    {
        $postcodes = [];

        for ($i=0; $i < 100; $i++) { 
            $postcodes[] = Generator::generatePostcode();
        }

        foreach($postcodes as $postcode) {
            $this->assertTrue(Validator::validatePostcode($postcode));
        }
    }

    public function testOutwardAndInwardCodes()
    {
        $postcodeTestItems = [
            [
                'postcode' => 'ST163DP',
                'outward' => 'ST16',
                'inward' => '3DP'
            ],
            [
                'postcode' => 'TN30YA',
                'outward' => 'TN3',
                'inward' => '0YA'
            ],
            [
                'postcode' => 'ST78PP',
                'outward' => 'ST7',
                'inward' => '8PP'
            ],
            [
                'postcode' => 'CM233WE',
                'outward' => 'CM23',
                'inward' => '3WE'
            ],
            [
                'postcode' => 'E16AW',
                'outward' => 'E1',
                'inward' => '6AW'
            ],
            [
                'postcode' => 'E106QX',
                'outward' => 'E10',
                'inward' => '6QX'
            ]
        ];

        foreach($postcodeTestItems as $postcodeTestItem) {
            $this->assertEquals($postcodeTestItem['outward'], Tokenizer::outward($postcodeTestItem['postcode']));
            $this->assertEquals($postcodeTestItem['inward'], Tokenizer::inward($postcodeTestItem['postcode']));
        }
    }

    public function testOutwardCodeWithInvalidPostcode()
    {
        $this->expectException(InvalidPostcodeException::class);

        $outward = Tokenizer::outward('ST163DPA');
    }

    public function testInwardCodeWithInvalidPostcode()
    {
        $this->expectException(InvalidPostcodeException::class);

        $outward = Tokenizer::inward('ST163DPA');
    }
}
