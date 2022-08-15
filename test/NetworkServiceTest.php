<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;
use Blockfrost\Metadata\MetadataService;
use Blockfrost\Metadata\MetadataLabel;
use Blockfrost\Page;
use Blockfrost\Metadata\MetadataCBOR;
use Blockfrost\Metadata\MetadataJSON;
use Blockfrost\Network\NetworkService;



//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class NetworkServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new NetworkService(MetadataService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
    
    
    public function test_network_willReturn_networkInfo():void
    {

        //TODO: This changes frequently. Can we rely on max networkSupply or do we need to remove that also.

//        Network expectedNetwork = Network.builder()
//                .networkStake( NetworkStake.builder()
//                        .live("14278864583150094")
//                        .active("13690202531062820")
//                        .build())
//                .networkSupply( NetworkSupply.builder()
//                        .max("45000000000000000")
//                        .total("40236648947239373")
//                        .circulating("42051490630229286")
//                        .build())
//                .build();

        $networkResponse = $this->service->getNetworkInformation();
        
        $this->assertTrue( $networkResponse->supply->max == "45000000000000000" );
        
    }

}
