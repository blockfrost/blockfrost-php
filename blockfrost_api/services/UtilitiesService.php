<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoUtilitiesApi;
use OpenAPI\Client\Model\UtilsAddressesXpub;

class UtilitiesService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoUtilitiesApi( $this->getClient(), /*config"*/);
    }
    
    public function deriveAddress(string $xpub, int $role, int $index):UtilsAddressesXpub
    {
        return $this->call( $this->api->utilsAddressesXpubXpubRoleIndexGetAsyncWithHttpInfo($xpub, $role, $index) )[0]; 
    }
    
    /*
    public function submitTransactionForEvaluation($content_type, $body)
    {
        return $this->postForJSON( $this->api->utilsTxsEvaluatePostRequest($content_type), $body);
    }
    */
 
}








?>