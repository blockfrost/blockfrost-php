<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoEpochsApi;
use OpenAPI\Client\Model\EpochContent;
use OpenAPI\Client\Model\EpochParamContent;





class EpochsService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoEpochsApi( $this->getClient(), /*config"*/);
    }
    
    public function getLatestEpoch():EpochContent
    {
        return $this->call( $this->api->epochsLatestGetAsyncWithHttpInfo() )[0]; 
    }
    
    public function getLatestEpochProtocolParameters():EpochParamContent
    {
        return $this->call( $this->api->epochsLatestParametersGetAsyncWithHttpInfo() )[0]; 
    }
    
    public function getEpoch(int $number):EpochContent
    {
        return $this->call( $this->api->epochsNumberGetAsyncWithHttpInfo($number) )[0]; 
    }
    
    public function getNextEpochs(int $number):array //<EpochContent>
    {
        return $this->call( $this->api->epochsNumberNextGetAsyncWithHttpInfo($number) )[0]; //PAGE
    }
    
    public function getPreviousEpochs(int $number):array //<EpochContent>
    {
        return $this->call( $this->api->epochsNumberPreviousGetAsyncWithHttpInfo($number) )[0]; //PAGE
    }
    
    public function getStakeDistribution(int $number):array 
    {
        return $this->call( $this->api->epochsNumberStakesGetAsyncWithHttpInfo($number) )[0]; //PAGE
    }
    
    public function getStakeDistributionByPool(int $number, string $pool_id):array //<StakePoolContentInner>
    {
        return $this->call( $this->api->epochsNumberStakesPoolIdGetAsyncWithHttpInfo($number, $pool_id) )[0]; //PAGE
    }
    
    public function getBlockDistribution(int $number):array //<string>
    {
        return $this->call( $this->api->epochsNumberBlocksGetAsyncWithHttpInfo($number) )[0]; //PAGE
    }
    
    public function getBlockDistributionByPool(int $number, string $pool_id):array //<string>
    {
        return $this->call( $this->api->epochsNumberBlocksPoolIdGetAsyncWithHttpInfo($number, $pool_id) )[0]; //PAGE
    }
    
    public function getProtocolParameters(int $number):EpochParamContent
    {
        return $this->call( $this->api->epochsNumberParametersGetAsyncWithHttpInfo($number) )[0]; //PAGE
    }
    
    
}






?>