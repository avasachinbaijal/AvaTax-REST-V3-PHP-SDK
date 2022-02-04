<?php
/**
 * ShippingVerifyResult
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
 * Avalara Shipping Verification only
 *
 * API for evaluating transactions against direct-to-consumer Beverage Alcohol shipping regulations.  This API is currently in beta.
 *
 * @category   Avalara client libraries
 * @package    Avalara\SDK\API
 * @author     Sachin Baijal <sachin.baijal@avalara.com>
 * @author     Jonathan Wenger <jonathan.wenger@avalara.com>
 * @copyright  2004-2022 Avalara, Inc.
 * @license    https://www.apache.org/licenses/LICENSE-2.0
 * @version    2.4.12
 * @link       https://github.com/avadev/AvaTax-REST-V3-PHP-SDK

 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Avalara\SDK\Model;

use \ArrayAccess;
use \Avalara\SDK\ObjectSerializer;

/**
 * ShippingVerifyResult Class Doc Comment
 *
 * @category Class
 * @description The Response of the /shippingverify endpoint. Describes the result of checking all applicable shipping rules against each line in the transaction.
 * @package  Avalara\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ShippingVerifyResult implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ShippingVerifyResult';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'compliant' => 'bool',
        'message' => 'string',
        'success_messages' => 'string',
        'failure_messages' => 'string',
        'failure_codes' => 'string[]',
        'warning_codes' => 'string[]',
        'lines' => '\Avalara\SDK\Model\ShippingVerifyResultLines[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'compliant' => null,
        'message' => null,
        'success_messages' => null,
        'failure_messages' => null,
        'failure_codes' => null,
        'warning_codes' => null,
        'lines' => null
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
        'compliant' => 'compliant',
        'message' => 'message',
        'success_messages' => 'successMessages',
        'failure_messages' => 'failureMessages',
        'failure_codes' => 'failureCodes',
        'warning_codes' => 'warningCodes',
        'lines' => 'lines'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'compliant' => 'setCompliant',
        'message' => 'setMessage',
        'success_messages' => 'setSuccessMessages',
        'failure_messages' => 'setFailureMessages',
        'failure_codes' => 'setFailureCodes',
        'warning_codes' => 'setWarningCodes',
        'lines' => 'setLines'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'compliant' => 'getCompliant',
        'message' => 'getMessage',
        'success_messages' => 'getSuccessMessages',
        'failure_messages' => 'getFailureMessages',
        'failure_codes' => 'getFailureCodes',
        'warning_codes' => 'getWarningCodes',
        'lines' => 'getLines'
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

    const FAILURE_CODES_BELOW_LEGAL_DRINKING_AGE = 'BelowLegalDrinkingAge';
    const FAILURE_CODES_SHIPPING_PROHIBITED_TO_ADDRESS = 'ShippingProhibitedToAddress';
    const FAILURE_CODES_MISSING_REQUIRED_LICENSE = 'MissingRequiredLicense';
    const FAILURE_CODES_VOLUME_LIMIT_EXCEEDED = 'VolumeLimitExceeded';
    const FAILURE_CODES_INVALID_FIELD_VALUE = 'InvalidFieldValue';
    const FAILURE_CODES_MISSING_REQUIRED_FIELD = 'MissingRequiredField';
    const FAILURE_CODES_INVALID_FIELD_TYPE = 'InvalidFieldType';
    const FAILURE_CODES_INVALID_FORMAT = 'InvalidFormat';
    const FAILURE_CODES_INVALID_DATE = 'InvalidDate';
    const WARNING_CODES_UNSUPPORTED_TAX_CODE = 'UnsupportedTaxCode';
    const WARNING_CODES_UNSUPPORTED_ADDRESS = 'UnsupportedAddress';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getFailureCodesAllowableValues()
    {
        return [
            self::FAILURE_CODES_BELOW_LEGAL_DRINKING_AGE,
            self::FAILURE_CODES_SHIPPING_PROHIBITED_TO_ADDRESS,
            self::FAILURE_CODES_MISSING_REQUIRED_LICENSE,
            self::FAILURE_CODES_VOLUME_LIMIT_EXCEEDED,
            self::FAILURE_CODES_INVALID_FIELD_VALUE,
            self::FAILURE_CODES_MISSING_REQUIRED_FIELD,
            self::FAILURE_CODES_INVALID_FIELD_TYPE,
            self::FAILURE_CODES_INVALID_FORMAT,
            self::FAILURE_CODES_INVALID_DATE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getWarningCodesAllowableValues()
    {
        return [
            self::WARNING_CODES_UNSUPPORTED_TAX_CODE,
            self::WARNING_CODES_UNSUPPORTED_ADDRESS,
        ];
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
        $this->container['compliant'] = $data['compliant'] ?? null;
        $this->container['message'] = $data['message'] ?? null;
        $this->container['success_messages'] = $data['success_messages'] ?? null;
        $this->container['failure_messages'] = $data['failure_messages'] ?? null;
        $this->container['failure_codes'] = $data['failure_codes'] ?? null;
        $this->container['warning_codes'] = $data['warning_codes'] ?? null;
        $this->container['lines'] = $data['lines'] ?? null;
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
     * Gets compliant
     *
     * @return bool|null
     */
    public function getCompliant()
    {
        return $this->container['compliant'];
    }

    /**
     * Sets compliant
     *
     * @param bool|null $compliant Whether every line in the transaction is compliant.
     *
     * @return self
     */
    public function setCompliant($compliant)
    {
        $this->container['compliant'] = $compliant;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string|null $message A short description of the result of the compliance check.
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets success_messages
     *
     * @return string|null
     */
    public function getSuccessMessages()
    {
        return $this->container['success_messages'];
    }

    /**
     * Sets success_messages
     *
     * @param string|null $success_messages A detailed description of the result of each of the passed checks made against this transaction, separated by line.
     *
     * @return self
     */
    public function setSuccessMessages($success_messages)
    {
        $this->container['success_messages'] = $success_messages;

        return $this;
    }

    /**
     * Gets failure_messages
     *
     * @return string|null
     */
    public function getFailureMessages()
    {
        return $this->container['failure_messages'];
    }

    /**
     * Sets failure_messages
     *
     * @param string|null $failure_messages A detailed description of the result of each of the failed checks made against this transaction, separated by line.
     *
     * @return self
     */
    public function setFailureMessages($failure_messages)
    {
        $this->container['failure_messages'] = $failure_messages;

        return $this;
    }

    /**
     * Gets failure_codes
     *
     * @return string[]|null
     */
    public function getFailureCodes()
    {
        return $this->container['failure_codes'];
    }

    /**
     * Sets failure_codes
     *
     * @param string[]|null $failure_codes An enumeration of all the failure codes received across all lines.
     *
     * @return self
     */
    public function setFailureCodes($failure_codes)
    {
        $allowedValues = $this->getFailureCodesAllowableValues();
        if (!is_null($failure_codes) && array_diff($failure_codes, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'failure_codes', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['failure_codes'] = $failure_codes;

        return $this;
    }

    /**
     * Gets warning_codes
     *
     * @return string[]|null
     */
    public function getWarningCodes()
    {
        return $this->container['warning_codes'];
    }

    /**
     * Sets warning_codes
     *
     * @param string[]|null $warning_codes An enumeration of all the warning codes received across all lines that a determination could not be made for.
     *
     * @return self
     */
    public function setWarningCodes($warning_codes)
    {
        $allowedValues = $this->getWarningCodesAllowableValues();
        if (!is_null($warning_codes) && array_diff($warning_codes, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'warning_codes', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['warning_codes'] = $warning_codes;

        return $this;
    }

    /**
     * Gets lines
     *
     * @return \Avalara\SDK\Model\ShippingVerifyResultLines[]|null
     */
    public function getLines()
    {
        return $this->container['lines'];
    }

    /**
     * Sets lines
     *
     * @param \Avalara\SDK\Model\ShippingVerifyResultLines[]|null $lines Describes the results of the checks made for each line in the transaction.
     *
     * @return self
     */
    public function setLines($lines)
    {
        $this->container['lines'] = $lines;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
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
    public function offsetSet($offset, $value)
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
    public function offsetUnset($offset)
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


