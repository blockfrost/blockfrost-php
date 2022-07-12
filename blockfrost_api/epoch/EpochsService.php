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
    
    public function getLatestEpoch():Epoch
    {
        $resp = $this->get("/epochs/latest");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\Epoch');
    }
    
    public function getLatestEpochProtocolParameters():EpochParameters
    {
        $resp = $this->get("/epochs/latest/parameters");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\EpochParameters');
    }
    
    public function getEpoch(int $number):Epoch
    {
        $resp = $this->get("/epochs/{$number}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\Epoch');
    }
    
    public function getNextEpochs(int $number, Page $page = null):array //<EpochContent>
    {
        $resp = $this->get("/epochs/{$number}/next", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\Epoch']);
    }
    
    public function getPreviousEpochs(int $number, Page $page = null):array //<EpochContent>
    {
        $resp = $this->get("/epochs/{$number}/previous", $page); 
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\Epoch']);
    }
    
    public function getStakeDistribution(int $number, Page $page = null):array 
    {
        $resp = $this->get("/epochs/{$number}/stakes", page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\EpochStakeAndPool']);
    }
    
    public function getStakeDistributionByPool(int $number, string $pool_id, Page $page = null):array //<StakePoolContentInner>
    {
        $resp = $this->get("/epochs/{$number}/stakes/{$pool_id}", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\EpochStake']);
    }
    
    public function getBlockDistribution(int $number, Page $page = null):array //<string>
    {
        $resp = $this->get("/epochs/{$number}/blocks", $page);
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    public function getBlockDistributionByPool(int $number, string $pool_id, Page $page = null):array //<string>
    {
        $resp = $this->get("/epochs/{$number}/blocks/{$pool_id}", $page);
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    public function getProtocolParameters(int $number):EpochParameters
    {
        $resp = $this->get("/epochs/{$number}/parameters");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\EpochParameters');
    }
    
    
}






?>