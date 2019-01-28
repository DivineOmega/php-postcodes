<?php

namespace DivineOmega\Postcodes\Interfaces;

interface PostcodeServiceInterface
{
    public function __construct($apiKey);

    public function getAddressesByPostcode($postcode);
}
