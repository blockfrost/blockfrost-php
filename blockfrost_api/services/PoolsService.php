<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoPoolsApi;
use OpenAPI\Client\Model\Pool;
use OpenAPI\Client\Model\PoolsPoolIdMetadataGet200Response;






class PoolsService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoPoolsApi( $this->getClient(), /*config"*/);
    }
    
    public function getStakePools():array //<string>
    {
        return $this->call( $this->api->poolsGetAsyncWithHttpInfo() )[0]; //PAGE  
    }
    
    public function getStakePoolsExtended():array //<PoolsListExtendedInner>
    {
        return $this->call( $this->api->poolsExtendedGetAsyncWithHttpInfo() )[0]; //PAGE
    }
    
    public function getRetiredStakePools():array //<PoolsListRetireInner>
    {
        return $this->call( $this->api->poolsRetiredGetAsyncWithHttpInfo() )[0]; //PAGE
    }
    
    public function getRetiringStakePools():array //<PoolsListRetireInner>
    {
        return $this->call( $this->api->poolsRetiringGetAsyncWithHttpInfo() )[0]; //PAGE
    }
    
    public function getStakePool(string $pool_id):Pool
    {
        return $this->call( $this->api->poolsPoolIdGetAsyncWithHttpInfo($pool_id) )[0];
    }
    
    public function getStakePoolHistory(string $pool_id):array //<PoolHistoryInner>
    {
        return $this->call( $this->api->poolsPoolIdHistoryGetAsyncWithHttpInfo($pool_id) )[0]; //PAGE
    }
    
    public function getStakePoolMetadata(string $pool_id):PoolsPoolIdMetadataGet200Response
    {
        return $this->call( $this->api->poolsPoolIdMetadataGetAsyncWithHttpInfo($pool_id) )[0]; 
    }
    
    public function getStakePoolRelays(string $pool_id):array //<TxContentPoolCertsInnerRelaysInner>
    {
        return $this->call( $this->api->poolsPoolIdRelaysGetAsyncWithHttpInfo($pool_id) )[0];
    }
    
    public function getStakePoolDelegators(string $pool_id):array //<PoolDelegatorsInner>
    {
        return $this->call( $this->api->poolsPoolIdDelegatorsGetAsyncWithHttpInfo($pool_id) )[0]; //PAGE
    }
    
    public function getStakePoolBlocks(string $pool_id):array //<string>
    {
        return $this->call( $this->api->poolsPoolIdBlocksGetAsyncWithHttpInfo($pool_id) )[0]; //PAGE
    }
    
    public function getStakePoolUpdates(string $pool_id):array //<PoolUpdatesInner>
    {
        return $this->call( $this->api->poolsPoolIdUpdatesGetAsyncWithHttpInfo($pool_id) )[0]; //PAGE
    }
  
}








?>