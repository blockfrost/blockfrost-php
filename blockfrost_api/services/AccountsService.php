<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoAccountsApi;



use OpenAPI\Client\Model\AccountContent;
use OpenAPI\Client\Model\AccountAddressesTotal;





class AccountsService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoAccountsApi( $this->getClient(), /*config"*/);
    }
    
    public function getAccount($stake_address):AccountContent
    {
        return $this->call( $this->api->accountsStakeAddressGetAsyncWithHttpInfo($stake_address) )[0];
    }
    
    public function getAccountRewardHistory($stake_address):array
    {
        return $this->call( $this->api->accountsStakeAddressRewardsGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountHistory($stake_address):array // <AccountHistoryContentInner>
    {
        return $this->call( $this->api->accountsStakeAddressHistoryGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountDelegationHistory($stake_address):array // <AccountDelegationContentInner>
    {
        return $this->call( $this->api->accountsStakeAddressDelegationsGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountRegistrationHistory($stake_address):array // <AccountRegistrationContentInner>
    {
        return $this->call( $this->api->accountsStakeAddressRegistrationsGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountWithdrawalHistory($stake_address):array 
    {
        return $this->call( $this->api->accountsStakeAddressWithdrawalsGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountMirHistory($stake_address):array
    {
        return $this->call( $this->api->accountsStakeAddressMirsGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountAssociatedAddresses($stake_address):array //<AccountAddressesContentInner>
    {
        return $this->call( $this->api->accountsStakeAddressAddressesGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountAssociatedAssets($stake_address):array
    {
        return $this->call( $this->api->accountsStakeAddressAddressesAssetsGetAsyncWithHttpInfo($stake_address) )[0]; //PAGE
    }
    
    public function getAccountAssociatedAddressesTotal($stake_address):AccountAddressesTotal
    {
        return $this->call( $this->api->accountsStakeAddressAddressesTotalGetAsyncWithHttpInfo($stake_address) )[0];
    }
    
    
}











