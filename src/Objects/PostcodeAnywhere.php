<?php
namespace RapidWeb\Postcodes\Objects;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use RapidWeb\Postcodes\Interfaces\PostcodeServiceInterface;
use Exception;
use SoapClient;

class PostcodeAnywhere implements PostcodeServiceInterface
{
    private $apiKey = null;
    private $findSOAPClient = null;

    public function __construct($apiKey)
    {
        if (!$apiKey) {
            throw new Exception('No Postcode Anywhere API key specified.');
        }

        $this->apiKey = $apiKey;

        $this->findSOAPClient = new SoapClient('https://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/Find/v1.10/wsdlnew.ws');

    }

    public function getAddressesByPostcode($postcode)
    {
        $findResponse = $this->findSOAPClient->PostcodeAnywhere_Interactive_Find_v1_10(
                [
                    'Key' => $this->apiKey, 
                    'SearchTerm' => $postcode
                ]
            );

        $findResponseAddresses = $findResponse->PostcodeAnywhere_Interactive_Find_v1_10_Result->PostcodeAnywhere_Interactive_Find_v1_10_Results;

        return $result;
    }
    
}