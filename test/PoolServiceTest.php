<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;
use Blockfrost\Metadata\MetadataService;

use Blockfrost\Pool\Pool;
use Blockfrost\Pool\PoolsService;
use Blockfrost\Pool\PoolStakePool;
use Blockfrost\Page;
use Blockfrost\Pool\PoolHistory;
use Blockfrost\Pool\PoolMetadata;
use Blockfrost\Pool\PoolRelay;
use Blockfrost\Pool\PoolDelegator;
use Blockfrost\Pool\PoolUpdate;



//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class PoolServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new PoolsService(MetadataService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
    
    public function test_pool_willReturn_poolForPoolId():void
    {
        $expectedPool = new PoolStakePool();
        $expectedPool->pool_id = "pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem";
        $expectedPool->hex = "5685f37bca393c683cf03e428280312c6c4ea485188672a2a0b3195c";
        $expectedPool->vrf_key = "3409a1bebeaa47e6d99e0748a99f65dee60b7f7e9a64dc865d52b4fb445b98ab";
        $expectedPool->blocks_minted = 0;
        $expectedPool->live_stake = "997443657";
        $expectedPool->live_size = 6.98550757958531E-8;
        $expectedPool->live_saturation = 0.00001780488133619636;
        $expectedPool->live_delegators = 1;
        $expectedPool->active_stake = 0;
        $expectedPool->active_size = 0;
        $expectedPool->declared_pledge = "10000000";
        $expectedPool->live_pledge = "997443657";
        $expectedPool->margin_cost = "0.075";
        $expectedPool->fixed_cost = "340000000";
        $expectedPool->reward_account = "stake_test1up32f2hrv5ytqk8ad6e4apss5zrrjjlrkjhrksypn5g08fqrqf9gr";
        $expectedPool->owners = ["stake_test1up32f2hrv5ytqk8ad6e4apss5zrrjjlrkjhrksypn5g08fqrqf9gr"];
        $expectedPool->registration = ["78925fad4cce75a22a675ed5e175ecfd40baf7ac51c487c5cdb0fde9a02afa64"];
        $expectedPool->retirement["fd8a94eaa104d73b177ff092f959c9ae376bd9fb464a57cfc85664c4823011ed"];
                    

        $pool = $this->service->getStakePool("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem");
        
        $this->assertNotNull($pool);
        
        $this->assertEquals($pool->pool_id, "pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem");
            

    }

    public function test_pool_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getStakePool(null);
    }

    public function test_pools_willReturn_poolsForCountPageAndAscendingOrder():void
    {
        $expectedPoolList = [
                    "pool1adur9jcn0dkjpm3v8ayf94yn3fe5xfk2rqfz7rfpuh6cw6evd7w",
                    "pool18kd2k7kqt9gje9y0azahww4dqak9azeeg8ayl0xl7dzewg70vlf",
                    "pool13dgxp4ph2ut5datuh5na4wy7hrnqgkj4fyvac3e8fzfqcc7qh0h",
                    "pool1wnf793xkgrw3s800tfdkkg3s3ddgxkucenahzs7490g4q0cpe0v",
                    "pool156gxlrk0e3phxadasa33yzk9e94wg7tv3au02jge8eanv9zc4ym"
            ];

        $poolList = $this->service->getStakePools(new Page(5, 1, "asc"));

        $this->assertEquals(5, count($poolList) );
        
        foreach($expectedPoolList as $value)
            $this->assertContains($value, $poolList);
            

    }
    
    public function test_pools_willReturn_allPools():void
    {
        $poolList = $this->service->getStakePools();

        $this->assertGreaterThanOrEqual(0, count($poolList));
       
    }

        
    public function test_pools_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");
        
        $this->service->getStakePools(new Page(101, 1) );
    }


    public function test_retiredPools_willReturn_retiredPoolsForCountPageAndAscendingOrder():void
    {
        $retirement0 = new Pool();
        $retirement0->pool_id = "pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem";
        $retirement0->epoch = 76;
        
        $retirement1 = new Pool();
        $retirement1->pool_id = "pool16kc6ck4clmhg2aykwhkymnz2ypk54yuvk0txt3p6mrw05hrsj3a";
        $retirement1->epoch = 76;
        
        $retirement2 = new Pool();
        $retirement2->pool_id = "pool1y25deq9kldy9y9gfvrpw8zt05zsrfx84zjhugaxrx9ftvwdpua2";
        $retirement2->epoch = 78;

        $poolList = $this->service->getRetiredStakePools(new Page(3, 1, "asc"));

       // fwrite(STDOUT, json_encode($poolList));
        
        $this->assertEquals(3, count($poolList) );
        
        
        $this->assertContainsEquals($retirement0, $poolList);
        $this->assertContainsEquals($retirement1, $poolList);
        $this->assertContainsEquals($retirement2, $poolList);
            
    }

       
    public function test_retiredPools_willReturn_allRetiredPools():void
    {
        $poolList = $this->service->getRetiredStakePools();

        $this->assertGreaterThanOrEqual(0, count($poolList));

    }

        
    public function test_retiredPools_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");
        
        $this->service->getRetiredStakePools(new Page(101, 1) );
    }


    public function test_retiringPools_willReturn_retiringPoolsForCountPageAndAscendingOrder():void
    {
        $poolList = $this->service->getRetiringStakePools(new Page(2, 1, "asc"));
        $this->assertLessThanOrEqual(2, count($poolList));
    }

    public function test_retiringPools_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");
        
        $this->service->getRetiredStakePools( new Page(101, 1));
    }


    public function test_poolHistory_willReturn_poolHistoryForCountPageAndAscendingOrder():void
    {
        $history0 = new PoolHistory();
        $history0->epoch = 77;            
        $history0->blocks = 0;            
        $history0->active_stake = "1497626626";       
        $history0->active_size = 0.00016613871489641306;
        $history0->delegators_count = 1;
        $history0->rewards = 0;
        $history0->fees = 0;
        
        $history1 = new PoolHistory();
        $history1->epoch = 78;
        $history1->blocks = 0;
        $history1->active_stake = "1497626626";
        $history1->active_size = 0.000014972989086644468;
        $history1->delegators_count = 1;
        $history1->rewards = 0;
        $history1->fees = 0;
        
        $history2 = new PoolHistory();
        $history2->epoch = 79;
        $history2->blocks = 0;
        $history2->active_stake = "1497626626";
        $history2->active_size = 0.000002942120178511434;
        $history2->delegators_count = 1;
        $history2->rewards = 0;
        $history2->fees = 0;
        
        $expectedPoolHistory = [$history0, $history1, $history2];
                   
            
        $poolHistory = $this->service->getStakePoolHistory("pool1adur9jcn0dkjpm3v8ayf94yn3fe5xfk2rqfz7rfpuh6cw6evd7w", new Page(3, 1, "asc"));

        $this->assertEquals(3, count($poolHistory) );
        
        foreach($expectedPoolHistory as $value)
            $this->assertContainsEquals($value, $poolHistory);
    }


    public function test_poolHistory_willReturn_entireHistory():void
    {
        $poolList = $this->service->getStakePoolHistory("pool1adur9jcn0dkjpm3v8ayf94yn3fe5xfk2rqfz7rfpuh6cw6evd7w");

        $this->assertGreaterThanOrEqual(0, count($poolList));

    }

    public function test_poolHistory_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");

        $this->service->getStakePoolHistory("pool1adur9jcn0dkjpm3v8ayf94yn3fe5xfk2rqfz7rfpuh6cw6evd7w", new Page(101, 1));

    }

        
    public function test_poolHistory_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getStakePoolHistory(null, new Page(101, 1));
    }

    
    public function test_poolMetadata_willReturn_poolMetadataForPoolId():void
    {
        $expectedPoolMetadata = new PoolMetadata();
        $expectedPoolMetadata->pool_id = "pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem";
        $expectedPoolMetadata->hex = "5685f37bca393c683cf03e428280312c6c4ea485188672a2a0b3195c";
        $expectedPoolMetadata->url = "https://visionstaking.ch/poolmeta.json";
        $expectedPoolMetadata->hash = "7feb5bf22fc8c57be71a4b24f68381a7d1051e94290164530da6f7d5682a0024";
        $expectedPoolMetadata->ticker = "visn";
        $expectedPoolMetadata->name = "vision";
        $expectedPoolMetadata->description = "Vision Staking";
        $expectedPoolMetadata->homepage = "https://visionstaking.ch";
                    
        $poolMetadata = $this->service->getStakePoolMetadata("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem");
        
        $this->assertNotNull($poolMetadata);
          
        $this->assertEquals($expectedPoolMetadata->pool_id, $poolMetadata->pool_id);
        $this->assertEquals($expectedPoolMetadata->hex, $poolMetadata->hex);
        $this->assertEquals($expectedPoolMetadata->hash, $poolMetadata->hash);
    }

        
    public function test_poolMetadata_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getStakePoolMetadata(null);
    }


    public function test_poolRelays_willReturn_poolRelaysForPoolId():void
    {
        $expectedPoolRelays = new PoolRelay();
        $expectedPoolRelays->ipv4 = "120.12.13.43";
        $expectedPoolRelays->ipv6 = null;
        $expectedPoolRelays->dns = null;
        $expectedPoolRelays->dns_srv = null;
        $expectedPoolRelays->port = 6000;
                            
        $poolRelays = $this->service->getStakePoolRelays("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem");
        
        $this->assertEquals(1, count($poolRelays) );
        
        $this->assertEquals($expectedPoolRelays, $poolRelays[0]);
    }

        
    public function test_poolRelays_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getStakePoolRelays(null);
    }

    public function test_poolDelegators_willReturn_poolDelegatorsForCountPageAndAscendingOrder():void
    {
        $poolDelegator = new PoolDelegator();
        $poolDelegator->address = "stake_test1up32f2hrv5ytqk8ad6e4apss5zrrjjlrkjhrksypn5g08fqrqf9gr";
        $poolDelegator->live_stake = "997443657";
                            
        $poolDelegatorList = $this->service->getStakePoolDelegators("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem", new Page(3, 1, "asc") );

        $this->assertEquals(1, count($poolDelegatorList) );
        
        $this->assertEquals($poolDelegator, $poolDelegatorList[0]);
    }

      
    public function test_poolDelegators_willReturn_allPoolDelegators():void
    {
        $poolList = $this->service->getStakePoolDelegators("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem");

        $this->assertGreaterThanOrEqual(0, count($poolList));

    }

        
    public function test_poolDelegators_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");
        
        $this->service->getStakePoolDelegators("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem", new Page(101, 1));
    }

        
    public function test_poolDelegators_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
    
        $this->service->getStakePoolRelays(null);
    }


    public function test_poolBlocks_willReturn_poolBlocksForCountPageAndAscendingOrder():void
    {
        $poolBlockList = $this->service->getStakePoolBlocks("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem", new Page(3, 1, "asc") );

        $this->assertEquals(0, count($poolBlockList) );
    }

  
    public function test_poolBlocks_willReturn_allPoolBlocks():void
    {
        $poolList = $this->service->getStakePoolBlocks("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem");

        $this->assertGreaterThanOrEqual(0, count($poolList));
    }

        
    public function test_poolBlocks_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");
        
        $this->service->getStakePoolBlocks("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem", new Page(101, 1));
    }

        
    public function test_poolBlocks_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getStakePoolRelays(null);
    }

    
    public function test_poolUpdates_willReturn_poolUpdatesForCountPageAndAscendingOrder():void
    {
        $expected0 = new PoolUpdate();
        $expected0->tx_hash = "78925fad4cce75a22a675ed5e175ecfd40baf7ac51c487c5cdb0fde9a02afa64";
        $expected0->cert_index = 0;
        $expected0->action = "registered";
        
        $expected1 = new PoolUpdate();
        $expected1->tx_hash = "fd8a94eaa104d73b177ff092f959c9ae376bd9fb464a57cfc85664c4823011ed";
        $expected1->cert_index = 0;
        $expected1->action = "deregistered";
                            
        $expectedPoolUpdateList = [$expected0, $expected1];

        $poolUpdateList = $this->service->getStakePoolUpdates("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem", new Page(3, 1, "asc"));

        $this->assertEquals(2, count($poolUpdateList) );
        
        foreach($expectedPoolUpdateList as $value);
            $this->assertContainsEquals($value, $poolUpdateList);
    }


    public function test_poolUpdates_willReturn_allPoolUpdates():void
    {
        $poolList = $this->service->getStakePoolUpdates("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem");

        $this->assertGreaterThanOrEqual(0, count($poolList));
    }

        
    public function test_poolUpdates_willThrowAPIException_onCountGreaterThan100():void
    {   
        $this->expectExceptionMessage("querystring.count should be <= 100");

        $this->service->getStakePoolUpdates("pool126zlx7728y7xs08s8epg9qp393kyafy9rzr89g4qkvv4cv93zem", new Page(101, 1));

    }

        
    public function test_poolUpdates_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getStakePoolRelays(null);
    }


}
