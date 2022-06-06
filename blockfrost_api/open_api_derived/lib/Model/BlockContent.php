<?php
/**
 * BlockContent
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
 * BlockContent Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class BlockContent implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'block_content';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'time' => 'int',
        'height' => 'int',
        'hash' => 'string',
        'slot' => 'int',
        'epoch' => 'int',
        'epoch_slot' => 'int',
        'slot_leader' => 'string',
        'size' => 'int',
        'tx_count' => 'int',
        'output' => 'string',
        'fees' => 'string',
        'block_vrf' => 'string',
        'previous_block' => 'string',
        'next_block' => 'string',
        'confirmations' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'time' => null,
        'height' => null,
        'hash' => null,
        'slot' => null,
        'epoch' => null,
        'epoch_slot' => null,
        'slot_leader' => null,
        'size' => null,
        'tx_count' => null,
        'output' => null,
        'fees' => null,
        'block_vrf' => null,
        'previous_block' => null,
        'next_block' => null,
        'confirmations' => null
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
        'time' => 'time',
        'height' => 'height',
        'hash' => 'hash',
        'slot' => 'slot',
        'epoch' => 'epoch',
        'epoch_slot' => 'epoch_slot',
        'slot_leader' => 'slot_leader',
        'size' => 'size',
        'tx_count' => 'tx_count',
        'output' => 'output',
        'fees' => 'fees',
        'block_vrf' => 'block_vrf',
        'previous_block' => 'previous_block',
        'next_block' => 'next_block',
        'confirmations' => 'confirmations'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'time' => 'setTime',
        'height' => 'setHeight',
        'hash' => 'setHash',
        'slot' => 'setSlot',
        'epoch' => 'setEpoch',
        'epoch_slot' => 'setEpochSlot',
        'slot_leader' => 'setSlotLeader',
        'size' => 'setSize',
        'tx_count' => 'setTxCount',
        'output' => 'setOutput',
        'fees' => 'setFees',
        'block_vrf' => 'setBlockVrf',
        'previous_block' => 'setPreviousBlock',
        'next_block' => 'setNextBlock',
        'confirmations' => 'setConfirmations'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'time' => 'getTime',
        'height' => 'getHeight',
        'hash' => 'getHash',
        'slot' => 'getSlot',
        'epoch' => 'getEpoch',
        'epoch_slot' => 'getEpochSlot',
        'slot_leader' => 'getSlotLeader',
        'size' => 'getSize',
        'tx_count' => 'getTxCount',
        'output' => 'getOutput',
        'fees' => 'getFees',
        'block_vrf' => 'getBlockVrf',
        'previous_block' => 'getPreviousBlock',
        'next_block' => 'getNextBlock',
        'confirmations' => 'getConfirmations'
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
        $this->container['time'] = $data['time'] ?? null;
        $this->container['height'] = $data['height'] ?? null;
        $this->container['hash'] = $data['hash'] ?? null;
        $this->container['slot'] = $data['slot'] ?? null;
        $this->container['epoch'] = $data['epoch'] ?? null;
        $this->container['epoch_slot'] = $data['epoch_slot'] ?? null;
        $this->container['slot_leader'] = $data['slot_leader'] ?? null;
        $this->container['size'] = $data['size'] ?? null;
        $this->container['tx_count'] = $data['tx_count'] ?? null;
        $this->container['output'] = $data['output'] ?? null;
        $this->container['fees'] = $data['fees'] ?? null;
        $this->container['block_vrf'] = $data['block_vrf'] ?? null;
        $this->container['previous_block'] = $data['previous_block'] ?? null;
        $this->container['next_block'] = $data['next_block'] ?? null;
        $this->container['confirmations'] = $data['confirmations'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['time'] === null) {
            $invalidProperties[] = "'time' can't be null";
        }
        if ($this->container['height'] === null) {
            $invalidProperties[] = "'height' can't be null";
        }
        if ($this->container['hash'] === null) {
            $invalidProperties[] = "'hash' can't be null";
        }
        if ($this->container['slot'] === null) {
            $invalidProperties[] = "'slot' can't be null";
        }
        if ($this->container['epoch'] === null) {
            $invalidProperties[] = "'epoch' can't be null";
        }
        if ($this->container['epoch_slot'] === null) {
            $invalidProperties[] = "'epoch_slot' can't be null";
        }
        if ($this->container['slot_leader'] === null) {
            $invalidProperties[] = "'slot_leader' can't be null";
        }
        if ($this->container['size'] === null) {
            $invalidProperties[] = "'size' can't be null";
        }
        if ($this->container['tx_count'] === null) {
            $invalidProperties[] = "'tx_count' can't be null";
        }
        if ($this->container['output'] === null) {
            $invalidProperties[] = "'output' can't be null";
        }
        if ($this->container['fees'] === null) {
            $invalidProperties[] = "'fees' can't be null";
        }
        if ($this->container['block_vrf'] === null) {
            $invalidProperties[] = "'block_vrf' can't be null";
        }
        if ((mb_strlen($this->container['block_vrf']) > 65)) {
            $invalidProperties[] = "invalid value for 'block_vrf', the character length must be smaller than or equal to 65.";
        }

        if ((mb_strlen($this->container['block_vrf']) < 65)) {
            $invalidProperties[] = "invalid value for 'block_vrf', the character length must be bigger than or equal to 65.";
        }

        if ($this->container['previous_block'] === null) {
            $invalidProperties[] = "'previous_block' can't be null";
        }
        if ($this->container['next_block'] === null) {
            $invalidProperties[] = "'next_block' can't be null";
        }
        if ($this->container['confirmations'] === null) {
            $invalidProperties[] = "'confirmations' can't be null";
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
     * Gets time
     *
     * @return int
     */
    public function getTime()
    {
        return $this->container['time'];
    }

    /**
     * Sets time
     *
     * @param int $time Block creation time in UNIX time
     *
     * @return self
     */
    public function setTime($time)
    {
        $this->container['time'] = $time;

        return $this;
    }

    /**
     * Gets height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /**
     * Sets height
     *
     * @param int $height Block number
     *
     * @return self
     */
    public function setHeight($height)
    {
        $this->container['height'] = $height;

        return $this;
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
     * @param string $hash Hash of the block
     *
     * @return self
     */
    public function setHash($hash)
    {
        $this->container['hash'] = $hash;

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
     * Gets epoch_slot
     *
     * @return int
     */
    public function getEpochSlot()
    {
        return $this->container['epoch_slot'];
    }

    /**
     * Sets epoch_slot
     *
     * @param int $epoch_slot Slot within the epoch
     *
     * @return self
     */
    public function setEpochSlot($epoch_slot)
    {
        $this->container['epoch_slot'] = $epoch_slot;

        return $this;
    }

    /**
     * Gets slot_leader
     *
     * @return string
     */
    public function getSlotLeader()
    {
        return $this->container['slot_leader'];
    }

    /**
     * Sets slot_leader
     *
     * @param string $slot_leader Bech32 ID of the slot leader or specific block description in case there is no slot leader
     *
     * @return self
     */
    public function setSlotLeader($slot_leader)
    {
        $this->container['slot_leader'] = $slot_leader;

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
     * @param int $size Block size in Bytes
     *
     * @return self
     */
    public function setSize($size)
    {
        $this->container['size'] = $size;

        return $this;
    }

    /**
     * Gets tx_count
     *
     * @return int
     */
    public function getTxCount()
    {
        return $this->container['tx_count'];
    }

    /**
     * Sets tx_count
     *
     * @param int $tx_count Number of transactions in the block
     *
     * @return self
     */
    public function setTxCount($tx_count)
    {
        $this->container['tx_count'] = $tx_count;

        return $this;
    }

    /**
     * Gets output
     *
     * @return string
     */
    public function getOutput()
    {
        return $this->container['output'];
    }

    /**
     * Sets output
     *
     * @param string $output Total output within the block in Lovelaces
     *
     * @return self
     */
    public function setOutput($output)
    {
        $this->container['output'] = $output;

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
     * @param string $fees Total fees within the block in Lovelaces
     *
     * @return self
     */
    public function setFees($fees)
    {
        $this->container['fees'] = $fees;

        return $this;
    }

    /**
     * Gets block_vrf
     *
     * @return string
     */
    public function getBlockVrf()
    {
        return $this->container['block_vrf'];
    }

    /**
     * Sets block_vrf
     *
     * @param string $block_vrf VRF key of the block
     *
     * @return self
     */
    public function setBlockVrf($block_vrf)
    {
        if ((mb_strlen($block_vrf) > 65)) {
            throw new \InvalidArgumentException('invalid length for $block_vrf when calling BlockContent., must be smaller than or equal to 65.');
        }
        if ((mb_strlen($block_vrf) < 65)) {
            throw new \InvalidArgumentException('invalid length for $block_vrf when calling BlockContent., must be bigger than or equal to 65.');
        }

        $this->container['block_vrf'] = $block_vrf;

        return $this;
    }

    /**
     * Gets previous_block
     *
     * @return string
     */
    public function getPreviousBlock()
    {
        return $this->container['previous_block'];
    }

    /**
     * Sets previous_block
     *
     * @param string $previous_block Hash of the previous block
     *
     * @return self
     */
    public function setPreviousBlock($previous_block)
    {
        $this->container['previous_block'] = $previous_block;

        return $this;
    }

    /**
     * Gets next_block
     *
     * @return string
     */
    public function getNextBlock()
    {
        return $this->container['next_block'];
    }

    /**
     * Sets next_block
     *
     * @param string $next_block Hash of the next block
     *
     * @return self
     */
    public function setNextBlock($next_block)
    {
        $this->container['next_block'] = $next_block;

        return $this;
    }

    /**
     * Gets confirmations
     *
     * @return int
     */
    public function getConfirmations()
    {
        return $this->container['confirmations'];
    }

    /**
     * Sets confirmations
     *
     * @param int $confirmations Number of block confirmations
     *
     * @return self
     */
    public function setConfirmations($confirmations)
    {
        $this->container['confirmations'] = $confirmations;

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


