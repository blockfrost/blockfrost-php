<?php
/**
 * Pool
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
 * Pool Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Pool implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'pool';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'pool_id' => 'string',
        'hex' => 'string',
        'vrf_key' => 'string',
        'blocks_minted' => 'int',
        'blocks_epoch' => 'int',
        'live_stake' => 'string',
        'live_size' => 'float',
        'live_saturation' => 'float',
        'live_delegators' => 'float',
        'active_stake' => 'string',
        'active_size' => 'float',
        'declared_pledge' => 'string',
        'live_pledge' => 'string',
        'margin_cost' => 'float',
        'fixed_cost' => 'string',
        'reward_account' => 'string',
        'owners' => 'string[]',
        'registration' => 'string[]',
        'retirement' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'pool_id' => null,
        'hex' => null,
        'vrf_key' => null,
        'blocks_minted' => null,
        'blocks_epoch' => null,
        'live_stake' => null,
        'live_size' => null,
        'live_saturation' => null,
        'live_delegators' => null,
        'active_stake' => null,
        'active_size' => null,
        'declared_pledge' => null,
        'live_pledge' => null,
        'margin_cost' => null,
        'fixed_cost' => null,
        'reward_account' => null,
        'owners' => null,
        'registration' => null,
        'retirement' => null
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
        'pool_id' => 'pool_id',
        'hex' => 'hex',
        'vrf_key' => 'vrf_key',
        'blocks_minted' => 'blocks_minted',
        'blocks_epoch' => 'blocks_epoch',
        'live_stake' => 'live_stake',
        'live_size' => 'live_size',
        'live_saturation' => 'live_saturation',
        'live_delegators' => 'live_delegators',
        'active_stake' => 'active_stake',
        'active_size' => 'active_size',
        'declared_pledge' => 'declared_pledge',
        'live_pledge' => 'live_pledge',
        'margin_cost' => 'margin_cost',
        'fixed_cost' => 'fixed_cost',
        'reward_account' => 'reward_account',
        'owners' => 'owners',
        'registration' => 'registration',
        'retirement' => 'retirement'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'pool_id' => 'setPoolId',
        'hex' => 'setHex',
        'vrf_key' => 'setVrfKey',
        'blocks_minted' => 'setBlocksMinted',
        'blocks_epoch' => 'setBlocksEpoch',
        'live_stake' => 'setLiveStake',
        'live_size' => 'setLiveSize',
        'live_saturation' => 'setLiveSaturation',
        'live_delegators' => 'setLiveDelegators',
        'active_stake' => 'setActiveStake',
        'active_size' => 'setActiveSize',
        'declared_pledge' => 'setDeclaredPledge',
        'live_pledge' => 'setLivePledge',
        'margin_cost' => 'setMarginCost',
        'fixed_cost' => 'setFixedCost',
        'reward_account' => 'setRewardAccount',
        'owners' => 'setOwners',
        'registration' => 'setRegistration',
        'retirement' => 'setRetirement'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'pool_id' => 'getPoolId',
        'hex' => 'getHex',
        'vrf_key' => 'getVrfKey',
        'blocks_minted' => 'getBlocksMinted',
        'blocks_epoch' => 'getBlocksEpoch',
        'live_stake' => 'getLiveStake',
        'live_size' => 'getLiveSize',
        'live_saturation' => 'getLiveSaturation',
        'live_delegators' => 'getLiveDelegators',
        'active_stake' => 'getActiveStake',
        'active_size' => 'getActiveSize',
        'declared_pledge' => 'getDeclaredPledge',
        'live_pledge' => 'getLivePledge',
        'margin_cost' => 'getMarginCost',
        'fixed_cost' => 'getFixedCost',
        'reward_account' => 'getRewardAccount',
        'owners' => 'getOwners',
        'registration' => 'getRegistration',
        'retirement' => 'getRetirement'
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
        $this->container['pool_id'] = $data['pool_id'] ?? null;
        $this->container['hex'] = $data['hex'] ?? null;
        $this->container['vrf_key'] = $data['vrf_key'] ?? null;
        $this->container['blocks_minted'] = $data['blocks_minted'] ?? null;
        $this->container['blocks_epoch'] = $data['blocks_epoch'] ?? null;
        $this->container['live_stake'] = $data['live_stake'] ?? null;
        $this->container['live_size'] = $data['live_size'] ?? null;
        $this->container['live_saturation'] = $data['live_saturation'] ?? null;
        $this->container['live_delegators'] = $data['live_delegators'] ?? null;
        $this->container['active_stake'] = $data['active_stake'] ?? null;
        $this->container['active_size'] = $data['active_size'] ?? null;
        $this->container['declared_pledge'] = $data['declared_pledge'] ?? null;
        $this->container['live_pledge'] = $data['live_pledge'] ?? null;
        $this->container['margin_cost'] = $data['margin_cost'] ?? null;
        $this->container['fixed_cost'] = $data['fixed_cost'] ?? null;
        $this->container['reward_account'] = $data['reward_account'] ?? null;
        $this->container['owners'] = $data['owners'] ?? null;
        $this->container['registration'] = $data['registration'] ?? null;
        $this->container['retirement'] = $data['retirement'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['pool_id'] === null) {
            $invalidProperties[] = "'pool_id' can't be null";
        }
        if ($this->container['hex'] === null) {
            $invalidProperties[] = "'hex' can't be null";
        }
        if ($this->container['vrf_key'] === null) {
            $invalidProperties[] = "'vrf_key' can't be null";
        }
        if ($this->container['blocks_minted'] === null) {
            $invalidProperties[] = "'blocks_minted' can't be null";
        }
        if ($this->container['blocks_epoch'] === null) {
            $invalidProperties[] = "'blocks_epoch' can't be null";
        }
        if ($this->container['live_stake'] === null) {
            $invalidProperties[] = "'live_stake' can't be null";
        }
        if ($this->container['live_size'] === null) {
            $invalidProperties[] = "'live_size' can't be null";
        }
        if ($this->container['live_saturation'] === null) {
            $invalidProperties[] = "'live_saturation' can't be null";
        }
        if ($this->container['live_delegators'] === null) {
            $invalidProperties[] = "'live_delegators' can't be null";
        }
        if ($this->container['active_stake'] === null) {
            $invalidProperties[] = "'active_stake' can't be null";
        }
        if ($this->container['active_size'] === null) {
            $invalidProperties[] = "'active_size' can't be null";
        }
        if ($this->container['declared_pledge'] === null) {
            $invalidProperties[] = "'declared_pledge' can't be null";
        }
        if ($this->container['live_pledge'] === null) {
            $invalidProperties[] = "'live_pledge' can't be null";
        }
        if ($this->container['margin_cost'] === null) {
            $invalidProperties[] = "'margin_cost' can't be null";
        }
        if ($this->container['fixed_cost'] === null) {
            $invalidProperties[] = "'fixed_cost' can't be null";
        }
        if ($this->container['reward_account'] === null) {
            $invalidProperties[] = "'reward_account' can't be null";
        }
        if ($this->container['owners'] === null) {
            $invalidProperties[] = "'owners' can't be null";
        }
        if ($this->container['registration'] === null) {
            $invalidProperties[] = "'registration' can't be null";
        }
        if ($this->container['retirement'] === null) {
            $invalidProperties[] = "'retirement' can't be null";
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
     * Gets pool_id
     *
     * @return string
     */
    public function getPoolId()
    {
        return $this->container['pool_id'];
    }

    /**
     * Sets pool_id
     *
     * @param string $pool_id Bech32 pool ID
     *
     * @return self
     */
    public function setPoolId($pool_id)
    {
        $this->container['pool_id'] = $pool_id;

        return $this;
    }

    /**
     * Gets hex
     *
     * @return string
     */
    public function getHex()
    {
        return $this->container['hex'];
    }

    /**
     * Sets hex
     *
     * @param string $hex Hexadecimal pool ID.
     *
     * @return self
     */
    public function setHex($hex)
    {
        $this->container['hex'] = $hex;

        return $this;
    }

    /**
     * Gets vrf_key
     *
     * @return string
     */
    public function getVrfKey()
    {
        return $this->container['vrf_key'];
    }

    /**
     * Sets vrf_key
     *
     * @param string $vrf_key VRF key hash
     *
     * @return self
     */
    public function setVrfKey($vrf_key)
    {
        $this->container['vrf_key'] = $vrf_key;

        return $this;
    }

    /**
     * Gets blocks_minted
     *
     * @return int
     */
    public function getBlocksMinted()
    {
        return $this->container['blocks_minted'];
    }

    /**
     * Sets blocks_minted
     *
     * @param int $blocks_minted Total minted blocks
     *
     * @return self
     */
    public function setBlocksMinted($blocks_minted)
    {
        $this->container['blocks_minted'] = $blocks_minted;

        return $this;
    }

    /**
     * Gets blocks_epoch
     *
     * @return int
     */
    public function getBlocksEpoch()
    {
        return $this->container['blocks_epoch'];
    }

    /**
     * Sets blocks_epoch
     *
     * @param int $blocks_epoch Number of blocks minted in the current epoch
     *
     * @return self
     */
    public function setBlocksEpoch($blocks_epoch)
    {
        $this->container['blocks_epoch'] = $blocks_epoch;

        return $this;
    }

    /**
     * Gets live_stake
     *
     * @return string
     */
    public function getLiveStake()
    {
        return $this->container['live_stake'];
    }

    /**
     * Sets live_stake
     *
     * @param string $live_stake live_stake
     *
     * @return self
     */
    public function setLiveStake($live_stake)
    {
        $this->container['live_stake'] = $live_stake;

        return $this;
    }

    /**
     * Gets live_size
     *
     * @return float
     */
    public function getLiveSize()
    {
        return $this->container['live_size'];
    }

    /**
     * Sets live_size
     *
     * @param float $live_size live_size
     *
     * @return self
     */
    public function setLiveSize($live_size)
    {
        $this->container['live_size'] = $live_size;

        return $this;
    }

    /**
     * Gets live_saturation
     *
     * @return float
     */
    public function getLiveSaturation()
    {
        return $this->container['live_saturation'];
    }

    /**
     * Sets live_saturation
     *
     * @param float $live_saturation live_saturation
     *
     * @return self
     */
    public function setLiveSaturation($live_saturation)
    {
        $this->container['live_saturation'] = $live_saturation;

        return $this;
    }

    /**
     * Gets live_delegators
     *
     * @return float
     */
    public function getLiveDelegators()
    {
        return $this->container['live_delegators'];
    }

    /**
     * Sets live_delegators
     *
     * @param float $live_delegators live_delegators
     *
     * @return self
     */
    public function setLiveDelegators($live_delegators)
    {
        $this->container['live_delegators'] = $live_delegators;

        return $this;
    }

    /**
     * Gets active_stake
     *
     * @return string
     */
    public function getActiveStake()
    {
        return $this->container['active_stake'];
    }

    /**
     * Sets active_stake
     *
     * @param string $active_stake active_stake
     *
     * @return self
     */
    public function setActiveStake($active_stake)
    {
        $this->container['active_stake'] = $active_stake;

        return $this;
    }

    /**
     * Gets active_size
     *
     * @return float
     */
    public function getActiveSize()
    {
        return $this->container['active_size'];
    }

    /**
     * Sets active_size
     *
     * @param float $active_size active_size
     *
     * @return self
     */
    public function setActiveSize($active_size)
    {
        $this->container['active_size'] = $active_size;

        return $this;
    }

    /**
     * Gets declared_pledge
     *
     * @return string
     */
    public function getDeclaredPledge()
    {
        return $this->container['declared_pledge'];
    }

    /**
     * Sets declared_pledge
     *
     * @param string $declared_pledge Stake pool certificate pledge
     *
     * @return self
     */
    public function setDeclaredPledge($declared_pledge)
    {
        $this->container['declared_pledge'] = $declared_pledge;

        return $this;
    }

    /**
     * Gets live_pledge
     *
     * @return string
     */
    public function getLivePledge()
    {
        return $this->container['live_pledge'];
    }

    /**
     * Sets live_pledge
     *
     * @param string $live_pledge Stake pool current pledge
     *
     * @return self
     */
    public function setLivePledge($live_pledge)
    {
        $this->container['live_pledge'] = $live_pledge;

        return $this;
    }

    /**
     * Gets margin_cost
     *
     * @return float
     */
    public function getMarginCost()
    {
        return $this->container['margin_cost'];
    }

    /**
     * Sets margin_cost
     *
     * @param float $margin_cost Margin tax cost of the stake pool
     *
     * @return self
     */
    public function setMarginCost($margin_cost)
    {
        $this->container['margin_cost'] = $margin_cost;

        return $this;
    }

    /**
     * Gets fixed_cost
     *
     * @return string
     */
    public function getFixedCost()
    {
        return $this->container['fixed_cost'];
    }

    /**
     * Sets fixed_cost
     *
     * @param string $fixed_cost Fixed tax cost of the stake pool
     *
     * @return self
     */
    public function setFixedCost($fixed_cost)
    {
        $this->container['fixed_cost'] = $fixed_cost;

        return $this;
    }

    /**
     * Gets reward_account
     *
     * @return string
     */
    public function getRewardAccount()
    {
        return $this->container['reward_account'];
    }

    /**
     * Sets reward_account
     *
     * @param string $reward_account Bech32 reward account of the stake pool
     *
     * @return self
     */
    public function setRewardAccount($reward_account)
    {
        $this->container['reward_account'] = $reward_account;

        return $this;
    }

    /**
     * Gets owners
     *
     * @return string[]
     */
    public function getOwners()
    {
        return $this->container['owners'];
    }

    /**
     * Sets owners
     *
     * @param string[] $owners owners
     *
     * @return self
     */
    public function setOwners($owners)
    {
        $this->container['owners'] = $owners;

        return $this;
    }

    /**
     * Gets registration
     *
     * @return string[]
     */
    public function getRegistration()
    {
        return $this->container['registration'];
    }

    /**
     * Sets registration
     *
     * @param string[] $registration registration
     *
     * @return self
     */
    public function setRegistration($registration)
    {
        $this->container['registration'] = $registration;

        return $this;
    }

    /**
     * Gets retirement
     *
     * @return string[]
     */
    public function getRetirement()
    {
        return $this->container['retirement'];
    }

    /**
     * Sets retirement
     *
     * @param string[] $retirement retirement
     *
     * @return self
     */
    public function setRetirement($retirement)
    {
        $this->container['retirement'] = $retirement;

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


