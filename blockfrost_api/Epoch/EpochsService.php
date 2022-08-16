<?php 

namespace Blockfrost\Epoch;



use Blockfrost\Service;
use Blockfrost\Page;

class EpochsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**Return the information about the latest, therefore current, epoch.
     * @return Epoch
     */
    public function getLatestEpoch():Epoch
    {
        $resp = $this->get("/epochs/latest");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\Epoch');
    }
    
    /**Return the protocol parameters for the latest epoch.
     * @return EpochParameters
     */
    public function getLatestEpochProtocolParameters():EpochParameters
    {
        $resp = $this->get("/epochs/latest/parameters");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\EpochParameters');
    }
    
    /**Return the content of the requested epoch.
     * @param int $number
     * @return Epoch
     */
    public function getEpoch(int $number):Epoch
    {
        $resp = $this->get("/epochs/{$number}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\Epoch');
    }
    
    /**Return the list of epochs following a specific epoch.
     * @param int $number
     * @param Page $page
     * @return array
     */
    public function getNextEpochs(int $number, Page $page = null):array //<EpochContent>
    {
        $resp = $this->get("/epochs/{$number}/next", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\Epoch']);
    }
    
    /**Return the list of epochs preceding a specific epoch.
     * @param int $number
     * @param Page $page
     * @return array
     */
    public function getPreviousEpochs(int $number, Page $page = null):array //<EpochContent>
    {
        $resp = $this->get("/epochs/{$number}/previous", $page); 
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\Epoch']);
    }
    
    /**Return the active stake distribution for the specified epoch.
     * @param int $number
     * @param Page $page
     * @return array
     */
    public function getStakeDistribution(int $number, Page $page = null):array 
    {
        $resp = $this->get("/epochs/{$number}/stakes", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\EpochStakeAndPool']);
    }
    
    /**Return the active stake distribution for the epoch specified by stake pool.
     * @param int $number
     * @param string $pool_id
     * @param Page $page
     * @return array
     */
    public function getStakeDistributionByPool(int $number, string $pool_id, Page $page = null):array //<StakePoolContentInner>
    {
        $resp = $this->get("/epochs/{$number}/stakes/{$pool_id}", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\EpochStake']);
    }
    
    /**Return the blocks minted for the epoch specified.
     * @param int $number
     * @param Page $page
     * @return array
     */
    public function getBlockDistribution(int $number, Page $page = null):array //<string>
    {
        $resp = $this->get("/epochs/{$number}/blocks", $page);
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    /**Return the block minted for the epoch specified by stake pool.
     * @param int $number
     * @param string $pool_id
     * @param Page $page
     * @return array
     */
    public function getBlockDistributionByPool(int $number, string $pool_id, Page $page = null):array //<string>
    {
        $resp = $this->get("/epochs/{$number}/blocks/{$pool_id}", $page);
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    /**Return the protocol parameters for the epoch specified.
     * @param int $number
     * @return EpochParameters
     */
    public function getProtocolParameters(int $number):EpochParameters
    {
        $resp = $this->get("/epochs/{$number}/parameters");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\EpochParameters');
    }
    
    
}






?>