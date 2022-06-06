<?php 

namespace Blockfrost\Utility;

use Blockfrost\Service;
use Psr\Http\Message\StreamInterface;

class UtilitiesService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function deriveAddress(string $xpub, int $role, int $index):UtilitiesAddress
    {
        $resp = $this->get("/utils/addresses/xpub/{$xpub}/{$role}/{$index}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Utility\UtilitiesAddress' );
    }
    
    
    public function submitTransactionForEvaluation(StreamInterface $data):string
    {
        $resp = $this->post_data("/tx/submit", $data, ["Content-Type" => "application/cbor"]);
        
        return $this->resp_from_json($resp, 'string' );
    }
    
 
}








?>