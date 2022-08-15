<?php 

namespace Blockfrost\Transaction;

class Transaction
{
    public $hash;               // "1e043f100dce12d107f679685acd2fc0610e10f72a92d412794c9773d11d8477",
    public $block;              // "356b7d7dbb696ccd12775c016941057a9dc70898d87a63fc752271bb46856940",
    public $block_height;       // 123456,
    public $block_time;         // 1635505891,
    public $slot;               // 42000000,
    public $index;              // 1,
    public $output_amount;      // [ { "unit": "lovelace", "quantity": "42000000" }, { "unit": "b0d07d45fe9514f80213f4020e5a61241458be626841cde717cb38a76e7574636f696e", "quantity": "12" } ],
    public $fees;               // "182485",
    public $deposit;            // "0",
    public $size;               // 433,
    public $invalid_before;     // null,
    public $invalid_hereafter;  // "13885913",
    public $utxo_count;         // 4,
    public $withdrawal_count;   // 0,
    public $mir_cert_count;     // 0,
    public $delegation_count;   // 0,
    public $stake_cert_count;   // 0,
    public $pool_update_count;  // 0,
    public $pool_retire_count;  // 0,
    public $asset_mint_or_burn_count;// 0,
    public $redeemer_count;     // 0,
    public $valid_contract;     // true
}

?>