<?php 

namespace Blockfrost\Ledger;

class LedgerGenesis
{
    public $active_slots_coefficient;   // 0.05,
    public $update_quorum;              // 5,
    public $max_lovelace_supply;        // "45000000000000000",
    public $network_magic;              // 764824073,
    public $epoch_length;               // 432000,
    public $system_start;               // 1506203091,
    public $slots_per_kes_period;       // 129600,
    public $slot_length;                // 1,
    public $max_kes_evolutions;         // 62,
    public $security_param;             // 2160
}

?>