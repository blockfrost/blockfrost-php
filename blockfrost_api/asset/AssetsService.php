<?php 

namespace Blockfrost\Asset;


use Blockfrost\Service;
use Blockfrost\Page;

class AssetsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getAssetList(Page $page = null):array //<AssetsInner>
    {
        $resp = $this->get("/assets", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\Asset']);
    }
    
    public function getAsset(string $asset):AssetContent
    {
        $resp = $this->get("/assets/{$asset}");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetContent']);
    }
    
    public function getAssetHistory(string $asset, Page $page = null):array
    {
        $resp = $this->get("/assets/{$asset}/history", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetHistory']);
    }
    
 
    
    public function getAssetTransactions(string $asset, Page $page = null):array
    {
        $resp = $this->get("/assets/{$asset}/transactions", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetTransaction']);
    }
    
    public function getAssetByAddresses(string $asset, Page $page = null):array
    {
        $resp = $this->get("/assets/{$asset}/addresses", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetAddress']);
    }
    
    public function getAssetsByPolicy(string $policy_id, Page $page = null):array
    {
        $resp = $this->get("/assets/policy{$policy_id}", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetAddress']);
    }
    
    
    
}











?>