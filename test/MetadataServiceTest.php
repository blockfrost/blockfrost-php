<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;
use Blockfrost\Metadata\MetadataService;
use Blockfrost\Metadata\MetadataLabel;
use Blockfrost\Page;
use Blockfrost\Metadata\MetadataCBOR;
use Blockfrost\Metadata\MetadataJSON;



//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class MetadataServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new MetadataService(MetadataService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
    
    
    public function test_transactionMetadataLabels_willReturn_transactionMetadataLabelsForCountPageAndAscendingOrder():void
    {
        $label0 = new MetadataLabel();
        $label0->label = 0;
        $label0->count = 27471;
        
        $label1 = new MetadataLabel();
        $label1->label = 1;
        $label1->count = 4454;
        
        $label2 = new MetadataLabel();
        $label2->label = 2;
        $label2->count = 4185;
        
        $expectedTransactionMetadataLabelsList = [$label0, $label1, $label2];
        
        $metadataList = $this->service->getTransactionMetadataLabels( new Page(3, 1, "asc"));

        $this->assertEquals(3, count($metadataList) );
        
        foreach($expectedTransactionMetadataLabelsList[0] as $key => $value)
        {
            if( $key == "count" )
                continue;
                
                $this->assertEquals($value, $metadataList[0]->$key);
        }
            

    }

        
        
    public function test_transactionMetadataLabels_willReturn_allTransactionMetadataLabels():void
    {
        $metadataList = $this->service->getTransactionMetadataLabels();
        
        $this->assertGreaterThanOrEqual(0, count($metadataList));

    }

        
    public function test_transactionMetadataLabels_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");
        
        $this->service->getTransactionMetadataLabels(new Page(101, 1) );

    }


    public function transactionMetadataCborForLabel_willReturn_transactionMetadataLabelCborForCountPageAndAscendingOrder():void
    {   
        $cbor0 = new MetadataCBOR();
        $cbor0->tx_hash = "1c8997f9f0debde5b15fe29f0f18839a64e51c19ccdbe89e2811930d777c9b68";
        $cbor0->metadata = "\\xa1006763617264616e6f";
        
        $cbor1 = new MetadataCBOR();
        $cbor1->tx_hash = "d28b574902c286dc1d589c239095c97c5f352dfac08274583898b6380274930a";
        $cbor1->metadata = "\\xa1006763617264616e6f";
        
        $cbor1 = new MetadataCBOR();
        $cbor1->tx_hash = "5037dca9a80649bc44dc619233b31f4b7dcc1dd23ab808b1cc225b3b2b6bf736";
        $cbor1->metadata = "\\xa1006763617264616e6f";
        
        $expectedTransactionMetadataLabelCborList = [$cbor0, $cbor1, $cbor2 ];
                    
        $transactionMetadataLabelCborList = $this->service->getTransactionMetadataAsCBOR("0", new Page(3, 1, "asc") );

        $this->assertEquals(3, count($transactionMetadataLabelCborList) );
        
        $this->assertContainsEquals($cbor0, $transactionMetadataLabelCborList);
        $this->assertContainsEquals($cbor1, $transactionMetadataLabelCborList);
        $this->assertContainsEquals($cbor2, $transactionMetadataLabelCborList);

    }

    public function  test_transactionMetadataCborForLabel_willReturn_allTransactionMetadataLabelCbors():void
    {
        $transactionMetadataLabelCborList = $this->service->getTransactionMetadataAsCBOR("100");
        
        $this->assertGreaterThanOrEqual(0, count($transactionMetadataLabelCborList));

    }


    public function  test_transactionMetadataCborForLabel_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");
        
        $this->service->getTransactionMetadataAsCBOR("0", new Page(101, 1) );
    }

        
    public function test_transactionMetadataCborForLabel_willThrowAPIException_onNullLabel():void
    {
        $this->expectExceptionMessage("must be of the type string");

        $this->service->getTransactionMetadataAsCBOR(null);
    }


    public function test_transactionMetadataJsonForLabel_willReturn_transactionMetadataLabelJsonForCountPageAndAscendingOrder():void
    {
        $json0 = new MetadataJSON();
        $json0->json_metadata = "cardano";
        $json0->tx_hash = "1c8997f9f0debde5b15fe29f0f18839a64e51c19ccdbe89e2811930d777c9b68";
        
        $json1 = new MetadataJSON();
        $json1->json_metadata = "cardano";
        $json1->tx_hash = "d28b574902c286dc1d589c239095c97c5f352dfac08274583898b6380274930a";
        
        $json2 = new MetadataJSON();
        $json2->json_metadata = "cardano";
        $json2->tx_hash = "5037dca9a80649bc44dc619233b31f4b7dcc1dd23ab808b1cc225b3b2b6bf736";
        
          
        $transactionMetadataLabelJsonList = $this->service->getTransactionMetadataAsJSON("0", new Page(3, 1, "asc" ));

        $this->assertEquals(3, count($transactionMetadataLabelJsonList) );
        
        $this->assertContainsEquals($json0, $transactionMetadataLabelJsonList);
        $this->assertContainsEquals($json1, $transactionMetadataLabelJsonList);
        $this->assertContainsEquals($json2, $transactionMetadataLabelJsonList);
    }

        

    public function test_transactionMetadataJsonForLabel_willReturn_allTransactionMetadataLabelJson():void
    {
        $transactionMetadataLabelJsonList = $this->service->getTransactionMetadataAsJSON("10");
        
        $this->assertGreaterThanOrEqual(0, count($transactionMetadataLabelJsonList));
    }

        
    public function test_transactionMetadataJsonForLabel_willThrowAPIException_onCountGreaterThan100():void
    {
        $this->expectExceptionMessage("querystring.count should be <= 100");

        $this->service->getTransactionMetadataAsJSON("0", new Page(101, 1));
    }

        
    public function test_transactionMetadataJsonForLabel_willThrowAPIException_onNullLabel():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->getTransactionMetadataAsJSON(null, new Page(1, 1) );


        

    }

}
