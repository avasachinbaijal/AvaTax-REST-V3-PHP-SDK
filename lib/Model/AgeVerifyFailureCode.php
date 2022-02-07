<?php
/**
 * AgeVerifyFailureCode
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
 * @version    2.4.23
 * @link       https://github.com/avadev/AvaTax-REST-V3-PHP-SDK

 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Avalara\SDK\Model;
use \Avalara\SDK\ObjectSerializer;

/**
 * AgeVerifyFailureCode Class Doc Comment
 *
 * @category Class
 * @package  Avalara\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class AgeVerifyFailureCode
{
    /**
     * Possible values of this enum
     */
    const NOT_FOUND = 'not_found';

    const DOB_UNVERIFIABLE = 'dob_unverifiable';

    const UNDER_AGE = 'under_age';

    const SUSPECTED_FRAUD = 'suspected_fraud';

    const DECEASED = 'deceased';

    const UNKNOWN_ERROR = 'unknown_error';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::NOT_FOUND,
            self::DOB_UNVERIFIABLE,
            self::UNDER_AGE,
            self::SUSPECTED_FRAUD,
            self::DECEASED,
            self::UNKNOWN_ERROR
        ];
    }
}


