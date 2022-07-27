<?php 

namespace Blockfrost\Block;



use Blockfrost\Service;
use Blockfrost\Page;

class BlockService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**Return the latest block available to the backends, also known as the tip of the blockchain.
     * @return BlockContent
     */
    public function getLatestBlock():BlockContent
    {
        $resp = $this->get("/blocks/latest");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    /**Return the transactions within the latest block.
     * @param Page $page
     * @return array
     */
    public function getLatestBlockTransactions(Page $page = null):array //<string>
    {
        $resp = $this->get("/blocks/latest/txs", $page);
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    /**Return the content of a requested block.
     * @param string $hash_or_number
     * @return BlockContent
     */
    public function getBlock(string $hash_or_number):BlockContent 
    {
        $resp = $this->get("/blocks/{$hash_or_number}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    /**Return the list of blocks following a specific block.
     * @param string $hash_or_number
     * @param Page $page
     * @return array
     */
    public function listNextBlocks(string $hash_or_number, Page $page = null):array  //<BlockContent>             
    {
        $resp = $this->get("/blocks/{$hash_or_number}/next", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Block\BlockContent' ]);
    }
    
    /**Return the list of blocks preceding a specific block.
     * @param string $hash_or_number
     * @param Page $page
     * @return array
     */
    public function listPreviousBlocks(string$hash_or_number, Page $page = null):array //<BlockContent>
    {
        $resp = $this->get("/blocks/{$hash_or_number}/previous", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Block\BlockContent'] );
    }
    
    /**Return the content of a requested block for a specific slot
     * @param int $slot
     * @return BlockContent
     */
    public function getSpecificBlockInSlot(int $slot):BlockContent 
    {
        $resp = $this->get("/blocks/slot/{$slot}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    /**Return the content of a requested block for a specific slot in an epoch.
     * @param int $slot
     * @param int $epoch
     * @return BlockContent
     */
    public function getSpecificBlockInSlotInEpoch(int $slot, int $epoch):BlockContent 
    {
        $resp = $this->get("/blocks/epoch/{$epoch}/slot/{$slot}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    /**Return the transactions within the
     * @param $hash_or_number
     * @param Page $page
     * @return array
     */
    public function getBlockTransactions($hash_or_number, Page $page = null):array 
    {
        $resp = $this->get("/blocks/{$hash_or_number}/txs", $page);
        
        return $this->resp_from_json($resp, ['array', 'string' ]);
    }
    
   
    /**Return list of addresses affected in the specified block with additional information, sorted by the bech32 address, ascending.
     * @param $hash_or_number
     * @param Page $page
     * @return array
     */
    public function getAddressesAffectedInBlock($hash_or_number, Page $page = null):array
    {
        $resp = $this->get("/blocks/{$hash_or_number}/addresses", $page);
        
        $t = ['array', '\Blockfrost\Block\BlockTransaction'];
        
        return $this->resp_from_json($resp, ['array', ['_kind' => 'object', '_type' => '\Blockfrost\Block\BlockAddress', 'address' => 'string', 'transactions' => $t ] ]);
    }
}


?>