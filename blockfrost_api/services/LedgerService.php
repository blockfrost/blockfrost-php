<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoLedgerApi;
use OpenAPI\Client\Model\GenesisContent;





class LedgerService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoLedgerApi( $this->getClient(), /*config"*/);
    }
    
    public function getBlockchainGenesis():GenesisContent
    {
        return $this->call( $this->api->genesisGetAsyncWithHttpInfo() )[0]; 
    }
}




?>