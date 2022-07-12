<?php 

namespace Blockfrost\Account;



use Blockfrost\Service;
use Blockfrost\Page;


class AccountsService extends Service 
{
    public function __construct(string $network, string $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getAccount(string $stake_address):AccountContent
    {
        $resp = $this->get("/accounts/{$stake_address}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Account\AccountContent');
    }
    
    public function getAccountRewardHistory(string $stake_address, Page $page = null):array
    {
        $resp = $this->get("/accounts/{$stake_address}/rewards", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountRewardHistory']);
    }
    
    public function getAccountHistory($stake_address, Page $page = null):array // <AccountHistoryContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/history", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountHistory']);
    }
    
    public function getAccountDelegationHistory($stake_address, Page $page = null):array // <AccountDelegationContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/delegations", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountDelegationHistory']);
    }
    
    public function getAccountRegistrationHistory($stake_address, Page $page = null):array // <AccountRegistrationContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/registrations", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountRegistrationHistory']);
    }
    
    public function getAccountWithdrawalHistory($stake_address, Page $page = null):array 
    {
        $resp = $this->get("/accounts/{$stake_address}/withdrawals", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountWithdrawalHistory']);
    }
    
    public function getAccountMirHistory($stake_address, Page $page = null):array
    {
        $resp = $this->get("/accounts/{$stake_address}/mirs", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountMirHistory']);
    }
    
    public function getAccountAssociatedAddresses($stake_address, Page $page = null):array //<AccountAddressesContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountAssociatedAddress']);
    }
    
    public function getAccountAssociatedAssets($stake_address, Page $page = null):array
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses/assets", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountAsset']);
    }
    
    public function getAccountAssociatedAddressesTotal($stake_address):\Blockfrost\Account\AccountTotal
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses/total");

        return $this->resp_from_json($resp,  
                                                ['_kind' => 'object',
                                                 '_type' => '\Blockfrost\Account\AccountTotal',
                                                 'stake_address' => 'string',
                                                 'received_sum' => ['array', '\Blockfrost\Account\AccountSum'],
                                                 'sent_sum' => ['array', '\Blockfrost\Account\AccountSum'],
                                                 'tx_count' => 'int'
                                               ] );
    }
    
    
}











