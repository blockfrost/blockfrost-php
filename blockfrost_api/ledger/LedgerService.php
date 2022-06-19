<?php 

namespace Blockfrost\Ledger;


use Blockfrost\Service;

class LedgerService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getBlockchainGenesis():LedgerGenesis
    {
        $resp = $this->get("/genesis");
        
        return $this->resp_from_json($resp, '\Blockfrost\Ledger\LedgerGenesis');
    }
}




?>