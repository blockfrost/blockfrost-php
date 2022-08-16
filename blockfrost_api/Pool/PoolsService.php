<?php 

namespace Blockfrost\Pool;


use Blockfrost\Service;
use Blockfrost\Page;

class PoolsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**List of registered stake pools.
     * @param Page $page
     * @return array
     */
    public function getStakePools(Page $page = null):array //<string>
    {
        $resp = $this->get("/pools", $page);        
        
        return $this->resp_from_json($resp, ['array', 'string'] );
    }
    
    /**List of registered stake pools with additional information.
     * @param Page $page
     * @return array
     */
    public function getStakePoolsExtended(Page $page = null):array //<PoolsListExtendedInner>
    {
        $resp = $this->get("/pools/extended", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolExtended'] );
    }
    
    /**List of already retired pools.
     * @param Page $page
     * @return array
     */
    public function getRetiredStakePools(Page $page = null):array //<PoolsListRetireInner>
    {
        $resp = $this->get("/pools/retired", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\Pool'] );
    }
    
    /**List of stake pools retiring in the upcoming epochs
     * @param Page $page
     * @return array
     */
    public function getRetiringStakePools(Page $page = null):array //<PoolsListRetireInner>
    {
        $resp = $this->get("/pools/retiring", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\Pool'] );
    }
    
    /**Pool information.
     * @param string $pool_id
     * @return PoolStakePool
     */
    public function getStakePool(string $pool_id):PoolStakePool
    {
        $resp = $this->get("/pools/{$pool_id}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Pool\PoolStakePool' );
    }
    
    /**History of stake pool parameters over epochs.
     * @param string $pool_id
     * @param Page $page
     * @return array
     */
    public function getStakePoolHistory(string $pool_id, Page $page = null):array //<PoolHistoryInner>
    {
        $resp = $this->get("/pools/{$pool_id}/history", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolHistory' ]);
    }
    
    /**Stake pool registration metadata.
     * @param string $pool_id
     * @return PoolMetadata
     */
    public function getStakePoolMetadata(string $pool_id):PoolMetadata
    {
        $resp = $this->get("/pools/{$pool_id}/metadata");
        
        return $this->resp_from_json($resp, '\Blockfrost\Pool\PoolMetadata' );
    }
    
    /**Relays of a stake pool.
     * @param string $pool_id
     * @return array
     */
    public function getStakePoolRelays(string $pool_id):array //<TxContentPoolCertsInnerRelaysInner>
    {
        $resp = $this->get("/pools/{$pool_id}/relays");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolRelay' ]);
    }
    
    /**List of current stake pools delegators.
     * @param string $pool_id
     * @param Page $page
     * @return array
     */
    public function getStakePoolDelegators(string $pool_id, Page $page = null):array //<PoolDelegatorsInner>
    {
        $resp = $this->get("/pools/{$pool_id}/delegators", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolDelegator' ]);
    }
    
    /**List of stake pools blocks.
     * @param string $pool_id
     * @param Page $page
     * @return array
     */
    public function getStakePoolBlocks(string $pool_id, Page $page = null):array //<string>
    {
        $resp = $this->get("/pools/{$pool_id}/blocks", $page);
        
        return $this->resp_from_json($resp, ['array', 'string' ]);
    }
    
    /**List of certificate updates to the stake pool.
     * @param string $pool_id
     * @param Page $page
     * @return array
     */
    public function getStakePoolUpdates(string $pool_id, Page $page = null):array //<PoolUpdatesInner>
    {
        $resp = $this->get("/pools/{$pool_id}/updates", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolUpdate' ]);
    }
  
}








?>