<?php 

namespace Blockfrost;

use OpenAPI\Client\Api\CardanoAssetsApi;





class AssetsService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoAssetsApi( $this->getClient(), /*config"*/);
    }
    
    public function getAssetList():array //<AssetsInner>
    {
        return $this->call( $this->api->assetsGetAsyncWithHttpInfo() )[0]; //PAGE
    }
    
    public function getAsset(string $asset)
    {
        return $this->call( $this->api->assetsAssetGetAsyncWithHttpInfo($asset) )[0]; 
    }
    
    public function getAssetHistory(string $asset)
    {
        return $this->call( $this->api->assetsAssetHistoryGetAsyncWithHttpInfo($asset) )[0]; //PAGE
    }
    
   /* public function getAssetTransactions(string $asset) //DEPRECATED
    {
        return $this->call( $this->api->assetsAssetTxsGetAsyncWithHttpInfo($asset) )[0]; //PAGE
    }*/
    
    public function getAssetTransactions(string $asset)
    {
        return $this->call( $this->api->assetsAssetTransactionsGetAsyncWithHttpInfo($asset) )[0]; //PAGE
    }
    
    public function getAssetByAddresses(string $asset)
    {
        return $this->call( $this->api->assetsAssetAddressesGetAsyncWithHttpInfo($asset) )[0]; //PAGE
    }
    
    public function getAssetsByPolicy(string $policy_id)
    {
        return $this->call( $this->api->assetsPolicyPolicyIdGetAsyncWithHttpInfo($policy_id) )[0]; //PAGE
    }
    
    
    
}











?>