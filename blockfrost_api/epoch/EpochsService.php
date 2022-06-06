<?php 

namespace Blockfrost\Epoch;



use Blockfrost\Service;

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
    
    public function getNextEpochs(int $number):array //<EpochContent>
    {
        $resp = $this->get("/epochs/{$number}/next");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\Epoch']);
    }
    
    public function getPreviousEpochs(int $number):array //<EpochContent>
    {
        $resp = $this->get("/epochs/{$number}/previous");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\Epoch']);
    }
    
    public function getStakeDistribution(int $number):array 
    {
        $resp = $this->get("/epochs/{$number}/stakes");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\EpochStakeAndPool']);
    }
    
    public function getStakeDistributionByPool(int $number, string $pool_id):array //<StakePoolContentInner>
    {
        $resp = $this->get("/epochs/{$number}/stakes/{$pool_id}");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Epoch\EpochStake']);
    }
    
    public function getBlockDistribution(int $number):array //<string>
    {
        $resp = $this->get("/epochs/{$number}/blocks");
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    public function getBlockDistributionByPool(int $number, string $pool_id):array //<string>
    {
        $resp = $this->get("/epochs/{$number}/blocks/{$pool_id}");
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    public function getProtocolParameters(int $number):EpochParameters
    {
        $resp = $this->get("/epochs/{$number}/parameters");
        
        return $this->resp_from_json($resp, '\Blockfrost\Epoch\EpochParameters');
    }
    
    
}






?>