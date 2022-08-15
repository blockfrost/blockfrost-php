<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;
use Blockfrost\IPFS\IPFSService;
use Blockfrost\Ledger\LedgerService;
use Blockfrost\Ledger\LedgerGenesis;


//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class LedgerServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new LedgerService(IPFSService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
    
    public function test_genesis_willReturn_blockchainGenesis():void
    {
        $expectedGenesis = new LedgerGenesis();
        $expectedGenesis->active_slots_coefficient = 0.05;
        $expectedGenesis->update_quorum = 5;
        $expectedGenesis->max_lovelace_supply = "45000000000000000";
        $expectedGenesis->network_magic = 1097911063;
        $expectedGenesis->epoch_length = 432000;
        $expectedGenesis->system_start =1563999616;
        $expectedGenesis->slots_per_kes_period = 129600;
        $expectedGenesis->slot_length =1;
        $expectedGenesis->max_kes_evolutions = 62;
        $expectedGenesis->security_param = 2160;
                

        $genesisResponse = $this->service->getBlockchainGenesis();
        
        $this->assertEquals($expectedGenesis, $genesisResponse);
    }

}
