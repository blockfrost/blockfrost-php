<?php



use PHPUnit\Framework\TestCase;
use Blockfrost\Account\AccountsService;
use Blockfrost\Page;
use function PHPUnit\Framework\assertArrayHasKey;


//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class AccountServiceTest extends TestCase
{
    var $service;

    public function setUp():void //TEST_ID_IPFS   TEST_ID_TESTNET
    {
		//phpinfo();
		//echo getenv(/*'TEST_ID_TESTNET'*/'TEST_ID_IPFS');
		//var_dump(getenv('TEST_ID_TESTNET'));
		
        $this->service = new AccountsService(AccountsService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
    
  

    public function test_getAccountByStakeAddress_willReturn_Account():void
    {
        $stakeAddress = "stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha";
        
        $account = $this->service->getAccount($stakeAddress);
        
        $this->assertSame($account->stake_address, $stakeAddress);
        $this->assertTrue($account->active);
        $this->assertNotNull($account->pool_id);
    }

 
    public function test_getAccountByStakeAddress_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccount(null);
    }

    public function test_history_willReturn_historyForCountPageAndAscendingOrder():void
    {
        $historyList = $this->service->getAccountHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($historyList));
        
        foreach ($historyList as $object)
            $this->assertNotNull($object->pool_id);
    }

    public function test_history_willReturn_historyForCountAndPage():void
    {
        $historyList = $this->service->getAccountHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha",  new Page(3, 1, "asc") );
    
        $this->assertLessThanOrEqual(3, count($historyList));
        
        foreach ($historyList as $object)
            $this->assertNotNull($object->pool_id);
    }


    public function test_history_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountHistory(null,  new Page(3, 1, "asc") );
    }

    
    public function test_rewardHistory_willReturn_rewardHistoryForCountPageAndAscendingOrder():void
    {
        $rewardHistoryList = $this->service->getAccountRewardHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($rewardHistoryList));
    }

    public function test_rewardHistory_willReturn_rewardHistoryForCountAndPage():void
    {
        $rewardHistoryList = $this->service->getAccountRewardHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($rewardHistoryList));

    }

    public function test_rewardHistory_willReturn_entireRewardHistory():void
    {
        $rewardHistoryList = $this->service->getAccountRewardHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha");
        
        $this->assertGreaterThanOrEqual(0, count($rewardHistoryList));
    }

    public function test_rewardHistory_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountRewardHistory(null, new Page(3, 1, "asc") );
    }

 
    public function test_delegationHistory_willReturn_delegationHistoryForCountPageAndAscendingOrder():void
    {
        $delegationHistoryList = $this->service->getAccountDelegationHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha",  new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($delegationHistoryList));
    }

    public function test_delegationHistory_willReturn_delegationHistoryForCountAndPage():void
    {
        $delegationHistoryList = $this->service->getAccountDelegationHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha",  new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($delegationHistoryList));
    }

    public function test_delegationHistory_willReturn_entireDelegationHistory():void
    {
        $delegationHistoryList = $this->service->getAccountDelegationHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha");

        $this->assertGreaterThanOrEqual(0, count($delegationHistoryList));
    }

    public function test_delegationHistory_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountDelegationHistory(null,  new Page(3, 1, "asc") );
    }

    public function test_registrationHistory_willReturn_registrationHistoryForCountPageAndAscendingOrder():void
    {
        $registrationHistoryList = $this->service->getAccountRegistrationHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha",new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($registrationHistoryList));
    }

    public function test_registrationHistory_willReturn_registrationHistoryForCountAndPage():void
    {
        $registrationHistoryList = $this->service->getAccountRegistrationHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($registrationHistoryList));
    }


    public function test_registrationHistory_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountRegistrationHistory(null, new Page(3, 1, "asc") );
    }


    public function test_withdrawalHistory_willReturn_withdrawalHistoryForCountPageAndAscendingOrder():void
    {
        $withdrawalHistoryList = $this->service->getAccountWithdrawalHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($withdrawalHistoryList));
    }

    public function test_withdrawalHistory_willReturn_withdrawalHistoryForCountAndPage():void
    {
        $withdrawalHistoryList = $this->service->getAccountWithdrawalHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha",new Page(3, 1) );

        $this->assertLessThanOrEqual(3, count($withdrawalHistoryList));
    }

  
    public function test_withdrawalHistory_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountWithdrawalHistory(null, new Page(3, 1) );
        
    }

    public function test_mirHistory_willReturn_mirHistoryForCountPageAndAscendingOrder():void
    {
        $mirHistoryList = $this->service->getAccountMirHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($mirHistoryList));
    }

    public function test_mirHistory_willReturn_mirHistoryForCountAndPage():void
    {
        $mirHistoryList = $this->service->getAccountMirHistory("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1) );
        
        $this->assertLessThanOrEqual(3, count($mirHistoryList));
    }


    public function test_mirHistory_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountMirHistory(null, new Page(3, 1) );
        
    }

    public function test_addresses_willReturn_addressesForCountPageAndAscendingOrder():void
    {
        $addressesList = $this->service->getAccountAssociatedAddresses("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha",  new Page(3, 1, "asc") );

        $this->assertLessThanOrEqual(3, count($addressesList));
    }

    public function test_addresses_willReturn_addressesForCountAndPage():void
    {
        $addressesList = $this->service->getAccountAssociatedAddresses("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha",  new Page(3, 1) );
        
        $this->assertLessThanOrEqual(3, count($addressesList));
    }

    
    public function test_addresses_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountAssociatedAddresses(null, new Page(3, 1)  );

    }

    
    public function test_assets_willReturn_assetsForCountPageAndAscendingOrder():void
    {
        $assetsList = $this->service->getAccountAssociatedAssets("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1, "asc"));

        $this->assertLessThanOrEqual(3, count($assetsList));
    }

    
    public function test_assets_willReturn_assetsForCountAndPage():void
    {
        $assetsList = $this->service->getAccountAssociatedAssets("stake_test1upwlsqc3m9629dsf2vw3ycuqv5jhd023xtjh3ax42nvj03gwy2cha", new Page(3, 1));
        
        $this->assertLessThanOrEqual(3, count($assetsList));
    }


    public function test_assets_willThrowAPIException_onNullPoolId():void
    {
        $this->expectExceptionMessage("type string, null given");
        
        $this->service->getAccountAssociatedAssets(null, new Page(3, 1) );
        
       
    }

}

?>
