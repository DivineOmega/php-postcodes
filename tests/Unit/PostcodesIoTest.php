<?php

use DivineOmega\Postcodes\Objects\PostcodesIo;
use PHPUnit\Framework\TestCase;

final class PostcodesIoTest extends TestCase
{
    public function validationProvider()
    {
        return [
            [
                'postcode'         => 'ST163DP',
                'expectedResponse' => [
                    'townCity'  => 'Stafford',
                    'county'    => 'Staffordshire',
                    'postcode'  => 'ST16 3DP',
                    'longitude' => -2.11556,
                    'latitude'  => 52.822944,
                ],
            ],
            [
                'postcode'         => 'TN30YA',
                'expectedResponse' => [
                    'townCity'  => 'Tunbridge Wells',
                    'county'    => 'Kent',
                    'postcode'  => 'TN3 0YA',
                    'longitude' => 0.226856,
                    'latitude'  => 51.13246,
                ],
            ],
        ];
    }

    /**
     * @dataProvider validationProvider
     */
    public function testLookup($postcode, $expectedResponse)
    {
        $postcodeLookupService = new PostcodesIo();
        $addresses = $postcodeLookupService->getAddressesByPostcode($postcode);

        $address = $addresses[0];

        foreach ($expectedResponse as $key => $value) {
            $this->assertEquals($value, $address->$key);
        }
    }
}
