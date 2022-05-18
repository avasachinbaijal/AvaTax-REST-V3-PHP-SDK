<?php
/**
 * TenantList
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  Avalara\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/*
 * AvaTax Software Development Kit for PHP
 *
 * (c) 2004-2022 Avalara, Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * foundation
 *
 * Platform foundation consists of services on top of which the Avalara Compliance Cloud platform is built. These services are foundational and provide functionality such as common organization, tenant and user management for the rest of the compliance platform.
 *
 * @category   Avalara client libraries
 * @package    Avalara\SDK\API\IAMDS
 * @author     Sachin Baijal <sachin.baijal@avalara.com>
 * @author     Jonathan Wenger <jonathan.wenger@avalara.com>
 * @copyright  2004-2022 Avalara, Inc.
 * @license    https://www.apache.org/licenses/LICENSE-2.0
 * @version    2.4.34
 * @link       https://github.com/avadev/AvaTax-REST-V3-PHP-SDK

 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Avalara\SDK\Model\IAMDS;

use \ArrayAccess;
use \Avalara\SDK\ObjectSerializer;
use \Avalara\SDK\Model\ModelInterface;
/**
 * TenantList Class Doc Comment
 *
 * @category Class
 * @package  Avalara\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class TenantList implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TenantList';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'recordset_count' => 'int',
        'next_link' => 'string',
        'page_key' => 'string',
        'items' => '\Avalara\SDK\Model\IAMDS\Tenant[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'recordset_count' => null,
        'next_link' => null,
        'page_key' => null,
        'items' => null
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
        'recordset_count' => '@recordsetCount',
        'next_link' => '@nextLink',
        'page_key' => 'pageKey',
        'items' => 'items'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'recordset_count' => 'setRecordsetCount',
        'next_link' => 'setNextLink',
        'page_key' => 'setPageKey',
        'items' => 'setItems'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'recordset_count' => 'getRecordsetCount',
        'next_link' => 'getNextLink',
        'page_key' => 'getPageKey',
        'items' => 'getItems'
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
        $this->container['recordset_count'] = $data['recordset_count'] ?? null;
        $this->container['next_link'] = $data['next_link'] ?? null;
        $this->container['page_key'] = $data['page_key'] ?? null;
        $this->container['items'] = $data['items'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * Gets recordset_count
     *
     * @return int|null
     */
    public function getRecordsetCount()
    {
        return $this->container['recordset_count'];
    }

    /**
     * Sets recordset_count
     *
     * @param int|null $recordset_count recordset_count
     *
     * @return self
     */
    public function setRecordsetCount($recordset_count)
    {
        $this->container['recordset_count'] = $recordset_count;

        return $this;
    }

    /**
     * Gets next_link
     *
     * @return string|null
     */
    public function getNextLink()
    {
        return $this->container['next_link'];
    }

    /**
     * Sets next_link
     *
     * @param string|null $next_link next_link
     *
     * @return self
     */
    public function setNextLink($next_link)
    {
        $this->container['next_link'] = $next_link;

        return $this;
    }

    /**
     * Gets page_key
     *
     * @return string|null
     */
    public function getPageKey()
    {
        return $this->container['page_key'];
    }

    /**
     * Sets page_key
     *
     * @param string|null $page_key page_key
     *
     * @return self
     */
    public function setPageKey($page_key)
    {
        $this->container['page_key'] = $page_key;

        return $this;
    }

    /**
     * Gets items
     *
     * @return \Avalara\SDK\Model\IAMDS\Tenant[]|null
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \Avalara\SDK\Model\IAMDS\Tenant[]|null $items items
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset):bool
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
    public function offsetGet($offset):mixed
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
    public function offsetSet($offset, $value):void
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
    public function offsetUnset($offset):void
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
    public function jsonSerialize():mixed
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString():string
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
    public function toHeaderValue():string
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


