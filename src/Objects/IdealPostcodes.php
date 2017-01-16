<?php
namespace RapidWeb\Postcodes\Objects;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Exception;

class IdealPostCodes
{
    private $apiKey = null;
    private $client = null;

    public function __construct($apiKey)
    {
        if (!$apiKey) {
            throw new Exception('No Ideal Postcodes API key specified.');
        }

        $this->apiKey = $apiKey;

        $headers = ['Authorization' => 'IDEALPOSTCODES api_key="'.$this->apiKey.'"'];

        $this->client = new Client(['base_uri' => 'https://api.ideal-postcodes.co.uk/v1/', 'timeout'  => 3.0, 'headers' => $headers]);

    }

    public function getAddressesByPostcode($postcode)
    {
        $response = $this->client->request('GET', 'postcodes/'.$postcode);

        $result = $this->parseResponse($response);

        return $result;
    }
    
    private function parseResponse(Response $response)
    {
        if ($response->getStatusCode()!=200) {
            throw new Exception('HTTP response code was not 200. Received HTTP reponse code: '.$response->getStatusCode().' ('.$response->getReasonPhrase().')');
        }

        $object = json_decode($response->getBody());

        if (!$object) {
            throw new Exception('Response JSON could not be decoded.');
        }

        if (!isset($object->code) || !is_numeric($object->code)) {
            throw new Exception('Response code not found or invalid.');
        }

        if ($object->code!=2000) {
            throw new Exception('Response code was not 2000. Response message: '.((isset($object->message) ? $object->message : '(none)')));
        }

        if (!isset($object->result)) {
            throw new Exception('Response does not contain a result.');
        }

        return $object->result;

    }
}