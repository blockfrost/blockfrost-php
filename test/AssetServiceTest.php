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

//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class AssetServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new AssetsService(AssetsService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
    
    public function test_getAssets_willReturn_assetsForCountPageAndOrder():void
    {
        $asset = new Asset();
        $asset->asset = "476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e";
        $asset->quantity = 1;
                    

        $assetList = $this->service->getAssetList( new Page(5, 1, "asc") );
         
        $this->assertLessThanOrEqual(5, count($assetList));
        
        $this->assertContainsEquals($asset, $assetList);
    }

    public function test_getAssets_willReturn_assetsForCountAndPage():void
    {
        $asset = new Asset();
        $asset->asset = "476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e";
        $asset->quantity = 1;

        $assetList = $this->service->getAssetList( new Page(5, 1) );
        
        $this->assertLessThanOrEqual(5, count($assetList));
        
        $this->assertContainsEquals($asset, $assetList);
    }

    
    public function test_getAsset_willReturn_asset():void
    {
        $expectedAsset = new AssetContent();
        
        $expectedAsset->asset = "07a6604234b758be257f26565445f30169c25c85cf392797bc878de753554d";
        $expectedAsset->policy_id = "07a6604234b758be257f26565445f30169c25c85cf392797bc878de7";
        $expectedAsset->asset_name = "53554d";
        $expectedAsset->fingerprint = "asset1jjfl57h6uyf4fw8wzeyzwmtly7ptmjpy36ugqk";
        $expectedAsset->quantity =1200000;
        $expectedAsset->initial_mint_tx_hash = "35de2138b3b84f9a0eb2de321a88eca2163b0077e4e3bcb9d6e7bd2922e746e7";
        $expectedAsset->mint_or_burn_count = 1;
        $expectedAsset->onchain_metadata = null;
        $expectedAsset->metadata = null;
                    

        $asset = $this->service->getAsset("07a6604234b758be257f26565445f30169c25c85cf392797bc878de753554d");
        
        $this->assertEquals($asset, $expectedAsset);
    }

        
    public function test_getAsset_willReturn_assetWithOnchainMetadata():void
    {
            $filesKey = "files";

            $expectedFiles = [];
            $expectedFiles["src"] =  "ipfs://QmaotSicXXa9LzpYKfkt6SWhgTVrRGyBJbTWAgDA1sVBXH";
            $expectedFiles["name"] = "FreeGhost01853";
            $expectedFiles["https"] =  "";
            $expectedFiles["mediaType"] = "image/jpeg";

            $expectedOnchainMetadata = [];
            $expectedOnchainMetadata["dna"] =  "00013000";
            $expectedOnchainMetadata["back"] = "College Backpack";
            $expectedOnchainMetadata["body"] =  "Blue Shirt";
            $expectedOnchainMetadata["eyes"] = "Normal";
            $expectedOnchainMetadata["name"] = "FreeGhost01853";
            $expectedOnchainMetadata[$filesKey] =  [$expectedFiles];
            $expectedOnchainMetadata["ghost"] = "Normal";
            $expectedOnchainMetadata["image"] = "ipfs://QmaotSicXXa9LzpYKfkt6SWhgTVrRGyBJbTWAgDA1sVBXH";
            $expectedOnchainMetadata["rarity"] =  "Epic";
            $expectedOnchainMetadata["project"] = "FreeGhost";
            $expectedOnchainMetadata["twitter"] = "twitter.com/freeroam_io";
            $expectedOnchainMetadata["website"] =  "FREEROAM TESTING";
            $expectedOnchainMetadata["mediaType"] =  "image/jpeg";

            $asset = $this->service->getAsset("3f5265ef14f89e948fd5b5f55419712ad1f0dd4d75ab26be134441714672656547686f73743031383533");
            $onchainMetadata = $asset->onchain_metadata;
            
            $this->assertNotNull($onchainMetadata);
            
            foreach($expectedOnchainMetadata as $key => $value)
            {
                if( $key == $filesKey )
                    continue;
                
                $this->assertTrue( isset($onchainMetadata[$key]) );
                
                $this->assertEquals($value, $onchainMetadata[$key]);  
            }
            
            assertTrue( is_array($onchainMetadata[$filesKey]) );
            

            $files = $onchainMetadata[$filesKey];
            $file = $files[0];
            foreach ($expectedFiles as $key => $value)
            {
                $this->assertTrue ( isset($file[$key] ));
                $this->assertEquals($value, $file[$key] );
            }
              
    }

    public function test_getAsset_willThrowAPIException_onNullAsset():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->getAsset(null);
    }


    public function test_getAssetHistory_willReturn_assetHistoryForCountPageAndOrder():void
    {
        $expectedAssetHistory = new AssetHistory();
        $expectedAssetHistory->tx_hash = "e067ca567df4920f4ac3babc4d805d2afe860e21aa7f6f78dbe8538caf9d8262";
        $expectedAssetHistory->amount = 1;
        $expectedAssetHistory->action = "minted";
        

        $assetHistoryList = $this->service->getAssetHistory("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e", new Page(5, 1, "asc") );
        
       // fwrite(STDOUT, json_encode($assetHistoryList));
        
        $this->assertLessThanOrEqual(5, count($assetHistoryList));
        
        $this->assertContainsEquals($expectedAssetHistory, $assetHistoryList);
    }

    public function test_getAssetHistory_willReturn_assetHistoryForCountAndPage():void
    {
        $expectedAssetHistory = new AssetHistory();
        $expectedAssetHistory->tx_hash = "e067ca567df4920f4ac3babc4d805d2afe860e21aa7f6f78dbe8538caf9d8262";
        $expectedAssetHistory->amount = 1;
        $expectedAssetHistory->action = "minted";
        
        $assetHistoryList = $this->service->getAssetHistory("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e", new Page(5, 1) );
        
        $this->assertLessThanOrEqual(5, count($assetHistoryList));
        
        $this->assertContainsEquals($expectedAssetHistory, $assetHistoryList);
    }

       
    public function test_getAssetHistory_willReturn_allAssetHistory():void
    {
        $assetHistoryList = $this->service->getAssetHistory("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e"); //?correct func?
            
        $this->assertGreaterThanOrEqual(0, count($assetHistoryList));

    }

        
    public function test_getAssetHistory_willThrowAPIException_onNullAsset():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->getAssetHistory(null, new Page(5, 1));
            
    }


    public function test_getAssetTransaction_willReturn_assetTransactionForCountPageAndOrder():void
    {   
        $expectedAssetTransaction = new AssetTransaction();
        $expectedAssetTransaction->tx_hash = "e067ca567df4920f4ac3babc4d805d2afe860e21aa7f6f78dbe8538caf9d8262";
        $expectedAssetTransaction->block_height = 2287021;
        $expectedAssetTransaction->tx_index = 0;
        $expectedAssetTransaction->block_time = 1612383646;
        
        
        $assetTransactionList = $this->service->getAssetTransactions("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e", new Page(5, 1, "asc") );
          
       // fwrite(STDOUT, json_encode($assetTransactionList));
        
        $this->assertLessThanOrEqual(5, count($assetTransactionList));
        
        $this->assertContainsEquals($expectedAssetTransaction, $assetTransactionList);
    }

        
    public function test_getAssetTransaction_willReturn_assetTransactionForCountAndPage():void
    {   
        $expectedAssetTransaction = new AssetTransaction();
        $expectedAssetTransaction->tx_hash = "e067ca567df4920f4ac3babc4d805d2afe860e21aa7f6f78dbe8538caf9d8262";
        $expectedAssetTransaction->block_height = 2287021;
        $expectedAssetTransaction->tx_index = 0;
        $expectedAssetTransaction->block_time = 1612383646;
        
        $assetTransactionList = $this->service->getAssetTransactions("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e", new Page(5, 1) );
        
        $this->assertLessThanOrEqual(5, count($assetTransactionList));
        
        $this->assertContainsEquals($expectedAssetTransaction, $assetTransactionList);
    }

        
    public function test_getAssetTransaction_willReturn_allAssetTransactions():void
    {
        $assetTransactionList = $this->service->getAssetList();
        
        $this->assertGreaterThanOrEqual(0, count($assetTransactionList));

    }


    public function test_getAssetTransaction_willThrowAPIException_onNullAsset():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->getAssetTransactions(null, new Page(5, 1));
    }


    public function test_getAssetAddresses_willReturn_assetAddressesForCountPageAndOrder():void
    {
        $expectedAssetAddress = new AssetAddress();
        $expectedAssetAddress->address = "addr_test1qrus2mgpuv3nqvmusfszhhy0pyk8m92qgnfng3s3kj6vwndre5df3pzwwmyq946axfcejy5n4x0y99wqpgtp2gd0k09q5z0f76";
        $expectedAssetAddress->quantity = 1;
                    
        $assetAddressList = $this->service->getAssetByAddresses("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e", new Page(5, 1, "asc") );

        $this->assertLessThanOrEqual(5, count($assetAddressList));
    }

        
    public function test_getAssetAddresses_willReturn_assetAddressesForCountAndPage():void
    {
        $expectedAssetAddress = new AssetAddress();
        $expectedAssetAddress->address = "addr_test1qrus2mgpuv3nqvmusfszhhy0pyk8m92qgnfng3s3kj6vwndre5df3pzwwmyq946axfcejy5n4x0y99wqpgtp2gd0k09q5z0f76";
        $expectedAssetAddress->quantity = 1;
        
        $assetAddressList = $this->service->getAssetByAddresses("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e", new Page(5, 1) );
        
        $this->assertLessThanOrEqual(5, count($assetAddressList));
    }

        
    public function test_getAssetAddresses_willReturn_allAssetAddresses():void
    {
        $assetAddressList = $this->service->getAssetByAddresses("476039a0949cf0b22f6a800f56780184c44533887ca6e821007840c36e7574636f696e");
           
        $this->assertGreaterThanOrEqual(0, count($assetAddressList));
    }

        
    public function test_getAssetAddresses_willThrowAPIException_onNullAsset():void
    {
        $this->expectExceptionMessage("must be of the type string");

        $this->service->getAssetByAddresses(null, new Page(5, 1));
    }


    public function test_getPolicyAssets_willReturn_policyAssetsForCountPageAndOrder():void
    {
        $policyAssetsList = $this->service->getAssetsByPolicy("07a6604234b758be257f26565445f30169c25c85cf392797bc878de7", new Page(5, 1, "asc") );
            
        $this->assertLessThanOrEqual(5, count($policyAssetsList));
    }

        
    public function test_getPolicyAssets_willReturn_policyAssetsForCountAndPage():void
    {
        $policyAssetsList = $this->service->getAssetsByPolicy("07a6604234b758be257f26565445f30169c25c85cf392797bc878de7", new Page(5, 1) );
        
        $this->assertLessThanOrEqual(5, count($policyAssetsList));
    }

        
    public function vgetPolicyAssets_willReturn_allPolicyAssets():void
    {
        $policyAssetsList = $this->service->getAssetsByPolicy("07a6604234b758be257f26565445f30169c25c85cf392797bc878de7");
        
        $this->assertGreaterThanOrEqual(0, count($policyAssetsList));
    }

    public function test_getPolicyAssets_willThrowAPIException_onNullPolicyId():void
    {
        $this->expectExceptionMessage("must be of the type string");
        
        $this->service->getAssetsByPolicy(null, new Page(5, 1) );

       
    }

}

?>
