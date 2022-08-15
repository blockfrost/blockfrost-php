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
use Blockfrost\Block\BlockService;
use Blockfrost\Block\BlockContent;

//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class BlockServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new BlockService(AssetsService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
   
    public function test_latestBlock_willReturn_latestBlock():void
    {
        $latestBlock = $this->service->getLatestBlock();
        
        $this->assertNotNull($latestBlock);
    }


    public function test_block_willReturn_BlockForHash():void
    {
        $expectedBlock = new BlockContent();
        $expectedBlock->time = 1564020236;
        $expectedBlock->height = 1;
        $expectedBlock->hash = "388a82f053603f3552717d61644a353188f2d5500f4c6354cc1ad27a36a7ea91";
        $expectedBlock->slot = 1031;
        $expectedBlock->epoch = 0;
        $expectedBlock->epoch_slot = 1031;
        $expectedBlock->slot_leader = "ByronGenesis-853b49c9ab5fc52d";
        $expectedBlock->size = 1950;
        $expectedBlock->tx_count = 0;
        $expectedBlock->previous_block = "8f8602837f7c6f8b8867dd1cbc1842cf51a27eaed2c70ef48325d00f8efb320f";
        $expectedBlock->next_block = "f4e96309537d15682211fcac4c249c2bdff8464476e047be99d80edf97bcf3ff";
        $expectedBlock->confirmations = 2793414;
        // public $output;         //"128314491794",

        $blockForHash = $this->service->getBlock("1");
        
        $this->assertNotNull($blockForHash);
        
        foreach($expectedBlock as $key => $value)
        {
            if( $key == "confirmations" )
                continue;
            
            $this->assertEquals($value, $blockForHash->$key);
        }

    }

    
    public function test_blockForSlot_willReturn_blockForGivenSlot():void
    {
        $expectedBlock = new BlockContent();
        $expectedBlock->time = 1564020236;
        $expectedBlock->height = 1;
        $expectedBlock->hash = "388a82f053603f3552717d61644a353188f2d5500f4c6354cc1ad27a36a7ea91";
        $expectedBlock->slot = 1031;
        $expectedBlock->epoch = 0;
        $expectedBlock->epoch_slot = 1031;
        $expectedBlock->slot_leader = "ByronGenesis-853b49c9ab5fc52d";
        $expectedBlock->size = 1950;
        $expectedBlock->tx_count = 0;
        $expectedBlock->previous_block = "8f8602837f7c6f8b8867dd1cbc1842cf51a27eaed2c70ef48325d00f8efb320f";
        $expectedBlock->next_block = "f4e96309537d15682211fcac4c249c2bdff8464476e047be99d80edf97bcf3ff";
        $expectedBlock->confirmations = 2793414;
        // public $output;         //"128314491794",

        $blockInSlot = $this->service->getSpecificBlockInSlot(1031);
        
        $this->assertNotNull($blockInSlot);
        
        foreach($expectedBlock as $key => $value)
        {
            if( $key == "confirmations" )
                continue;
                
                $this->assertEquals($value, $blockInSlot->$key);
        }

    }

    
    public function test_blockForEpochSlot_willReturn_blockForGivenEpochAndSlot():void
    {
        $expectedBlock = new BlockContent();
        $expectedBlock->time = 1564020236;
        $expectedBlock->height = 1;
        $expectedBlock->hash = "388a82f053603f3552717d61644a353188f2d5500f4c6354cc1ad27a36a7ea91";
        $expectedBlock->slot = 1031;
        $expectedBlock->epoch = 0;
        $expectedBlock->epoch_slot = 1031;
        $expectedBlock->slot_leader = "ByronGenesis-853b49c9ab5fc52d";
        $expectedBlock->size = 1950;
        $expectedBlock->tx_count = 0;
        $expectedBlock->previous_block = "8f8602837f7c6f8b8867dd1cbc1842cf51a27eaed2c70ef48325d00f8efb320f";
        $expectedBlock->next_block = "f4e96309537d15682211fcac4c249c2bdff8464476e047be99d80edf97bcf3ff";
        $expectedBlock->confirmations = 2793414;
        // public $output;         //"128314491794",

        $blockInSlot = $this->service->getSpecificBlockInSlotInEpoch(1031, 0);
        
        
        $this->assertNotNull($blockInSlot);
        
        foreach($expectedBlock as $key => $value)
        {
            if( $key == "confirmations" )
                continue;
                
                $this->assertEquals($value, $blockInSlot->$key);
        }
    }


    public function test_transactionsInLatestBlock_willReturn_transactionsInLatestBlockForCountPageAndAscendingOrder():void
    {
        $transactionsInLatestBlock = $this->service->getLatestBlockTransactions( new Page(5, 1, "asc") );

        $this->assertLessThanOrEqual(5, count($transactionsInLatestBlock));
    }

        
    public function test_transactionsInLatestBlock_willReturn_transactionsInLatestBlockForCountPage():void
    {
        $transactionsInLatestBlock = $this->service->getLatestBlockTransactions( new Page(5, 1) );
        
        $this->assertLessThanOrEqual(5, count($transactionsInLatestBlock));
    }

    public function test_transactionsInLatestBlock_willReturn_allTransactionsInLatestBlock():void
    {
        $transactionsInLatestBlock = $this->service->getLatestBlockTransactions();
        
        $this->assertGreaterThanOrEqual(0, count($transactionsInLatestBlock));
    }


    public function test_nextBlocks_willReturn_nextBlocksForCountAndPage():void
    {
        $expectedBlock = new BlockContent();
        $expectedBlock->time = 1564020256;
        $expectedBlock->height = 2;
        $expectedBlock->hash = "f4e96309537d15682211fcac4c249c2bdff8464476e047be99d80edf97bcf3ff";
        $expectedBlock->slot = 1032;
        $expectedBlock->epoch = 0;
        $expectedBlock->epoch_slot = 1032;
        $expectedBlock->slot_leader = "ByronGenesis-42186a6a0079ef39";
        $expectedBlock->size = 5799;
        $expectedBlock->tx_count = 0;
        $expectedBlock->previous_block = "388a82f053603f3552717d61644a353188f2d5500f4c6354cc1ad27a36a7ea91";
        $expectedBlock->next_block = "067e773e6ffd66ea06f7f1c967e18a1ee0916797f6a1c1abdf410379eb8b1dbe";
        $expectedBlock->confirmations = 2803485;
        // public $output;         //"128314491794",
        
        $nextBlocks = $this->service->listNextBlocks("1", new Page(1, 1) );
        
        $this->assertEquals(1, count($nextBlocks));
        
        foreach($expectedBlock as $key => $value)
        {
            if( $key == "confirmations" )
                continue;
                
                $this->assertEquals($value, $nextBlocks[0]->$key);
        }
    }

        
    public function test_nextBlocks_willReturn_allNextBlocks():void
    {
        $block = $this->service->getLatestBlock();
        
        $latestBlockNumber = $block->height;
        
        $nextBlocks = $this->service->listNextBlocks("".($latestBlockNumber - 5) );
        
        $this->assertGreaterThanOrEqual(0, count($nextBlocks));
    }


    public function test_nextBlocks_willThrowAPIException_onNullHash():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->listNextBlocks(null, new Page(5, 1));
    }


    public function previousBlocks_willReturn_previousBlocksForCountAndPage():void
    {
        $expectedBlock = new BlockContent();
        $expectedBlock->time = 1564020236;
        $expectedBlock->height = 1;
        $expectedBlock->hash = "388a82f053603f3552717d61644a353188f2d5500f4c6354cc1ad27a36a7ea91";
        $expectedBlock->slot = 1031;
        $expectedBlock->epoch = 0;
        $expectedBlock->epoch_slot = 1031;
        $expectedBlock->slot_leader = "ByronGenesis-853b49c9ab5fc52d";
        $expectedBlock->size = 1950;
        $expectedBlock->tx_count = 0;
        $expectedBlock->previous_block = "8f8602837f7c6f8b8867dd1cbc1842cf51a27eaed2c70ef48325d00f8efb320f";
        $expectedBlock->next_block = "f4e96309537d15682211fcac4c249c2bdff8464476e047be99d80edf97bcf3ff";
        $expectedBlock->confirmations = 2793414;
        // public $output;         //"128314491794",

        $previousBlocks = $this->service->listPreviousBlocks("2", new Page(1, 1) );

        $this->assertEquals(1, count($previousBlocks));
        
        foreach($expectedBlock as $key => $value)
        {
            if( $key == "confirmations" )
                continue;
                
                $this->assertEquals($value, $previousBlocks[0]->$key);
        }
    }


    public function previousBlocks_willReturn_allPreviousBlocks():void
    {
        $previousBlocks = $this->service->listPreviousBlocks("2");
        
        $this->assertGreaterThanOrEqual(0, count($previousBlocks));
    }

        
    public function test_previousBlocks_willThrowAPIException_onNullHash():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->listPreviousBlocks(null, new Page(5, 1));
    }

}
