<?php
/**
 * Entitlement
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
 * Entitlement Class Doc Comment
 *
 * @category Class
 * @description Representation of an Entitlement between an Tenant and a System
 * @package  Avalara\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Entitlement implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Entitlement';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'display_name' => 'string',
        'system' => '\Avalara\SDK\Model\IAMDS\Reference',
        'tenant' => '\Avalara\SDK\Model\IAMDS\Reference',
        'active' => 'bool',
        'features' => '\Avalara\SDK\Model\IAMDS\Reference[]',
        'custom_grants' => '\Avalara\SDK\Model\IAMDS\Reference[]',
        'id' => 'string',
        'meta' => '\Avalara\SDK\Model\IAMDS\InstanceMeta',
        'aspects' => '\Avalara\SDK\Model\IAMDS\Aspect[]',
        'tags' => '\Avalara\SDK\Model\IAMDS\Tag[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'display_name' => null,
        'system' => null,
        'tenant' => null,
        'active' => null,
        'features' => null,
        'custom_grants' => null,
        'id' => null,
        'meta' => null,
        'aspects' => null,
        'tags' => null
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
        'display_name' => 'displayName',
        'system' => 'system',
        'tenant' => 'tenant',
        'active' => 'active',
        'features' => 'features',
        'custom_grants' => 'customGrants',
        'id' => 'id',
        'meta' => 'meta',
        'aspects' => 'aspects',
        'tags' => 'tags'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'display_name' => 'setDisplayName',
        'system' => 'setSystem',
        'tenant' => 'setTenant',
        'active' => 'setActive',
        'features' => 'setFeatures',
        'custom_grants' => 'setCustomGrants',
        'id' => 'setId',
        'meta' => 'setMeta',
        'aspects' => 'setAspects',
        'tags' => 'setTags'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'display_name' => 'getDisplayName',
        'system' => 'getSystem',
        'tenant' => 'getTenant',
        'active' => 'getActive',
        'features' => 'getFeatures',
        'custom_grants' => 'getCustomGrants',
        'id' => 'getId',
        'meta' => 'getMeta',
        'aspects' => 'getAspects',
        'tags' => 'getTags'
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
        $this->container['display_name'] = $data['display_name'] ?? null;
        $this->container['system'] = $data['system'] ?? null;
        $this->container['tenant'] = $data['tenant'] ?? null;
        $this->container['active'] = $data['active'] ?? true;
        $this->container['features'] = $data['features'] ?? null;
        $this->container['custom_grants'] = $data['custom_grants'] ?? null;
        $this->container['id'] = $data['id'] ?? null;
        $this->container['meta'] = $data['meta'] ?? null;
        $this->container['aspects'] = $data['aspects'] ?? null;
        $this->container['tags'] = $data['tags'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['system'] === null) {
            $invalidProperties[] = "'system' can't be null";
        }
        if ($this->container['tenant'] === null) {
            $invalidProperties[] = "'tenant' can't be null";
        }
        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
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
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name Name of the entitlement, used for display purposes
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets system
     *
     * @return \Avalara\SDK\Model\IAMDS\Reference
     */
    public function getSystem()
    {
        return $this->container['system'];
    }

    /**
     * Sets system
     *
     * @param \Avalara\SDK\Model\IAMDS\Reference $system system
     *
     * @return self
     */
    public function setSystem($system)
    {
        $this->container['system'] = $system;

        return $this;
    }

    /**
     * Gets tenant
     *
     * @return \Avalara\SDK\Model\IAMDS\Reference
     */
    public function getTenant()
    {
        return $this->container['tenant'];
    }

    /**
     * Sets tenant
     *
     * @param \Avalara\SDK\Model\IAMDS\Reference $tenant tenant
     *
     * @return self
     */
    public function setTenant($tenant)
    {
        $this->container['tenant'] = $tenant;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool|null
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool|null $active Status of the entitlement - active or inactive
     *
     * @return self
     */
    public function setActive($active)
    {
        $this->container['active'] = $active;

        return $this;
    }

    /**
     * Gets features
     *
     * @return \Avalara\SDK\Model\IAMDS\Reference[]|null
     */
    public function getFeatures()
    {
        return $this->container['features'];
    }

    /**
     * Sets features
     *
     * @param \Avalara\SDK\Model\IAMDS\Reference[]|null $features List of features associated with the entitlement
     *
     * @return self
     */
    public function setFeatures($features)
    {
        $this->container['features'] = $features;

        return $this;
    }

    /**
     * Gets custom_grants
     *
     * @return \Avalara\SDK\Model\IAMDS\Reference[]|null
     */
    public function getCustomGrants()
    {
        return $this->container['custom_grants'];
    }

    /**
     * Sets custom_grants
     *
     * @param \Avalara\SDK\Model\IAMDS\Reference[]|null $custom_grants List of custom grants applicable for the entitlement
     *
     * @return self
     */
    public function setCustomGrants($custom_grants)
    {
        $this->container['custom_grants'] = $custom_grants;

        return $this;
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id Unique identifier for the Object
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets meta
     *
     * @return \Avalara\SDK\Model\IAMDS\InstanceMeta|null
     */
    public function getMeta()
    {
        return $this->container['meta'];
    }

    /**
     * Sets meta
     *
     * @param \Avalara\SDK\Model\IAMDS\InstanceMeta|null $meta meta
     *
     * @return self
     */
    public function setMeta($meta)
    {
        $this->container['meta'] = $meta;

        return $this;
    }

    /**
     * Gets aspects
     *
     * @return \Avalara\SDK\Model\IAMDS\Aspect[]|null
     */
    public function getAspects()
    {
        return $this->container['aspects'];
    }

    /**
     * Sets aspects
     *
     * @param \Avalara\SDK\Model\IAMDS\Aspect[]|null $aspects Identifier of the Resource (if any) in other systems
     *
     * @return self
     */
    public function setAspects($aspects)
    {
        $this->container['aspects'] = $aspects;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return \Avalara\SDK\Model\IAMDS\Tag[]|null
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param \Avalara\SDK\Model\IAMDS\Tag[]|null $tags User defined tags in the form of key:value pair
     *
     * @return self
     */
    public function setTags($tags)
    {
        $this->container['tags'] = $tags;

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


