<?php

use PHPUnit\Framework\TestCase;
use Blockfrost\Page;
use function PHPUnit\Framework\assertArrayHasKey;



use function PHPUnit\Framework\assertTrue;
use Blockfrost\IPFS\IPFSService;
use Psr\Http\Message\StreamInterface;
use Blockfrost\IPFS\IPFSAdd;


//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class IPFSServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        global $TEST_PROJECT_ID;
        
        $this->service = new IPFSService(IPFSService::$NETWORK_IPFS, $TEST_PROJECT_ID);
    }
    
    public function test_add_willReturn_ipfsObject():void
    {
        $tempFile = $this->createFileWithContent("Hello Temp File\n");

        $ipfsObject = $this->service->addFile("test", $tempFile);
        
        //System.out.println(ipfsObject);
        
        $this->assertNotNull($ipfsObject->name);
        
        $this->assertEquals( "QmWAhBXx11KUkLxkYMNNCvriLWtPLRqw8Eo4EKHFeMBA5a", $ipfsObject->ipfs_hash);
        
        $this->assertEquals(24, $ipfsObject->size);
    }

    private function addFileToIpfs(string $name, string $content):IPFSAdd
    {
        $file = $this->createFileWithContent($content);
           
        return $this->service->addFile($name, $file);
    }
    
    private function createFileWithContent(string $content):StreamInterface
    {
        return IPFSService::streamFromString($content);
    }

 
    public function test_add_willThrowIOException_WhenFileNull():void
    {
        $this->expectExceptionMessage("must implement interface");
        
        $this->service->addFile("FileIsNull", null);
    }

    
    public function test_get_willReturnContent_WhenValidIpfsHash():void
    {
        $content = $this->service->getFile("QmWAhBXx11KUkLxkYMNNCvriLWtPLRqw8Eo4EKHFeMBA5a");
        
        $this->assertEquals("Hello Temp File\n", IPFSService::readStreamAsString($content));

    }

    
    public function test_pinAdd_willReturn_pinState():void
    {
        //Add the file incase it's removed
        $tempFile = $this->createFileWithContent("Hello Temp File\n");
        
        $ipfsObject = $this->service->addFile("test", $tempFile);

        $ipfsHash = "QmWAhBXx11KUkLxkYMNNCvriLWtPLRqw8Eo4EKHFeMBA5a";
        
        $pinResponse = $this->service->pinObject($ipfsHash);

        //System.out.println(pinResponse);
        
        $this->assertEquals($ipfsHash, $pinResponse->ipfs_hash);
        
        $this->assertTrue( $pinResponse->state == "queued" || $pinResponse->state == "pinned");
        
    }

    
    public function test_getPinnedObjectsWithPagination_willReturn_pinnedObjects():void
    {
        //Add 15 items
        $ipfsObjects = [];
        
        for($i=0; $i < 14; $i++)
        {
            $file = $this->createFileWithContent("Hello Temp File-".$i);
            
            $ipfsObject = $this->service->addFile("test", $file);
            
            $ipfsService = $this->service->pinObject($ipfsObject->ipfs_hash);
            $ipfsObjects[] = $ipfsObject;
           
            sleep(1);
        }

        $pinnedItems1 = $this->service->listPinnedObjects( new Page(5, 1, "desc"));
        $pinnedItems2 = $this->service->listPinnedObjects( new Page(5, 2, "desc"));
        $pinnedItems3 = $this->service->listPinnedObjects( new Page(5, 3, "desc"));
        //System.out.println(pinnedItems1);

        $this->assertEquals(5, count($pinnedItems1));
        $this->assertEquals(5, count($pinnedItems2));
        
        $this->assertTrue( count($pinnedItems3) >= 4, "Pinned items size in 3 page should be equal or more than 4");
        
        $this->assertNotNull( $pinnedItems1[0]->ipfs_hash );

        $this->assertNotEquals(0, $pinnedItems1[0]->time_created);
        $this->assertNotEquals(0, $pinnedItems1[0]->time_pinned);
        
        
        $this->assertNotNull( $pinnedItems1[0]->state );
        
    }

    
    public function test_getPinnedObjects_willReturn_AllPinItems():void
    {
        //Add 14 items
        $ipfsObjects = [];
        
        for($i=0; $i < 14; $i++)
        {
            $file = $this->createFileWithContent("Hello Temp File-".$i);
            
            $ipfsObject = $this->service->addFile("test", $file);
            
            $ipfsService = $this->service->pinObject($ipfsObject->ipfs_hash);
            $ipfsObjects[] = $ipfsObject;
            
            sleep(1);
        }

        //((IPFSServiceImpl)ipfsService).setDefaultFetchSize(10);
        
        $pinnedItems = $this->service->listPinnedObjects();
        
        
        $this->assertTrue( count($pinnedItems) >= 14, "Pinned items size should be 14 or more");
    }

    
    public function test_getPinnedObjectByIpfsPath_willReturn_pinnedObject():void
    {
        //Add object and pin
        $ipfsObject = $this->addFileToIpfs("test", "Hello Temp File\n");
        
        $ipfsHash = $ipfsObject->ipfs_hash;
        
        $this->service->pinObject($ipfsHash);

        $pinItem = $this->service->getPinnedObject($ipfsHash);
        //System.out.println(pinItem);

        $this->assertTrue( $pinItem->time_created > 0);
        $this->assertTrue( $pinItem->time_pinned > 0);
        $this->assertEquals($ipfsHash, $pinItem->ipfs_hash );
        $this->assertNotNull( $pinItem->state );
        $this->assertEquals(24, $pinItem->size );
    }

    
    public function test_getPinnedObjectByIpfsPath_willUnpinAndReturn_UnpinnedObject():void
    {
        //Add object and pin
        $ipfsObject = $this->addFileToIpfs("test", "Hello Temp File");
        $this->service->pinObject( $ipfsObject->ipfs_hash );

        //Remove pin
        $pinItem = $this->service->removePinnedObject($ipfsObject->ipfs_hash );
        //System.out.println(pinItem);

        $this->assertEquals( $ipfsObject->ipfs_hash, $pinItem->ipfs_hash );
        $this->assertEquals( "unpinned", $pinItem->state);

        //The following fields should not be set
      //  $this->assertEquals(0, $pinItem->time_created);
       // $this->assertEquals(0, $pinItem->time_pinned );
        //$this->assertNull( $pinItem->size);
    }
}
