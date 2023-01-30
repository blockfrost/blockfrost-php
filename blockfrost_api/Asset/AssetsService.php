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
    
    /**List of assets.
     * @param Page $page
     * @return array
     */
    public function getAssetList(Page $page = null):array //<AssetsInner>
    {
        $resp = $this->get("/assets", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\Asset']);
    }
    
    /**Information about a specific asset
     * @param string $asset
     * @return AssetContent
     */
    public function getAsset(string $asset):AssetContent
    {
        $resp = $this->get("/assets/{$asset}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Asset\AssetContent');
    }
    
    /**History of a specific asset
     * @param string $asset
     * @param Page $page
     * @return array
     */
    public function getAssetHistory(string $asset, Page $page = null):array
    {
        $resp = $this->get("/assets/{$asset}/history", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetHistory']);
    }
    
 
    
    /**List of a specific asset transactions
     * @param string $asset
     * @param Page $page
     * @return array
     */
    public function getAssetTransactions(string $asset, Page $page = null):array
    {
        $resp = $this->get("/assets/{$asset}/transactions", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetTransaction']);
    }
    
    /**List of a addresses containing a specific asset
     * @param string $asset
     * @param Page $page
     * @return array
     */
    public function getAssetByAddresses(string $asset, Page $page = null):array
    {
        $resp = $this->get("/assets/{$asset}/addresses", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\AssetAddress']);
    }
    
    /**List of asset minted under a specific policy
     * @param string $policy_id
     * @param Page $page
     * @return array
     */
    public function getAssetsByPolicy(string $policy_id, Page $page = null):array
    {
        $resp = $this->get("/assets/policy/{$policy_id}", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Asset\Asset']);
    }
    
    
    
}











?>