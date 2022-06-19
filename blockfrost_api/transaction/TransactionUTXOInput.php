<?php 

namespace Blockfrost\Transaction;

class TransactionUTXOInput
{
    public $address;        // "addr1q9ld26v2lv8wvrxxmvg90pn8n8n5k6tdst06q2s856rwmvnueldzuuqmnsye359fqrk8hwvenjnqultn7djtrlft7jnq7dy7wv",
    public $amount;         // [ { "unit": "lovelace", "quantity": "42000000" }, ],
    public $tx_hash;        // "1a0570af966fb355a7160e4f82d5a80b8681b7955f5d44bec0dce628516157f0",
    public $output_index;   // 0,
    public $data_hash;      // "9e478573ab81ea7a8e31891ce0648b81229f408d596a3483e6f4f9b92d3cf710",
    public $collateral;     // false
}

?>