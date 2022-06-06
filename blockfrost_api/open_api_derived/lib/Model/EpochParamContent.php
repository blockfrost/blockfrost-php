<?php
/**
 * EpochParamContent
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Blockfrost.io ~ API Documentation
 *
 * Blockfrost is an API as a service that allows users to interact with the Cardano blockchain and parts of its ecosystem.  ## Tokens  After signing up on https://blockfrost.io, a `project_id` token is automatically generated for each project. HTTP header of your request MUST include this `project_id` in order to authenticate against Blockfrost servers.  ## Available networks  At the moment, you can use the following networks. Please, note that each network has its own `project_id`.  <table>   <tr><td><b>Network</b></td><td><b>Endpoint</b></td></tr>   <tr><td>Cardano mainnet</td><td><tt>https://cardano-mainnet.blockfrost.io/api/v0</td></tt></tr>   <tr><td>Cardano testnet</td><td><tt>https://cardano-testnet.blockfrost.io/api/v0</tt></td></tr>   <tr><td>InterPlanetary File System</td><td><tt>https://ipfs.blockfrost.io/api/v0</tt></td></tr>   <tr><td>Milkomeda mainnet</td><td><tt>https://milkomeda-mainnet.blockfrost.io/api/v0</td></tt></tr>   <tr><td>Milkomeda testnet</td><td><tt>https://milkomeda-testnet.blockfrost.io/api/v0</td></tt></tr> </table>  ## Milkomeda  For more information about how to use Milkomeda as well as the list of available endpoints, see the <a href=\"https://blockfrost.dev/docs/start-building/milkomeda\">Milkomeda section on blockfrost.dev</a>.  ## Concepts  * All endpoints return either a JSON object or an array. * Data is returned in *ascending* (oldest first, newest last) order, if not stated otherwise.   * You might use the `?order=desc` query parameter to reverse this order. * By default, we return 100 results at a time. You have to use `?page=2` to list through the results. * All time and timestamp related fields (except `server_time`) are in seconds of UNIX time. * All amounts are returned in Lovelaces, where 1 ADA = 1 000 000 Lovelaces. * Addresses, accounts and pool IDs are in Bech32 format. * All values are case sensitive. * All hex encoded values are lower case. * Examples are not based on real data. Any resemblance to actual events is purely coincidental. * We allow to upload files up to 100MB of size to IPFS. This might increase in the future.  ## Errors  ### HTTP Status codes  The following are HTTP status code your application might receive when reaching Blockfrost endpoints and it should handle all of these cases.  * HTTP `400` return code is used when the request is not valid. * HTTP `402` return code is used when the projects exceed their daily request limit. * HTTP `403` return code is used when the request is not authenticated. * HTTP `404` return code is used when the resource doesn't exist. * HTTP `418` return code is used when the user has been auto-banned for flooding too much after previously receiving error code `402` or `429`. * HTTP `425` return code is used when the user has submitted a transaction when the mempool is already full, not accepting new txs straight away. * HTTP `429` return code is used when the user has sent too many requests in a given amount of time and therefore has been rate-limited. * HTTP `500` return code is used when our endpoints are having a problem.  ### Error codes  An internal error code number is used for better indication of the error in question. It is passed using the following payload.  ```json {   \"status_code\": 403,   \"error\": \"Forbidden\",   \"message\": \"Invalid project token.\" } ``` ## Limits  There are two types of limits we are enforcing:  The first depends on your plan and is the number of request we allow per day. We defined the day from midnight to midnight of UTC time.  The second is rate limiting. We limit an end user, distinguished by IP address, to 10 requests per second. On top of that, we allow each user to send burst of 500 requests, which cools off at rate of 10 requests per second. In essence, a user is allowed to make another whole burst after (currently) 500/10 = 50 seconds. E.g. if a user attemtps to make a call 3 seconds after whole burst, 30 requests will be processed. We believe this should be sufficient for most of the use cases. If it is not and you have a specific use case, please get in touch with us, and we will make sure to take it into account as much as we can.  ## SDKs  We support a number of SDKs that will help you in developing your application on top of Blockfrost.  <table>   <tr><td><b>Programming language</b></td><td><b>SDK</b></td></tr>   <tr><td>JavaScript</td><td><a href=\"https://github.com/blockfrost/blockfrost-js\">blockfrost-js</a></tr>   <tr><td>Haskell</td><td><a href=\"https://github.com/blockfrost/blockfrost-haskell\">blockfrost-haskell</a></tr>   <tr><td>Python</td><td><a href=\"https://github.com/blockfrost/blockfrost-python\">blockfrost-python</a></tr>   <tr><td>Rust</td><td><a href=\"https://github.com/blockfrost/blockfrost-rust\">blockfrost-rust</a></tr>   <tr><td>Golang</td><td><a href=\"https://github.com/blockfrost/blockfrost-go\">blockfrost-go</a></tr>   <tr><td>Ruby</td><td><a href=\"https://github.com/blockfrost/blockfrost-ruby\">blockfrost-ruby</a></tr>   <tr><td>Java</td><td><a href=\"https://github.com/blockfrost/blockfrost-java\">blockfrost-java</a></tr>   <tr><td>Scala</td><td><a href=\"https://github.com/blockfrost/blockfrost-scala\">blockfrost-scala</a></tr>   <tr><td>Swift</td><td><a href=\"https://github.com/blockfrost/blockfrost-swift\">blockfrost-swift</a></tr>   <tr><td>Kotlin</td><td><a href=\"https://github.com/blockfrost/blockfrost-kotlin\">blockfrost-kotlin</a></tr>   <tr><td>Elixir</td><td><a href=\"https://github.com/blockfrost/blockfrost-elixir\">blockfrost-elixir</a></tr>   <tr><td>.NET</td><td><a href=\"https://github.com/blockfrost/blockfrost-dotnet\">blockfrost-dotnet</a></tr>   <tr><td>Arduino</td><td><a href=\"https://github.com/blockfrost/blockfrost-arduino\">blockfrost-arduino</a></tr> </table>
 *
 * The version of the OpenAPI document: 0.1.37
 * Contact: contact@blockfrost.io
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.0.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * EpochParamContent Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class EpochParamContent implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'epoch_param_content';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'epoch' => 'int',
        'min_fee_a' => 'int',
        'min_fee_b' => 'int',
        'max_block_size' => 'int',
        'max_tx_size' => 'int',
        'max_block_header_size' => 'int',
        'key_deposit' => 'string',
        'pool_deposit' => 'string',
        'e_max' => 'int',
        'n_opt' => 'int',
        'a0' => 'float',
        'rho' => 'float',
        'tau' => 'float',
        'decentralisation_param' => 'float',
        'extra_entropy' => 'object',
        'protocol_major_ver' => 'int',
        'protocol_minor_ver' => 'int',
        'min_utxo' => 'string',
        'min_pool_cost' => 'string',
        'nonce' => 'string',
        'price_mem' => 'float',
        'price_step' => 'float',
        'max_tx_ex_mem' => 'string',
        'max_tx_ex_steps' => 'string',
        'max_block_ex_mem' => 'string',
        'max_block_ex_steps' => 'string',
        'max_val_size' => 'string',
        'collateral_percent' => 'int',
        'max_collateral_inputs' => 'int',
        'coins_per_utxo_word' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'epoch' => null,
        'min_fee_a' => null,
        'min_fee_b' => null,
        'max_block_size' => null,
        'max_tx_size' => null,
        'max_block_header_size' => null,
        'key_deposit' => null,
        'pool_deposit' => null,
        'e_max' => null,
        'n_opt' => null,
        'a0' => null,
        'rho' => null,
        'tau' => null,
        'decentralisation_param' => null,
        'extra_entropy' => null,
        'protocol_major_ver' => null,
        'protocol_minor_ver' => null,
        'min_utxo' => null,
        'min_pool_cost' => null,
        'nonce' => null,
        'price_mem' => null,
        'price_step' => null,
        'max_tx_ex_mem' => null,
        'max_tx_ex_steps' => null,
        'max_block_ex_mem' => null,
        'max_block_ex_steps' => null,
        'max_val_size' => null,
        'collateral_percent' => null,
        'max_collateral_inputs' => null,
        'coins_per_utxo_word' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'epoch' => 'epoch',
        'min_fee_a' => 'min_fee_a',
        'min_fee_b' => 'min_fee_b',
        'max_block_size' => 'max_block_size',
        'max_tx_size' => 'max_tx_size',
        'max_block_header_size' => 'max_block_header_size',
        'key_deposit' => 'key_deposit',
        'pool_deposit' => 'pool_deposit',
        'e_max' => 'e_max',
        'n_opt' => 'n_opt',
        'a0' => 'a0',
        'rho' => 'rho',
        'tau' => 'tau',
        'decentralisation_param' => 'decentralisation_param',
        'extra_entropy' => 'extra_entropy',
        'protocol_major_ver' => 'protocol_major_ver',
        'protocol_minor_ver' => 'protocol_minor_ver',
        'min_utxo' => 'min_utxo',
        'min_pool_cost' => 'min_pool_cost',
        'nonce' => 'nonce',
        'price_mem' => 'price_mem',
        'price_step' => 'price_step',
        'max_tx_ex_mem' => 'max_tx_ex_mem',
        'max_tx_ex_steps' => 'max_tx_ex_steps',
        'max_block_ex_mem' => 'max_block_ex_mem',
        'max_block_ex_steps' => 'max_block_ex_steps',
        'max_val_size' => 'max_val_size',
        'collateral_percent' => 'collateral_percent',
        'max_collateral_inputs' => 'max_collateral_inputs',
        'coins_per_utxo_word' => 'coins_per_utxo_word'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'epoch' => 'setEpoch',
        'min_fee_a' => 'setMinFeeA',
        'min_fee_b' => 'setMinFeeB',
        'max_block_size' => 'setMaxBlockSize',
        'max_tx_size' => 'setMaxTxSize',
        'max_block_header_size' => 'setMaxBlockHeaderSize',
        'key_deposit' => 'setKeyDeposit',
        'pool_deposit' => 'setPoolDeposit',
        'e_max' => 'setEMax',
        'n_opt' => 'setNOpt',
        'a0' => 'setA0',
        'rho' => 'setRho',
        'tau' => 'setTau',
        'decentralisation_param' => 'setDecentralisationParam',
        'extra_entropy' => 'setExtraEntropy',
        'protocol_major_ver' => 'setProtocolMajorVer',
        'protocol_minor_ver' => 'setProtocolMinorVer',
        'min_utxo' => 'setMinUtxo',
        'min_pool_cost' => 'setMinPoolCost',
        'nonce' => 'setNonce',
        'price_mem' => 'setPriceMem',
        'price_step' => 'setPriceStep',
        'max_tx_ex_mem' => 'setMaxTxExMem',
        'max_tx_ex_steps' => 'setMaxTxExSteps',
        'max_block_ex_mem' => 'setMaxBlockExMem',
        'max_block_ex_steps' => 'setMaxBlockExSteps',
        'max_val_size' => 'setMaxValSize',
        'collateral_percent' => 'setCollateralPercent',
        'max_collateral_inputs' => 'setMaxCollateralInputs',
        'coins_per_utxo_word' => 'setCoinsPerUtxoWord'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'epoch' => 'getEpoch',
        'min_fee_a' => 'getMinFeeA',
        'min_fee_b' => 'getMinFeeB',
        'max_block_size' => 'getMaxBlockSize',
        'max_tx_size' => 'getMaxTxSize',
        'max_block_header_size' => 'getMaxBlockHeaderSize',
        'key_deposit' => 'getKeyDeposit',
        'pool_deposit' => 'getPoolDeposit',
        'e_max' => 'getEMax',
        'n_opt' => 'getNOpt',
        'a0' => 'getA0',
        'rho' => 'getRho',
        'tau' => 'getTau',
        'decentralisation_param' => 'getDecentralisationParam',
        'extra_entropy' => 'getExtraEntropy',
        'protocol_major_ver' => 'getProtocolMajorVer',
        'protocol_minor_ver' => 'getProtocolMinorVer',
        'min_utxo' => 'getMinUtxo',
        'min_pool_cost' => 'getMinPoolCost',
        'nonce' => 'getNonce',
        'price_mem' => 'getPriceMem',
        'price_step' => 'getPriceStep',
        'max_tx_ex_mem' => 'getMaxTxExMem',
        'max_tx_ex_steps' => 'getMaxTxExSteps',
        'max_block_ex_mem' => 'getMaxBlockExMem',
        'max_block_ex_steps' => 'getMaxBlockExSteps',
        'max_val_size' => 'getMaxValSize',
        'collateral_percent' => 'getCollateralPercent',
        'max_collateral_inputs' => 'getMaxCollateralInputs',
        'coins_per_utxo_word' => 'getCoinsPerUtxoWord'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['epoch'] = $data['epoch'] ?? null;
        $this->container['min_fee_a'] = $data['min_fee_a'] ?? null;
        $this->container['min_fee_b'] = $data['min_fee_b'] ?? null;
        $this->container['max_block_size'] = $data['max_block_size'] ?? null;
        $this->container['max_tx_size'] = $data['max_tx_size'] ?? null;
        $this->container['max_block_header_size'] = $data['max_block_header_size'] ?? null;
        $this->container['key_deposit'] = $data['key_deposit'] ?? null;
        $this->container['pool_deposit'] = $data['pool_deposit'] ?? null;
        $this->container['e_max'] = $data['e_max'] ?? null;
        $this->container['n_opt'] = $data['n_opt'] ?? null;
        $this->container['a0'] = $data['a0'] ?? null;
        $this->container['rho'] = $data['rho'] ?? null;
        $this->container['tau'] = $data['tau'] ?? null;
        $this->container['decentralisation_param'] = $data['decentralisation_param'] ?? null;
        $this->container['extra_entropy'] = $data['extra_entropy'] ?? null;
        $this->container['protocol_major_ver'] = $data['protocol_major_ver'] ?? null;
        $this->container['protocol_minor_ver'] = $data['protocol_minor_ver'] ?? null;
        $this->container['min_utxo'] = $data['min_utxo'] ?? null;
        $this->container['min_pool_cost'] = $data['min_pool_cost'] ?? null;
        $this->container['nonce'] = $data['nonce'] ?? null;
        $this->container['price_mem'] = $data['price_mem'] ?? null;
        $this->container['price_step'] = $data['price_step'] ?? null;
        $this->container['max_tx_ex_mem'] = $data['max_tx_ex_mem'] ?? null;
        $this->container['max_tx_ex_steps'] = $data['max_tx_ex_steps'] ?? null;
        $this->container['max_block_ex_mem'] = $data['max_block_ex_mem'] ?? null;
        $this->container['max_block_ex_steps'] = $data['max_block_ex_steps'] ?? null;
        $this->container['max_val_size'] = $data['max_val_size'] ?? null;
        $this->container['collateral_percent'] = $data['collateral_percent'] ?? null;
        $this->container['max_collateral_inputs'] = $data['max_collateral_inputs'] ?? null;
        $this->container['coins_per_utxo_word'] = $data['coins_per_utxo_word'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['epoch'] === null) {
            $invalidProperties[] = "'epoch' can't be null";
        }
        if ($this->container['min_fee_a'] === null) {
            $invalidProperties[] = "'min_fee_a' can't be null";
        }
        if ($this->container['min_fee_b'] === null) {
            $invalidProperties[] = "'min_fee_b' can't be null";
        }
        if ($this->container['max_block_size'] === null) {
            $invalidProperties[] = "'max_block_size' can't be null";
        }
        if ($this->container['max_tx_size'] === null) {
            $invalidProperties[] = "'max_tx_size' can't be null";
        }
        if ($this->container['max_block_header_size'] === null) {
            $invalidProperties[] = "'max_block_header_size' can't be null";
        }
        if ($this->container['key_deposit'] === null) {
            $invalidProperties[] = "'key_deposit' can't be null";
        }
        if ($this->container['pool_deposit'] === null) {
            $invalidProperties[] = "'pool_deposit' can't be null";
        }
        if ($this->container['e_max'] === null) {
            $invalidProperties[] = "'e_max' can't be null";
        }
        if ($this->container['n_opt'] === null) {
            $invalidProperties[] = "'n_opt' can't be null";
        }
        if ($this->container['a0'] === null) {
            $invalidProperties[] = "'a0' can't be null";
        }
        if ($this->container['rho'] === null) {
            $invalidProperties[] = "'rho' can't be null";
        }
        if ($this->container['tau'] === null) {
            $invalidProperties[] = "'tau' can't be null";
        }
        if ($this->container['decentralisation_param'] === null) {
            $invalidProperties[] = "'decentralisation_param' can't be null";
        }
        if ($this->container['extra_entropy'] === null) {
            $invalidProperties[] = "'extra_entropy' can't be null";
        }
        if ($this->container['protocol_major_ver'] === null) {
            $invalidProperties[] = "'protocol_major_ver' can't be null";
        }
        if ($this->container['protocol_minor_ver'] === null) {
            $invalidProperties[] = "'protocol_minor_ver' can't be null";
        }
        if ($this->container['min_utxo'] === null) {
            $invalidProperties[] = "'min_utxo' can't be null";
        }
        if ($this->container['min_pool_cost'] === null) {
            $invalidProperties[] = "'min_pool_cost' can't be null";
        }
        if ($this->container['nonce'] === null) {
            $invalidProperties[] = "'nonce' can't be null";
        }
        if ($this->container['price_mem'] === null) {
            $invalidProperties[] = "'price_mem' can't be null";
        }
        if ($this->container['price_step'] === null) {
            $invalidProperties[] = "'price_step' can't be null";
        }
        if ($this->container['max_tx_ex_mem'] === null) {
            $invalidProperties[] = "'max_tx_ex_mem' can't be null";
        }
        if ($this->container['max_tx_ex_steps'] === null) {
            $invalidProperties[] = "'max_tx_ex_steps' can't be null";
        }
        if ($this->container['max_block_ex_mem'] === null) {
            $invalidProperties[] = "'max_block_ex_mem' can't be null";
        }
        if ($this->container['max_block_ex_steps'] === null) {
            $invalidProperties[] = "'max_block_ex_steps' can't be null";
        }
        if ($this->container['max_val_size'] === null) {
            $invalidProperties[] = "'max_val_size' can't be null";
        }
        if ($this->container['collateral_percent'] === null) {
            $invalidProperties[] = "'collateral_percent' can't be null";
        }
        if ($this->container['max_collateral_inputs'] === null) {
            $invalidProperties[] = "'max_collateral_inputs' can't be null";
        }
        if ($this->container['coins_per_utxo_word'] === null) {
            $invalidProperties[] = "'coins_per_utxo_word' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets epoch
     *
     * @return int
     */
    public function getEpoch()
    {
        return $this->container['epoch'];
    }

    /**
     * Sets epoch
     *
     * @param int $epoch Epoch number
     *
     * @return self
     */
    public function setEpoch($epoch)
    {
        $this->container['epoch'] = $epoch;

        return $this;
    }

    /**
     * Gets min_fee_a
     *
     * @return int
     */
    public function getMinFeeA()
    {
        return $this->container['min_fee_a'];
    }

    /**
     * Sets min_fee_a
     *
     * @param int $min_fee_a The linear factor for the minimum fee calculation for given epoch
     *
     * @return self
     */
    public function setMinFeeA($min_fee_a)
    {
        $this->container['min_fee_a'] = $min_fee_a;

        return $this;
    }

    /**
     * Gets min_fee_b
     *
     * @return int
     */
    public function getMinFeeB()
    {
        return $this->container['min_fee_b'];
    }

    /**
     * Sets min_fee_b
     *
     * @param int $min_fee_b The constant factor for the minimum fee calculation
     *
     * @return self
     */
    public function setMinFeeB($min_fee_b)
    {
        $this->container['min_fee_b'] = $min_fee_b;

        return $this;
    }

    /**
     * Gets max_block_size
     *
     * @return int
     */
    public function getMaxBlockSize()
    {
        return $this->container['max_block_size'];
    }

    /**
     * Sets max_block_size
     *
     * @param int $max_block_size Maximum block body size in Bytes
     *
     * @return self
     */
    public function setMaxBlockSize($max_block_size)
    {
        $this->container['max_block_size'] = $max_block_size;

        return $this;
    }

    /**
     * Gets max_tx_size
     *
     * @return int
     */
    public function getMaxTxSize()
    {
        return $this->container['max_tx_size'];
    }

    /**
     * Sets max_tx_size
     *
     * @param int $max_tx_size Maximum transaction size
     *
     * @return self
     */
    public function setMaxTxSize($max_tx_size)
    {
        $this->container['max_tx_size'] = $max_tx_size;

        return $this;
    }

    /**
     * Gets max_block_header_size
     *
     * @return int
     */
    public function getMaxBlockHeaderSize()
    {
        return $this->container['max_block_header_size'];
    }

    /**
     * Sets max_block_header_size
     *
     * @param int $max_block_header_size Maximum block header size
     *
     * @return self
     */
    public function setMaxBlockHeaderSize($max_block_header_size)
    {
        $this->container['max_block_header_size'] = $max_block_header_size;

        return $this;
    }

    /**
     * Gets key_deposit
     *
     * @return string
     */
    public function getKeyDeposit()
    {
        return $this->container['key_deposit'];
    }

    /**
     * Sets key_deposit
     *
     * @param string $key_deposit The amount of a key registration deposit in Lovelaces
     *
     * @return self
     */
    public function setKeyDeposit($key_deposit)
    {
        $this->container['key_deposit'] = $key_deposit;

        return $this;
    }

    /**
     * Gets pool_deposit
     *
     * @return string
     */
    public function getPoolDeposit()
    {
        return $this->container['pool_deposit'];
    }

    /**
     * Sets pool_deposit
     *
     * @param string $pool_deposit The amount of a pool registration deposit in Lovelaces
     *
     * @return self
     */
    public function setPoolDeposit($pool_deposit)
    {
        $this->container['pool_deposit'] = $pool_deposit;

        return $this;
    }

    /**
     * Gets e_max
     *
     * @return int
     */
    public function getEMax()
    {
        return $this->container['e_max'];
    }

    /**
     * Sets e_max
     *
     * @param int $e_max Epoch bound on pool retirement
     *
     * @return self
     */
    public function setEMax($e_max)
    {
        $this->container['e_max'] = $e_max;

        return $this;
    }

    /**
     * Gets n_opt
     *
     * @return int
     */
    public function getNOpt()
    {
        return $this->container['n_opt'];
    }

    /**
     * Sets n_opt
     *
     * @param int $n_opt Desired number of pools
     *
     * @return self
     */
    public function setNOpt($n_opt)
    {
        $this->container['n_opt'] = $n_opt;

        return $this;
    }

    /**
     * Gets a0
     *
     * @return float
     */
    public function getA0()
    {
        return $this->container['a0'];
    }

    /**
     * Sets a0
     *
     * @param float $a0 Pool pledge influence
     *
     * @return self
     */
    public function setA0($a0)
    {
        $this->container['a0'] = $a0;

        return $this;
    }

    /**
     * Gets rho
     *
     * @return float
     */
    public function getRho()
    {
        return $this->container['rho'];
    }

    /**
     * Sets rho
     *
     * @param float $rho Monetary expansion
     *
     * @return self
     */
    public function setRho($rho)
    {
        $this->container['rho'] = $rho;

        return $this;
    }

    /**
     * Gets tau
     *
     * @return float
     */
    public function getTau()
    {
        return $this->container['tau'];
    }

    /**
     * Sets tau
     *
     * @param float $tau Treasury expansion
     *
     * @return self
     */
    public function setTau($tau)
    {
        $this->container['tau'] = $tau;

        return $this;
    }

    /**
     * Gets decentralisation_param
     *
     * @return float
     */
    public function getDecentralisationParam()
    {
        return $this->container['decentralisation_param'];
    }

    /**
     * Sets decentralisation_param
     *
     * @param float $decentralisation_param Percentage of blocks produced by federated nodes
     *
     * @return self
     */
    public function setDecentralisationParam($decentralisation_param)
    {
        $this->container['decentralisation_param'] = $decentralisation_param;

        return $this;
    }

    /**
     * Gets extra_entropy
     *
     * @return object
     */
    public function getExtraEntropy()
    {
        return $this->container['extra_entropy'];
    }

    /**
     * Sets extra_entropy
     *
     * @param object $extra_entropy Seed for extra entropy
     *
     * @return self
     */
    public function setExtraEntropy($extra_entropy)
    {
        $this->container['extra_entropy'] = $extra_entropy;

        return $this;
    }

    /**
     * Gets protocol_major_ver
     *
     * @return int
     */
    public function getProtocolMajorVer()
    {
        return $this->container['protocol_major_ver'];
    }

    /**
     * Sets protocol_major_ver
     *
     * @param int $protocol_major_ver Accepted protocol major version
     *
     * @return self
     */
    public function setProtocolMajorVer($protocol_major_ver)
    {
        $this->container['protocol_major_ver'] = $protocol_major_ver;

        return $this;
    }

    /**
     * Gets protocol_minor_ver
     *
     * @return int
     */
    public function getProtocolMinorVer()
    {
        return $this->container['protocol_minor_ver'];
    }

    /**
     * Sets protocol_minor_ver
     *
     * @param int $protocol_minor_ver Accepted protocol minor version
     *
     * @return self
     */
    public function setProtocolMinorVer($protocol_minor_ver)
    {
        $this->container['protocol_minor_ver'] = $protocol_minor_ver;

        return $this;
    }

    /**
     * Gets min_utxo
     *
     * @return string
     */
    public function getMinUtxo()
    {
        return $this->container['min_utxo'];
    }

    /**
     * Sets min_utxo
     *
     * @param string $min_utxo Minimum UTXO value
     *
     * @return self
     */
    public function setMinUtxo($min_utxo)
    {
        $this->container['min_utxo'] = $min_utxo;

        return $this;
    }

    /**
     * Gets min_pool_cost
     *
     * @return string
     */
    public function getMinPoolCost()
    {
        return $this->container['min_pool_cost'];
    }

    /**
     * Sets min_pool_cost
     *
     * @param string $min_pool_cost Minimum stake cost forced on the pool
     *
     * @return self
     */
    public function setMinPoolCost($min_pool_cost)
    {
        $this->container['min_pool_cost'] = $min_pool_cost;

        return $this;
    }

    /**
     * Gets nonce
     *
     * @return string
     */
    public function getNonce()
    {
        return $this->container['nonce'];
    }

    /**
     * Sets nonce
     *
     * @param string $nonce Epoch number only used once
     *
     * @return self
     */
    public function setNonce($nonce)
    {
        $this->container['nonce'] = $nonce;

        return $this;
    }

    /**
     * Gets price_mem
     *
     * @return float
     */
    public function getPriceMem()
    {
        return $this->container['price_mem'];
    }

    /**
     * Sets price_mem
     *
     * @param float $price_mem The per word cost of script memory usage
     *
     * @return self
     */
    public function setPriceMem($price_mem)
    {
        $this->container['price_mem'] = $price_mem;

        return $this;
    }

    /**
     * Gets price_step
     *
     * @return float
     */
    public function getPriceStep()
    {
        return $this->container['price_step'];
    }

    /**
     * Sets price_step
     *
     * @param float $price_step The cost of script execution step usage
     *
     * @return self
     */
    public function setPriceStep($price_step)
    {
        $this->container['price_step'] = $price_step;

        return $this;
    }

    /**
     * Gets max_tx_ex_mem
     *
     * @return string
     */
    public function getMaxTxExMem()
    {
        return $this->container['max_tx_ex_mem'];
    }

    /**
     * Sets max_tx_ex_mem
     *
     * @param string $max_tx_ex_mem The maximum number of execution memory allowed to be used in a single transaction
     *
     * @return self
     */
    public function setMaxTxExMem($max_tx_ex_mem)
    {
        $this->container['max_tx_ex_mem'] = $max_tx_ex_mem;

        return $this;
    }

    /**
     * Gets max_tx_ex_steps
     *
     * @return string
     */
    public function getMaxTxExSteps()
    {
        return $this->container['max_tx_ex_steps'];
    }

    /**
     * Sets max_tx_ex_steps
     *
     * @param string $max_tx_ex_steps The maximum number of execution steps allowed to be used in a single transaction
     *
     * @return self
     */
    public function setMaxTxExSteps($max_tx_ex_steps)
    {
        $this->container['max_tx_ex_steps'] = $max_tx_ex_steps;

        return $this;
    }

    /**
     * Gets max_block_ex_mem
     *
     * @return string
     */
    public function getMaxBlockExMem()
    {
        return $this->container['max_block_ex_mem'];
    }

    /**
     * Sets max_block_ex_mem
     *
     * @param string $max_block_ex_mem The maximum number of execution memory allowed to be used in a single block
     *
     * @return self
     */
    public function setMaxBlockExMem($max_block_ex_mem)
    {
        $this->container['max_block_ex_mem'] = $max_block_ex_mem;

        return $this;
    }

    /**
     * Gets max_block_ex_steps
     *
     * @return string
     */
    public function getMaxBlockExSteps()
    {
        return $this->container['max_block_ex_steps'];
    }

    /**
     * Sets max_block_ex_steps
     *
     * @param string $max_block_ex_steps The maximum number of execution steps allowed to be used in a single block
     *
     * @return self
     */
    public function setMaxBlockExSteps($max_block_ex_steps)
    {
        $this->container['max_block_ex_steps'] = $max_block_ex_steps;

        return $this;
    }

    /**
     * Gets max_val_size
     *
     * @return string
     */
    public function getMaxValSize()
    {
        return $this->container['max_val_size'];
    }

    /**
     * Sets max_val_size
     *
     * @param string $max_val_size The maximum Val size
     *
     * @return self
     */
    public function setMaxValSize($max_val_size)
    {
        $this->container['max_val_size'] = $max_val_size;

        return $this;
    }

    /**
     * Gets collateral_percent
     *
     * @return int
     */
    public function getCollateralPercent()
    {
        return $this->container['collateral_percent'];
    }

    /**
     * Sets collateral_percent
     *
     * @param int $collateral_percent The percentage of the transactions fee which must be provided as collateral when including non-native scripts
     *
     * @return self
     */
    public function setCollateralPercent($collateral_percent)
    {
        $this->container['collateral_percent'] = $collateral_percent;

        return $this;
    }

    /**
     * Gets max_collateral_inputs
     *
     * @return int
     */
    public function getMaxCollateralInputs()
    {
        return $this->container['max_collateral_inputs'];
    }

    /**
     * Sets max_collateral_inputs
     *
     * @param int $max_collateral_inputs The maximum number of collateral inputs allowed in a transaction
     *
     * @return self
     */
    public function setMaxCollateralInputs($max_collateral_inputs)
    {
        $this->container['max_collateral_inputs'] = $max_collateral_inputs;

        return $this;
    }

    /**
     * Gets coins_per_utxo_word
     *
     * @return string
     */
    public function getCoinsPerUtxoWord()
    {
        return $this->container['coins_per_utxo_word'];
    }

    /**
     * Sets coins_per_utxo_word
     *
     * @param string $coins_per_utxo_word The cost per UTxO word
     *
     * @return self
     */
    public function setCoinsPerUtxoWord($coins_per_utxo_word)
    {
        $this->container['coins_per_utxo_word'] = $coins_per_utxo_word;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


