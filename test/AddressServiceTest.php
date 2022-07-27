<?php

use PHPUnit\Framework\TestCase;
use Blockfrost\Address\AddressesService;
use Blockfrost\Page;
use function PHPUnit\Framework\assertArrayHasKey;

//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class AddressServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        global $TEST_PROJECT_ID;
        
        $this->service = new AddressesService(AddressesService::$NETWORK_CARDANO_TESTNET, $TEST_PROJECT_ID);
    }
    

    public function test_address_willReturn_addressForBechAddress():void
    {
        $addressResponse = $this->service->getAddress("addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg");
        
        $this->assertEquals($addressResponse->address, "addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg");
    }

  
    public function test_addressDetails_willReturn_addressDetailsForBechAddress():void
    {

        $addressTotalResponse = $this->service->getAddressTotal("addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg");
       
        $this->assertEquals($addressTotalResponse->address, "addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg");
        
    }


    public function test_addressUtxos_willReturn_addressUtxosForCountPageAndAscendingOrder():void
    {
        $addressUtxoList = $this->service->getAddressUTXOs("addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg", new Page(2, 1, "asc") );

        $this->assertEquals(2, count($addressUtxoList));
    }

    public function test_addressUtxos_willReturn_addressUtxosForCountAndPage():void
    {
        $addressUtxoList = $this->service->getAddressUTXOs("addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg",new Page(2, 1));

        $this->assertEquals(2, count($addressUtxoList));
    }

       
    public function test_addressUtxos_willThrowAPIException_onNullAddress():void
    {
        $this->expectExceptionMessage("Invalid address");
        
        $this->service->getAddressUTXOs("", new Page(2, 1) );        
    }

    public function test_addressTransactions_willReturn_addressTransactionsForCountPageAndAscendingOrderNoRange():void
    {
        $addressTransactionListsList = $this->service->getAddressTransactions("addr_test1qrlf8mers2lzpp9y278tc4xp8yug7djflrnrr55c8fmg75qxu2hyfhlkwuxupa9d5085eunq2qywy7hvmvej456flkns2gsze6", new Page(100, 1, "asc") );
    
        $this->assertGreaterThanOrEqual(2, count($addressTransactionListsList));
    }

    public function test_addressTransactions_willReturn_addressTransactionsForCountPageAndAscendingOrder():void
    {
        $addressTransactionLists = $this->service->getAddressTransactions("addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg", new Page(2, 1, "asc"), "8929261", "9999269");

        $this->assertLessThanOrEqual(2, count($addressTransactionLists));
    }

        
    public function test_addressTransactions_willReturn_addressTransactionsForCountAndPage():void
    {
        $addressTransactionLists = $this->service->getAddressTransactions("addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg", new Page(2, 1), "8929261", "9999269");

        $this->assertLessThanOrEqual(2, count($addressTransactionLists));
    }

        
    public function test_addressTransactions_willReturn_allAddressTransactions():void
    {
        $addressTransactionLists = $this->service->getAddressTransactions("addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg", null, "8929261", "9999269");

        $this->assertGreaterThanOrEqual(0, count($addressTransactionLists));
    }


    public function test_addressTransactions_willThrowAPIException_onNullAddress():void
    {
        $this->expectExceptionMessage("Invalid address");
        
        $this->service->getAddressTransactions(null, new Page(2, 1, "asc"), "8929261", "9999269");
        
        
    }

}
