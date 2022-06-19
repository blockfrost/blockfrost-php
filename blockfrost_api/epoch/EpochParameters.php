<?php 

namespace Blockfrost\Epoch;

class EpochParameters
{
    
    public $epoch;                  // 225,
    public $min_fee_a;              // 44,
    public $min_fee_b;              // 155381,
    public $max_block_size;         // 65536,
    public $max_tx_size;            // 16384,
    public $max_block_header_size;  // 1100,
    public $key_deposit;            // "2000000",
    public $pool_deposit;           // "500000000",
    public $e_max;                  // 18,
    public $n_opt;                  // 150,
    public $a0;                     // 0.3,
    public $rho;                    // 0.003,
    public $tau;                    // 0.2,
    public $decentralisation_param; // 0.5,
    public $extra_entropy;          // null,
    public $protocol_major_ver;     // 2,
    public $protocol_minor_ver;     // 0,
    public $min_utxo;               // "1000000",
    public $min_pool_cost;          // "340000000",
    public $nonce;                  // "1a3be38bcbb7911969283716ad7aa550250226b76a61fc51cc9a9a35d9276d81",
    public $price_mem;              // 0.0577,
    public $price_step;             // 0.0000721,
    public $max_tx_ex_mem;          // "10000000",
    public $max_tx_ex_steps;        // "10000000000",
    public $max_block_ex_mem;       // "50000000",
    public $max_block_ex_steps;     // "40000000000",
    public $max_val_size;           // "5000",
    public $collateral_percent;     // 150,
    public $max_collateral_inputs;  // 3,
    public $coins_per_utxo_word;    // "34482"
}

?>