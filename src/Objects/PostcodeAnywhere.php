<?php
namespace RapidWeb\Postcodes\Objects;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use RapidWeb\Postcodes\Interfaces\PostcodeServiceInterface;
use RapidWeb\Postcodes\Objects\Address;
use Exception;
use SoapClient;

class PostcodeAnywhere implements PostcodeServiceInterface
{
    private $apiKey = null;
    private $findSOAPClient = null;
    private $retrieveByIDSOAPClient = null;

    public function __construct($apiKey)
    {
        if (!$apiKey) {
            throw new Exception('No Postcode Anywhere API key specified.');
        }

        $this->apiKey = $apiKey;

        $this->findSOAPClient = new SoapClient('https://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/Find/v1.10/wsdlnew.ws');
        $this->retrieveByIDSOAPClient = new \SoapClient('https://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/RetrieveById/v1.30/wsdlnew.ws');

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

        $addresses = [];

        foreach($findResponseAddresses as $findResponseAddress) {

            $retrieveByIDResponse = $this->retrieveByIDSOAPClient->PostcodeAnywhere_Interactive_RetrieveById_v1_30(
                [
                    'Key' => $this->apiKey, 
                    'Id' => $findResponseAddress->Id
                ]
            );
            
            $retrieveAddress = $retrieveByIDResponse->PostcodeAnywhere_Interactive_RetrieveById_v1_30_Result->PostcodeAnywhere_Interactive_RetrieveById_v1_30_Results;

            $address = new Address;
            $address->companyName = $retrieveAddress->Company;
            $address->line1 = $retrieveAddress->Line1;
            $address->line2 = $retrieveAddress->Line2;
            $address->line3 = $retrieveAddress->Line3;
            $address->townCity = $retrieveAddress->PostTown;
            $address->county = $retrieveAddress->County;
            $address->postcode = $retrieveAddress->Postcode;
            $address->country = $retrieveAddress->CountryName;
            $addresses[] = $address;
        }

        return $addresses;
    }
    
}