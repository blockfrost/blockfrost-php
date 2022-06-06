<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoNetworkApi;
use OpenAPI\Client\Model\Network;





class NetworkService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoNetworkApi( $this->getClient(), /*config"*/);
    }
    
    public function getNetworkInformation():Network
    {
        return $this->call( $this->api->networkGetAsyncWithHttpInfo() )[0];  
    }
    
  
}




?>