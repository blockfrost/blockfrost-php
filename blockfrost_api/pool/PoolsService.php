<?php 

namespace Blockfrost\Pool;


use Blockfrost\Service;

class PoolsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getStakePools():array //<string>
    {
        $resp = $this->get("/pools");        
        
        return $this->resp_from_json($resp, ['array', 'string'] );
    }
    
    public function getStakePoolsExtended():array //<PoolsListExtendedInner>
    {
        $resp = $this->get("/pools/extended");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolExtended'] );
    }
    
    public function getRetiredStakePools():array //<PoolsListRetireInner>
    {
        $resp = $this->get("/pools/retired");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\Pool'] );
    }
    
    public function getRetiringStakePools():array //<PoolsListRetireInner>
    {
        $resp = $this->get("/pools/retiring");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\Pool'] );
    }
    
    public function getStakePool(string $pool_id):PoolStakePool
    {
        $resp = $this->get("/pools/{$pool_id}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Pool\PoolStakePool' );
    }
    
    public function getStakePoolHistory(string $pool_id):array //<PoolHistoryInner>
    {
        $resp = $this->get("/pools/{$pool_id}/history");
        
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
    
    public function getStakePoolDelegators(string $pool_id):array //<PoolDelegatorsInner>
    {
        $resp = $this->get("/pools/{$pool_id}/delegators");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolDelegator' ]);
    }
    
    public function getStakePoolBlocks(string $pool_id):array //<string>
    {
        $resp = $this->get("/pools/{$pool_id}/blocks");
        
        return $this->resp_from_json($resp, ['array', 'string' ]);
    }
    
    public function getStakePoolUpdates(string $pool_id):array //<PoolUpdatesInner>
    {
        $resp = $this->get("/pools/{$pool_id}/updates");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Pool\PoolUpdate' ]);
    }
  
}








?>