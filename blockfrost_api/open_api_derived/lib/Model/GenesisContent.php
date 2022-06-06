<?php
/**
 * GenesisContent
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
 * GenesisContent Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class GenesisContent implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'genesis_content';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'active_slots_coefficient' => 'float',
        'update_quorum' => 'int',
        'max_lovelace_supply' => 'string',
        'network_magic' => 'int',
        'epoch_length' => 'int',
        'system_start' => 'int',
        'slots_per_kes_period' => 'int',
        'slot_length' => 'int',
        'max_kes_evolutions' => 'int',
        'security_param' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'active_slots_coefficient' => null,
        'update_quorum' => null,
        'max_lovelace_supply' => null,
        'network_magic' => null,
        'epoch_length' => null,
        'system_start' => null,
        'slots_per_kes_period' => null,
        'slot_length' => null,
        'max_kes_evolutions' => null,
        'security_param' => null
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
        'active_slots_coefficient' => 'active_slots_coefficient',
        'update_quorum' => 'update_quorum',
        'max_lovelace_supply' => 'max_lovelace_supply',
        'network_magic' => 'network_magic',
        'epoch_length' => 'epoch_length',
        'system_start' => 'system_start',
        'slots_per_kes_period' => 'slots_per_kes_period',
        'slot_length' => 'slot_length',
        'max_kes_evolutions' => 'max_kes_evolutions',
        'security_param' => 'security_param'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'active_slots_coefficient' => 'setActiveSlotsCoefficient',
        'update_quorum' => 'setUpdateQuorum',
        'max_lovelace_supply' => 'setMaxLovelaceSupply',
        'network_magic' => 'setNetworkMagic',
        'epoch_length' => 'setEpochLength',
        'system_start' => 'setSystemStart',
        'slots_per_kes_period' => 'setSlotsPerKesPeriod',
        'slot_length' => 'setSlotLength',
        'max_kes_evolutions' => 'setMaxKesEvolutions',
        'security_param' => 'setSecurityParam'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'active_slots_coefficient' => 'getActiveSlotsCoefficient',
        'update_quorum' => 'getUpdateQuorum',
        'max_lovelace_supply' => 'getMaxLovelaceSupply',
        'network_magic' => 'getNetworkMagic',
        'epoch_length' => 'getEpochLength',
        'system_start' => 'getSystemStart',
        'slots_per_kes_period' => 'getSlotsPerKesPeriod',
        'slot_length' => 'getSlotLength',
        'max_kes_evolutions' => 'getMaxKesEvolutions',
        'security_param' => 'getSecurityParam'
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
        $this->container['active_slots_coefficient'] = $data['active_slots_coefficient'] ?? null;
        $this->container['update_quorum'] = $data['update_quorum'] ?? null;
        $this->container['max_lovelace_supply'] = $data['max_lovelace_supply'] ?? null;
        $this->container['network_magic'] = $data['network_magic'] ?? null;
        $this->container['epoch_length'] = $data['epoch_length'] ?? null;
        $this->container['system_start'] = $data['system_start'] ?? null;
        $this->container['slots_per_kes_period'] = $data['slots_per_kes_period'] ?? null;
        $this->container['slot_length'] = $data['slot_length'] ?? null;
        $this->container['max_kes_evolutions'] = $data['max_kes_evolutions'] ?? null;
        $this->container['security_param'] = $data['security_param'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['active_slots_coefficient'] === null) {
            $invalidProperties[] = "'active_slots_coefficient' can't be null";
        }
        if ($this->container['update_quorum'] === null) {
            $invalidProperties[] = "'update_quorum' can't be null";
        }
        if ($this->container['max_lovelace_supply'] === null) {
            $invalidProperties[] = "'max_lovelace_supply' can't be null";
        }
        if ($this->container['network_magic'] === null) {
            $invalidProperties[] = "'network_magic' can't be null";
        }
        if ($this->container['epoch_length'] === null) {
            $invalidProperties[] = "'epoch_length' can't be null";
        }
        if ($this->container['system_start'] === null) {
            $invalidProperties[] = "'system_start' can't be null";
        }
        if ($this->container['slots_per_kes_period'] === null) {
            $invalidProperties[] = "'slots_per_kes_period' can't be null";
        }
        if ($this->container['slot_length'] === null) {
            $invalidProperties[] = "'slot_length' can't be null";
        }
        if ($this->container['max_kes_evolutions'] === null) {
            $invalidProperties[] = "'max_kes_evolutions' can't be null";
        }
        if ($this->container['security_param'] === null) {
            $invalidProperties[] = "'security_param' can't be null";
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
     * Gets active_slots_coefficient
     *
     * @return float
     */
    public function getActiveSlotsCoefficient()
    {
        return $this->container['active_slots_coefficient'];
    }

    /**
     * Sets active_slots_coefficient
     *
     * @param float $active_slots_coefficient The proportion of slots in which blocks should be issued
     *
     * @return self
     */
    public function setActiveSlotsCoefficient($active_slots_coefficient)
    {
        $this->container['active_slots_coefficient'] = $active_slots_coefficient;

        return $this;
    }

    /**
     * Gets update_quorum
     *
     * @return int
     */
    public function getUpdateQuorum()
    {
        return $this->container['update_quorum'];
    }

    /**
     * Sets update_quorum
     *
     * @param int $update_quorum Determines the quorum needed for votes on the protocol parameter updates
     *
     * @return self
     */
    public function setUpdateQuorum($update_quorum)
    {
        $this->container['update_quorum'] = $update_quorum;

        return $this;
    }

    /**
     * Gets max_lovelace_supply
     *
     * @return string
     */
    public function getMaxLovelaceSupply()
    {
        return $this->container['max_lovelace_supply'];
    }

    /**
     * Sets max_lovelace_supply
     *
     * @param string $max_lovelace_supply The total number of lovelace in the system
     *
     * @return self
     */
    public function setMaxLovelaceSupply($max_lovelace_supply)
    {
        $this->container['max_lovelace_supply'] = $max_lovelace_supply;

        return $this;
    }

    /**
     * Gets network_magic
     *
     * @return int
     */
    public function getNetworkMagic()
    {
        return $this->container['network_magic'];
    }

    /**
     * Sets network_magic
     *
     * @param int $network_magic Network identifier
     *
     * @return self
     */
    public function setNetworkMagic($network_magic)
    {
        $this->container['network_magic'] = $network_magic;

        return $this;
    }

    /**
     * Gets epoch_length
     *
     * @return int
     */
    public function getEpochLength()
    {
        return $this->container['epoch_length'];
    }

    /**
     * Sets epoch_length
     *
     * @param int $epoch_length Number of slots in an epoch
     *
     * @return self
     */
    public function setEpochLength($epoch_length)
    {
        $this->container['epoch_length'] = $epoch_length;

        return $this;
    }

    /**
     * Gets system_start
     *
     * @return int
     */
    public function getSystemStart()
    {
        return $this->container['system_start'];
    }

    /**
     * Sets system_start
     *
     * @param int $system_start Time of slot 0 in UNIX time
     *
     * @return self
     */
    public function setSystemStart($system_start)
    {
        $this->container['system_start'] = $system_start;

        return $this;
    }

    /**
     * Gets slots_per_kes_period
     *
     * @return int
     */
    public function getSlotsPerKesPeriod()
    {
        return $this->container['slots_per_kes_period'];
    }

    /**
     * Sets slots_per_kes_period
     *
     * @param int $slots_per_kes_period Number of slots in an KES period
     *
     * @return self
     */
    public function setSlotsPerKesPeriod($slots_per_kes_period)
    {
        $this->container['slots_per_kes_period'] = $slots_per_kes_period;

        return $this;
    }

    /**
     * Gets slot_length
     *
     * @return int
     */
    public function getSlotLength()
    {
        return $this->container['slot_length'];
    }

    /**
     * Sets slot_length
     *
     * @param int $slot_length Duration of one slot in seconds
     *
     * @return self
     */
    public function setSlotLength($slot_length)
    {
        $this->container['slot_length'] = $slot_length;

        return $this;
    }

    /**
     * Gets max_kes_evolutions
     *
     * @return int
     */
    public function getMaxKesEvolutions()
    {
        return $this->container['max_kes_evolutions'];
    }

    /**
     * Sets max_kes_evolutions
     *
     * @param int $max_kes_evolutions The maximum number of time a KES key can be evolved before a pool operator must create a new operational certificate
     *
     * @return self
     */
    public function setMaxKesEvolutions($max_kes_evolutions)
    {
        $this->container['max_kes_evolutions'] = $max_kes_evolutions;

        return $this;
    }

    /**
     * Gets security_param
     *
     * @return int
     */
    public function getSecurityParam()
    {
        return $this->container['security_param'];
    }

    /**
     * Sets security_param
     *
     * @param int $security_param Security parameter k
     *
     * @return self
     */
    public function setSecurityParam($security_param)
    {
        $this->container['security_param'] = $security_param;

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


