<?php 

namespace Blockfrost\Account;



use Blockfrost\Service;

class AccountsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getAccount($stake_address):AccountContent
    {
        $resp = $this->get("/accounts/{$stake_address}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Account\AccountContent');
    }
    
    public function getAccountRewardHistory($stake_address):array
    {
        $resp = $this->get("/accounts/{$stake_address}/rewards");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountRewardHistory']);
    }
    
    public function getAccountHistory($stake_address):array // <AccountHistoryContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/history");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountHistory']);
    }
    
    public function getAccountDelegationHistory($stake_address):array // <AccountDelegationContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/delegations");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountDelegationHistory']);
    }
    
    public function getAccountRegistrationHistory($stake_address):array // <AccountRegistrationContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/registrations");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountRegistrationHistory']);
    }
    
    public function getAccountWithdrawalHistory($stake_address):array 
    {
        $resp = $this->get("/accounts/{$stake_address}/withdrawals");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountWithdrawalHistory']);
    }
    
    public function getAccountMirHistory($stake_address):array
    {
        $resp = $this->get("/accounts/{$stake_address}/mirs");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountMirHistory']);
    }
    
    public function getAccountAssociatedAddresses($stake_address):array //<AccountAddressesContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountAssociatedAddress']);
    }
    
    public function getAccountAssociatedAssets($stake_address):array
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses/assets");
        
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











