<?php

use PHPUnit\Framework\TestCase;
use Blockfrost\Page;
use function PHPUnit\Framework\assertArrayHasKey;
use Blockfrost\Asset\AssetsService;
use Blockfrost\Asset\Asset;
use Blockfrost\Asset\AssetContent;
use function PHPUnit\Framework\assertTrue;
use Blockfrost\Asset\AssetHistory;
use Blockfrost\Asset\AssetTransaction;
use Blockfrost\Asset\AssetAddress;
use Blockfrost\Epoch\EpochsService;
use Blockfrost\Epoch\Epoch;
use Blockfrost\Epoch\EpochParameters;

//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class EpochServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new EpochsService(AssetsService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
   
    public function test_latestEpoch_willReturn_latestEpoch():void
    {
        $latestEpoch = $this->service->getLatestEpoch();
        
        $this->assertNotNull($latestEpoch);
    }

    
    public function test_latestEpochParam_willReturn_latestEpochParam():void
    {
        $latestEpochParam = $this->service->getLatestEpochProtocolParameters();
        
        $this->assertNotNull($latestEpochParam);
    }

    
    public function test_getEpoch_willReturn_epochForEpochNumber():void
    {   
        
        $expectedEpoch = new Epoch();
        $expectedEpoch->epoch = 1;
        $expectedEpoch->start_time =1564431616;
        $expectedEpoch->end_time = 1564863616;
        $expectedEpoch->first_block_time = 1564431616;
        $expectedEpoch->last_block_time  =1564863596;
        $expectedEpoch->block_count  =21601;
        $expectedEpoch->tx_count  = 305;
        $expectedEpoch->output = "152336265877919";
        $expectedEpoch->fees = "54105620";
        $expectedEpoch->active_stake = null;
                

        $epoch = $this->service->getEpoch(1);
        
        $this->assertEquals($expectedEpoch, $epoch);
        

    }

    
    public function test_nextEpochs_willReturn_nextEpochsForCountAndPage():void
    {
        $expectedEpoch = new Epoch();
        $expectedEpoch->epoch = 2;
        $expectedEpoch->start_time =1564863616;
        $expectedEpoch->end_time = 1565295616;
        $expectedEpoch->first_block_time = 1564863616;
        $expectedEpoch->last_block_time  =1565295596;
        $expectedEpoch->block_count  =21601;
        $expectedEpoch->tx_count  = 182;
        $expectedEpoch->output = "35581408008991";
        $expectedEpoch->fees = "40548594";
        $expectedEpoch->active_stake = null;

       
        $nextEpochs = $this->service->getNextEpochs(1, new Page(5, 1) );

        $this->assertEquals(5, count($nextEpochs));
        
        $this->assertContainsEquals($expectedEpoch, $nextEpochs);
    }

    
    public function test_nextEpochs_willReturn_allNextEpochs():void
    {

        $latestEpoch = $this->service->getLatestEpoch();
        
        $nextEpochs = $this->service->getNextEpochs( $latestEpoch->epoch - 5 );
        
        $this->assertGreaterThanOrEqual(0, count($nextEpochs));
    }

    
    public function test_previousEpochs_willReturn_previousEpochsForCountAndPage():void
    {
        $expectedEpoch = new Epoch();
        $expectedEpoch->epoch = 1;
        $expectedEpoch->start_time =1564431616;
        $expectedEpoch->end_time = 1564863616;
        $expectedEpoch->first_block_time = 1564431616;
        $expectedEpoch->last_block_time  =1564863596;
        $expectedEpoch->block_count  =21601;
        $expectedEpoch->tx_count  = 305;
        $expectedEpoch->output = "152336265877919";
        $expectedEpoch->fees = "54105620";
        $expectedEpoch->active_stake = null;

       
        $previousEpochs = $this->service->getPreviousEpochs(2, new Page(1, 1) );

        $this->assertEquals(1, count($previousEpochs));
        
        
        $this->assertContainsEquals($expectedEpoch, $previousEpochs);
        
    }

    
    public function test_previousEpochs_willReturn_allPreviousEpochs():void
    {
        $previousEpochs = $this->service->getPreviousEpochs(2);
        
        $this->assertGreaterThanOrEqual(0, count($previousEpochs));
    }

    
    public function test_activeStakesForEpoch_willReturn_activeStakesForEpochForCountAndPage():void
    {
        $activeStakes = $this->service->getStakeDistribution(149, new Page(5, 1) );

        $this->assertLessThanOrEqual(5, count($activeStakes));
        
        $this->assertNotNull($activeStakes[0]->pool_id);
        $this->assertNotNull($activeStakes[0]->stake_address);
       
    }

    
    public function test_activeStakesForEpoch_willReturn_allActiveStakesForEpoch():void
    {
        $activeStakes = $this->service->getStakeDistribution(149);
        
        $this->assertGreaterThanOrEqual(0, count($activeStakes));
    }   

    
    public function test_activeStakesForEpochAndPool_willReturn_activeStakesForEpochAndPoolForCountAndPage():void
    {
        $activeStakesForPool = $this->service->getStakeDistributionByPool(149, "pool1q0umnwuvj6menpj49z64fr4hf2z7qwnme28c87tyss7zc7y3c5e", new Page(5, 1) );

        $this->assertLessThanOrEqual(5, count($activeStakesForPool));
       
    }

    
    public function test_activeStakesForEpochAndPool_willReturn_allActiveStakesForEpochAndPool():void
    {

        $activeStakesForPool = $this->service->getStakeDistributionByPool(149, "pool1q0umnwuvj6menpj49z64fr4hf2z7qwnme28c87tyss7zc7y3c5e" );
        
        $this->assertGreaterThanOrEqual(0, count($activeStakesForPool));

    }

    
    public function test_activeStakesForEpochAndPool_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->getStakeDistributionByPool(1, null, new Page(5, 1));
        
    }

    
    public function test_epochParam_willReturn_epochParamForEpoch():void
    {
        $expectedEpochParam = new EpochParameters();
        $expectedEpochParam->epoch = 140;
        $expectedEpochParam->min_fee_a = 44;
        $expectedEpochParam->min_fee_b = 155381;
        $expectedEpochParam->max_block_size = 65536;
        $expectedEpochParam->max_tx_size = 16384;
        $expectedEpochParam->max_block_header_size = 1100;
        $expectedEpochParam->key_deposit = "2000000";
        $expectedEpochParam->pool_deposit = "500000000";
        $expectedEpochParam->e_max = 18;
        $expectedEpochParam->n_opt = 500;
        $expectedEpochParam->a0 = 0.3;
        $expectedEpochParam->rho = 0.003;
        $expectedEpochParam->tau = 0.2;
        $expectedEpochParam->decentralisation_param = 0;
        $expectedEpochParam->extra_entropy = null;
        $expectedEpochParam->protocol_major_ver = 4;
        $expectedEpochParam->protocol_minor_ver = 0;
        $expectedEpochParam->min_utxo = "1000000";
        $expectedEpochParam->min_pool_cost = "340000000";
        $expectedEpochParam->nonce = "02b62200eca66c5896fab9a3f5421c72958df1f3279aa2f5fc72c514cec16ed9";
                

        $latestEpochParam = $this->service->getProtocolParameters(140);
        
        $this->assertEquals($expectedEpochParam, $latestEpochParam);
        

    }

    
    public function test_blocksForEpoch_willReturn_blocksForEpochForCountPageAndOrder():void
    {
        $blockHash = "7e8b2df7730261d8831fe0206591570734d353c15d5266b7fe77097090d33cbd";

        $blocksForEpoch = $this->service->getBlockDistribution(1, new Page(5, 1, "asc"));

        $this->assertLessThanOrEqual(5, count($blocksForEpoch));
        
        $this->assertContainsEquals($blockHash, $blocksForEpoch);
        

    }

    
    public function test_blocksForEpoch_willReturn_blocksForEpochForCountPage():void
    {
        $blockHash = "7e8b2df7730261d8831fe0206591570734d353c15d5266b7fe77097090d33cbd";
        
        $blocksForEpoch = $this->service->getBlockDistribution(1, new Page(5, 1));
        
        $this->assertLessThanOrEqual(5, count($blocksForEpoch));
        
        $this->assertContainsEquals($blockHash, $blocksForEpoch);
    }

    
    public function test_blocksForEpochAndPool_willReturn_blocksForEpochAndPoolForCountPageAndOrder():void
    {
        $latestEpoch = $this->service->getLatestEpoch();
        
        $activeStakes = $this->service->getStakeDistribution($latestEpoch->epoch, new Page(1, 1) );
        
        $blocksForEpoch = $this->service->getStakeDistributionByPool($latestEpoch->epoch, $activeStakes[0]->pool_id, new Page(5, 1, "asc") );

        $this->assertLessThanOrEqual(5, count($blocksForEpoch));
        
    }

    
    public function test_blocksForEpochAndPool_willReturn_blocksForEpochAndPoolForCountPage():void
    {
        $latestEpoch = $this->service->getLatestEpoch();
        
        $activeStakes = $this->service->getStakeDistribution($latestEpoch->epoch, new Page(1, 1) );
        
        $blocksForEpoch = $this->service->getBlockDistributionByPool($latestEpoch->epoch, $activeStakes[0]->pool_id, new Page(5, 1) );

        $this->assertLessThanOrEqual(5, count($blocksForEpoch));

    }

    
    public function test_blocksForEpochAndPool_willReturn_allBlocksForEpochAndPool():void
    {
        $latestEpoch = $this->service->getLatestEpoch();
        
        $activeStakes = $this->service->getStakeDistribution($latestEpoch->epoch, new Page(1, 1) );
        
        $blocksForEpoch = $this->service->getBlockDistributionByPool($latestEpoch->epoch, $activeStakes[0]->pool_id);
        
        $this->assertGreaterThanOrEqual(0, count($blocksForEpoch));

    }
}

