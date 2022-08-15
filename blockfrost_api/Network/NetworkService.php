<?php 

namespace Blockfrost\Network;

use Blockfrost\Service;

class NetworkService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**Return detailed network information.
     * @return NetworkInformation
     */
    public function getNetworkInformation():NetworkInformation
    {
        $resp = $this->get("/network");
        
        $a = '\Blockfrost\Network\NetworkInformationSupply';
        $b = '\Blockfrost\Network\NetworkInformationStake';
        
        return $this->resp_from_json($resp, ['_kind' => 'object', '_type' => '\Blockfrost\Network\NetworkInformation', 'supply' => $a, 'stake' => $b ] );
    }
    
  
}




?>