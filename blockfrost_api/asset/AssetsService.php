<?php 

namespace Blockfrost\Asset;


use Blockfrost\Service;

class AssetsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getAssetList():array //<AssetsInner>
    {
        $resp = $this->get("/assets");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\Asset']);
    }
    
    public function getAsset(string $asset):AssetContent
    {
        $resp = $this->get("/assets/{$asset}");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetContent']);
    }
    
    public function getAssetHistory(string $asset):array
    {
        $resp = $this->get("/assets/{$asset}/history");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetHistory']);
    }
    
 
    
    public function getAssetTransactions(string $asset):array
    {
        $resp = $this->get("/assets/{$asset}/transactions");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetTransaction']);
    }
    
    public function getAssetByAddresses(string $asset):array
    {
        $resp = $this->get("/assets/{$asset}/addresses");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetAddress']);
    }
    
    public function getAssetsByPolicy(string $policy_id):array
    {
        $resp = $this->get("/assets/policy{$policy_id}");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetAddress']);
    }
    
    
    
}











?>