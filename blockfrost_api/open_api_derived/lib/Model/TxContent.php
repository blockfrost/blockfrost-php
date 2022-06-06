<?php
/**
 * TxContent
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
 * TxContent Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class TxContent implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'tx_content';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'hash' => 'string',
        'block' => 'string',
        'block_height' => 'int',
        'block_time' => 'int',
        'slot' => 'int',
        'index' => 'int',
        'output_amount' => '\OpenAPI\Client\Model\TxContentOutputAmountInner[]',
        'fees' => 'string',
        'deposit' => 'string',
        'size' => 'int',
        'invalid_before' => 'string',
        'invalid_hereafter' => 'string',
        'utxo_count' => 'int',
        'withdrawal_count' => 'int',
        'mir_cert_count' => 'int',
        'delegation_count' => 'int',
        'stake_cert_count' => 'int',
        'pool_update_count' => 'int',
        'pool_retire_count' => 'int',
        'asset_mint_or_burn_count' => 'int',
        'redeemer_count' => 'int',
        'valid_contract' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'hash' => null,
        'block' => null,
        'block_height' => null,
        'block_time' => null,
        'slot' => null,
        'index' => null,
        'output_amount' => null,
        'fees' => null,
        'deposit' => null,
        'size' => null,
        'invalid_before' => null,
        'invalid_hereafter' => null,
        'utxo_count' => null,
        'withdrawal_count' => null,
        'mir_cert_count' => null,
        'delegation_count' => null,
        'stake_cert_count' => null,
        'pool_update_count' => null,
        'pool_retire_count' => null,
        'asset_mint_or_burn_count' => null,
        'redeemer_count' => null,
        'valid_contract' => null
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
        'hash' => 'hash',
        'block' => 'block',
        'block_height' => 'block_height',
        'block_time' => 'block_time',
        'slot' => 'slot',
        'index' => 'index',
        'output_amount' => 'output_amount',
        'fees' => 'fees',
        'deposit' => 'deposit',
        'size' => 'size',
        'invalid_before' => 'invalid_before',
        'invalid_hereafter' => 'invalid_hereafter',
        'utxo_count' => 'utxo_count',
        'withdrawal_count' => 'withdrawal_count',
        'mir_cert_count' => 'mir_cert_count',
        'delegation_count' => 'delegation_count',
        'stake_cert_count' => 'stake_cert_count',
        'pool_update_count' => 'pool_update_count',
        'pool_retire_count' => 'pool_retire_count',
        'asset_mint_or_burn_count' => 'asset_mint_or_burn_count',
        'redeemer_count' => 'redeemer_count',
        'valid_contract' => 'valid_contract'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'hash' => 'setHash',
        'block' => 'setBlock',
        'block_height' => 'setBlockHeight',
        'block_time' => 'setBlockTime',
        'slot' => 'setSlot',
        'index' => 'setIndex',
        'output_amount' => 'setOutputAmount',
        'fees' => 'setFees',
        'deposit' => 'setDeposit',
        'size' => 'setSize',
        'invalid_before' => 'setInvalidBefore',
        'invalid_hereafter' => 'setInvalidHereafter',
        'utxo_count' => 'setUtxoCount',
        'withdrawal_count' => 'setWithdrawalCount',
        'mir_cert_count' => 'setMirCertCount',
        'delegation_count' => 'setDelegationCount',
        'stake_cert_count' => 'setStakeCertCount',
        'pool_update_count' => 'setPoolUpdateCount',
        'pool_retire_count' => 'setPoolRetireCount',
        'asset_mint_or_burn_count' => 'setAssetMintOrBurnCount',
        'redeemer_count' => 'setRedeemerCount',
        'valid_contract' => 'setValidContract'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'hash' => 'getHash',
        'block' => 'getBlock',
        'block_height' => 'getBlockHeight',
        'block_time' => 'getBlockTime',
        'slot' => 'getSlot',
        'index' => 'getIndex',
        'output_amount' => 'getOutputAmount',
        'fees' => 'getFees',
        'deposit' => 'getDeposit',
        'size' => 'getSize',
        'invalid_before' => 'getInvalidBefore',
        'invalid_hereafter' => 'getInvalidHereafter',
        'utxo_count' => 'getUtxoCount',
        'withdrawal_count' => 'getWithdrawalCount',
        'mir_cert_count' => 'getMirCertCount',
        'delegation_count' => 'getDelegationCount',
        'stake_cert_count' => 'getStakeCertCount',
        'pool_update_count' => 'getPoolUpdateCount',
        'pool_retire_count' => 'getPoolRetireCount',
        'asset_mint_or_burn_count' => 'getAssetMintOrBurnCount',
        'redeemer_count' => 'getRedeemerCount',
        'valid_contract' => 'getValidContract'
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
        $this->container['hash'] = $data['hash'] ?? null;
        $this->container['block'] = $data['block'] ?? null;
        $this->container['block_height'] = $data['block_height'] ?? null;
        $this->container['block_time'] = $data['block_time'] ?? null;
        $this->container['slot'] = $data['slot'] ?? null;
        $this->container['index'] = $data['index'] ?? null;
        $this->container['output_amount'] = $data['output_amount'] ?? null;
        $this->container['fees'] = $data['fees'] ?? null;
        $this->container['deposit'] = $data['deposit'] ?? null;
        $this->container['size'] = $data['size'] ?? null;
        $this->container['invalid_before'] = $data['invalid_before'] ?? null;
        $this->container['invalid_hereafter'] = $data['invalid_hereafter'] ?? null;
        $this->container['utxo_count'] = $data['utxo_count'] ?? null;
        $this->container['withdrawal_count'] = $data['withdrawal_count'] ?? null;
        $this->container['mir_cert_count'] = $data['mir_cert_count'] ?? null;
        $this->container['delegation_count'] = $data['delegation_count'] ?? null;
        $this->container['stake_cert_count'] = $data['stake_cert_count'] ?? null;
        $this->container['pool_update_count'] = $data['pool_update_count'] ?? null;
        $this->container['pool_retire_count'] = $data['pool_retire_count'] ?? null;
        $this->container['asset_mint_or_burn_count'] = $data['asset_mint_or_burn_count'] ?? null;
        $this->container['redeemer_count'] = $data['redeemer_count'] ?? null;
        $this->container['valid_contract'] = $data['valid_contract'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['hash'] === null) {
            $invalidProperties[] = "'hash' can't be null";
        }
        if ($this->container['block'] === null) {
            $invalidProperties[] = "'block' can't be null";
        }
        if ($this->container['block_height'] === null) {
            $invalidProperties[] = "'block_height' can't be null";
        }
        if ($this->container['block_time'] === null) {
            $invalidProperties[] = "'block_time' can't be null";
        }
        if ($this->container['slot'] === null) {
            $invalidProperties[] = "'slot' can't be null";
        }
        if ($this->container['index'] === null) {
            $invalidProperties[] = "'index' can't be null";
        }
        if ($this->container['output_amount'] === null) {
            $invalidProperties[] = "'output_amount' can't be null";
        }
        if ($this->container['fees'] === null) {
            $invalidProperties[] = "'fees' can't be null";
        }
        if ($this->container['deposit'] === null) {
            $invalidProperties[] = "'deposit' can't be null";
        }
        if ($this->container['size'] === null) {
            $invalidProperties[] = "'size' can't be null";
        }
        if ($this->container['invalid_before'] === null) {
            $invalidProperties[] = "'invalid_before' can't be null";
        }
        if ($this->container['invalid_hereafter'] === null) {
            $invalidProperties[] = "'invalid_hereafter' can't be null";
        }
        if ($this->container['utxo_count'] === null) {
            $invalidProperties[] = "'utxo_count' can't be null";
        }
        if ($this->container['withdrawal_count'] === null) {
            $invalidProperties[] = "'withdrawal_count' can't be null";
        }
        if ($this->container['mir_cert_count'] === null) {
            $invalidProperties[] = "'mir_cert_count' can't be null";
        }
        if ($this->container['delegation_count'] === null) {
            $invalidProperties[] = "'delegation_count' can't be null";
        }
        if ($this->container['stake_cert_count'] === null) {
            $invalidProperties[] = "'stake_cert_count' can't be null";
        }
        if ($this->container['pool_update_count'] === null) {
            $invalidProperties[] = "'pool_update_count' can't be null";
        }
        if ($this->container['pool_retire_count'] === null) {
            $invalidProperties[] = "'pool_retire_count' can't be null";
        }
        if ($this->container['asset_mint_or_burn_count'] === null) {
            $invalidProperties[] = "'asset_mint_or_burn_count' can't be null";
        }
        if ($this->container['redeemer_count'] === null) {
            $invalidProperties[] = "'redeemer_count' can't be null";
        }
        if ($this->container['valid_contract'] === null) {
            $invalidProperties[] = "'valid_contract' can't be null";
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
     * Gets hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->container['hash'];
    }

    /**
     * Sets hash
     *
     * @param string $hash Transaction hash
     *
     * @return self
     */
    public function setHash($hash)
    {
        $this->container['hash'] = $hash;

        return $this;
    }

    /**
     * Gets block
     *
     * @return string
     */
    public function getBlock()
    {
        return $this->container['block'];
    }

    /**
     * Sets block
     *
     * @param string $block Block hash
     *
     * @return self
     */
    public function setBlock($block)
    {
        $this->container['block'] = $block;

        return $this;
    }

    /**
     * Gets block_height
     *
     * @return int
     */
    public function getBlockHeight()
    {
        return $this->container['block_height'];
    }

    /**
     * Sets block_height
     *
     * @param int $block_height Block number
     *
     * @return self
     */
    public function setBlockHeight($block_height)
    {
        $this->container['block_height'] = $block_height;

        return $this;
    }

    /**
     * Gets block_time
     *
     * @return int
     */
    public function getBlockTime()
    {
        return $this->container['block_time'];
    }

    /**
     * Sets block_time
     *
     * @param int $block_time Block creation time in UNIX time
     *
     * @return self
     */
    public function setBlockTime($block_time)
    {
        $this->container['block_time'] = $block_time;

        return $this;
    }

    /**
     * Gets slot
     *
     * @return int
     */
    public function getSlot()
    {
        return $this->container['slot'];
    }

    /**
     * Sets slot
     *
     * @param int $slot Slot number
     *
     * @return self
     */
    public function setSlot($slot)
    {
        $this->container['slot'] = $slot;

        return $this;
    }

    /**
     * Gets index
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->container['index'];
    }

    /**
     * Sets index
     *
     * @param int $index Transaction index within the block
     *
     * @return self
     */
    public function setIndex($index)
    {
        $this->container['index'] = $index;

        return $this;
    }

    /**
     * Gets output_amount
     *
     * @return \OpenAPI\Client\Model\TxContentOutputAmountInner[]
     */
    public function getOutputAmount()
    {
        return $this->container['output_amount'];
    }

    /**
     * Sets output_amount
     *
     * @param \OpenAPI\Client\Model\TxContentOutputAmountInner[] $output_amount output_amount
     *
     * @return self
     */
    public function setOutputAmount($output_amount)
    {
        $this->container['output_amount'] = $output_amount;

        return $this;
    }

    /**
     * Gets fees
     *
     * @return string
     */
    public function getFees()
    {
        return $this->container['fees'];
    }

    /**
     * Sets fees
     *
     * @param string $fees Fees of the transaction in Lovelaces
     *
     * @return self
     */
    public function setFees($fees)
    {
        $this->container['fees'] = $fees;

        return $this;
    }

    /**
     * Gets deposit
     *
     * @return string
     */
    public function getDeposit()
    {
        return $this->container['deposit'];
    }

    /**
     * Sets deposit
     *
     * @param string $deposit Deposit within the transaction in Lovelaces
     *
     * @return self
     */
    public function setDeposit($deposit)
    {
        $this->container['deposit'] = $deposit;

        return $this;
    }

    /**
     * Gets size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->container['size'];
    }

    /**
     * Sets size
     *
     * @param int $size Size of the transaction in Bytes
     *
     * @return self
     */
    public function setSize($size)
    {
        $this->container['size'] = $size;

        return $this;
    }

    /**
     * Gets invalid_before
     *
     * @return string
     */
    public function getInvalidBefore()
    {
        return $this->container['invalid_before'];
    }

    /**
     * Sets invalid_before
     *
     * @param string $invalid_before Left (included) endpoint of the timelock validity intervals
     *
     * @return self
     */
    public function setInvalidBefore($invalid_before)
    {
        $this->container['invalid_before'] = $invalid_before;

        return $this;
    }

    /**
     * Gets invalid_hereafter
     *
     * @return string
     */
    public function getInvalidHereafter()
    {
        return $this->container['invalid_hereafter'];
    }

    /**
     * Sets invalid_hereafter
     *
     * @param string $invalid_hereafter Right (excluded) endpoint of the timelock validity intervals
     *
     * @return self
     */
    public function setInvalidHereafter($invalid_hereafter)
    {
        $this->container['invalid_hereafter'] = $invalid_hereafter;

        return $this;
    }

    /**
     * Gets utxo_count
     *
     * @return int
     */
    public function getUtxoCount()
    {
        return $this->container['utxo_count'];
    }

    /**
     * Sets utxo_count
     *
     * @param int $utxo_count Count of UTXOs within the transaction
     *
     * @return self
     */
    public function setUtxoCount($utxo_count)
    {
        $this->container['utxo_count'] = $utxo_count;

        return $this;
    }

    /**
     * Gets withdrawal_count
     *
     * @return int
     */
    public function getWithdrawalCount()
    {
        return $this->container['withdrawal_count'];
    }

    /**
     * Sets withdrawal_count
     *
     * @param int $withdrawal_count Count of the withdrawals within the transaction
     *
     * @return self
     */
    public function setWithdrawalCount($withdrawal_count)
    {
        $this->container['withdrawal_count'] = $withdrawal_count;

        return $this;
    }

    /**
     * Gets mir_cert_count
     *
     * @return int
     */
    public function getMirCertCount()
    {
        return $this->container['mir_cert_count'];
    }

    /**
     * Sets mir_cert_count
     *
     * @param int $mir_cert_count Count of the MIR certificates within the transaction
     *
     * @return self
     */
    public function setMirCertCount($mir_cert_count)
    {
        $this->container['mir_cert_count'] = $mir_cert_count;

        return $this;
    }

    /**
     * Gets delegation_count
     *
     * @return int
     */
    public function getDelegationCount()
    {
        return $this->container['delegation_count'];
    }

    /**
     * Sets delegation_count
     *
     * @param int $delegation_count Count of the delegations within the transaction
     *
     * @return self
     */
    public function setDelegationCount($delegation_count)
    {
        $this->container['delegation_count'] = $delegation_count;

        return $this;
    }

    /**
     * Gets stake_cert_count
     *
     * @return int
     */
    public function getStakeCertCount()
    {
        return $this->container['stake_cert_count'];
    }

    /**
     * Sets stake_cert_count
     *
     * @param int $stake_cert_count Count of the stake keys (de)registration within the transaction
     *
     * @return self
     */
    public function setStakeCertCount($stake_cert_count)
    {
        $this->container['stake_cert_count'] = $stake_cert_count;

        return $this;
    }

    /**
     * Gets pool_update_count
     *
     * @return int
     */
    public function getPoolUpdateCount()
    {
        return $this->container['pool_update_count'];
    }

    /**
     * Sets pool_update_count
     *
     * @param int $pool_update_count Count of the stake pool registration and update certificates within the transaction
     *
     * @return self
     */
    public function setPoolUpdateCount($pool_update_count)
    {
        $this->container['pool_update_count'] = $pool_update_count;

        return $this;
    }

    /**
     * Gets pool_retire_count
     *
     * @return int
     */
    public function getPoolRetireCount()
    {
        return $this->container['pool_retire_count'];
    }

    /**
     * Sets pool_retire_count
     *
     * @param int $pool_retire_count Count of the stake pool retirement certificates within the transaction
     *
     * @return self
     */
    public function setPoolRetireCount($pool_retire_count)
    {
        $this->container['pool_retire_count'] = $pool_retire_count;

        return $this;
    }

    /**
     * Gets asset_mint_or_burn_count
     *
     * @return int
     */
    public function getAssetMintOrBurnCount()
    {
        return $this->container['asset_mint_or_burn_count'];
    }

    /**
     * Sets asset_mint_or_burn_count
     *
     * @param int $asset_mint_or_burn_count Count of asset mints and burns within the transaction
     *
     * @return self
     */
    public function setAssetMintOrBurnCount($asset_mint_or_burn_count)
    {
        $this->container['asset_mint_or_burn_count'] = $asset_mint_or_burn_count;

        return $this;
    }

    /**
     * Gets redeemer_count
     *
     * @return int
     */
    public function getRedeemerCount()
    {
        return $this->container['redeemer_count'];
    }

    /**
     * Sets redeemer_count
     *
     * @param int $redeemer_count Count of redeemers within the transaction
     *
     * @return self
     */
    public function setRedeemerCount($redeemer_count)
    {
        $this->container['redeemer_count'] = $redeemer_count;

        return $this;
    }

    /**
     * Gets valid_contract
     *
     * @return bool
     */
    public function getValidContract()
    {
        return $this->container['valid_contract'];
    }

    /**
     * Sets valid_contract
     *
     * @param bool $valid_contract True if contract script passed validation
     *
     * @return self
     */
    public function setValidContract($valid_contract)
    {
        $this->container['valid_contract'] = $valid_contract;

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


