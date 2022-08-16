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
    
    /**Derive Shelley address from an xpub
     * @param string $xpub
     * @param int $role
     * @param int $index
     * @return UtilitiesAddress
     */
    public function deriveAddress(string $xpub, int $role, int $index):UtilitiesAddress
    {
        $resp = $this->get("/utils/addresses/xpub/{$xpub}/{$role}/{$index}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Utility\UtilitiesAddress' );
    }
    
    
    /**Submit an already serialized transaction to evaluate how much execution units it requires.
     * @param StreamInterface $data
     * @return string
     */
    public function submitTransactionForEvaluation(StreamInterface $data):string
    {
        $resp = $this->post_data("/tx/submit", $data, ["Content-Type" => "application/cbor"]);
        
        return $this->resp_from_json($resp, 'string' );
    }
    
 
}








?>