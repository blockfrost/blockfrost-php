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
    
    public function getStakePools(Page $page = null):array //<string>
    {
        $resp = $this->get("/pools", $page);        
        
        return $this->resp_from_json($resp, ['array', 'string'] );
    }
    
    public function getStakePoolsExtended(Page $page = null):array //<PoolsListExtendedInner>
    {
        $resp = $this->get("/pools/extended", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolExtended'] );
    }
    
    public function getRetiredStakePools(Page $page = null):array //<PoolsListRetireInner>
    {
        $resp = $this->get("/pools/retired", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\Pool'] );
    }
    
    public function getRetiringStakePools(Page $page = null):array //<PoolsListRetireInner>
    {
        $resp = $this->get("/pools/retiring", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\Pool'] );
    }
    
    public function getStakePool(string $pool_id):PoolStakePool
    {
        $resp = $this->get("/pools/{$pool_id}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Pool\PoolStakePool' );
    }
    
    public function getStakePoolHistory(string $pool_id, Page $page = null):array //<PoolHistoryInner>
    {
        $resp = $this->get("/pools/{$pool_id}/history", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolHistory' ]);
    }
    
    public function getStakePoolMetadata(string $pool_id):PoolMetadata
    {
        $resp = $this->get("/pools/{$pool_id}/metadata");
        
        return $this->resp_from_json($resp, '\Blockfrost\Pool\PoolMetadata' );
    }
    
    public function getStakePoolRelays(string $pool_id):array //<TxContentPoolCertsInnerRelaysInner>
    {
        $resp = $this->get("/pools/{$pool_id}/relays");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolRelay' ]);
    }
    
    public function getStakePoolDelegators(string $pool_id, Page $page = null):array //<PoolDelegatorsInner>
    {
        $resp = $this->get("/pools/{$pool_id}/delegators", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolDelegator' ]);
    }
    
    public function getStakePoolBlocks(string $pool_id, Page $page = null):array //<string>
    {
        $resp = $this->get("/pools/{$pool_id}/blocks", $page);
        
        return $this->resp_from_json($resp, ['array', 'string' ]);
    }
    
    public function getStakePoolUpdates(string $pool_id, Page $page = null):array //<PoolUpdatesInner>
    {
        $resp = $this->get("/pools/{$pool_id}/updates", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolUpdate' ]);
    }
  
}








?>