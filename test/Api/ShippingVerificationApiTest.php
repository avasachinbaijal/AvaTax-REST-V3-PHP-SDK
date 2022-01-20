<?php
/**
 * ShippingVerificationApiTest
 * PHP version 7.3
 *
 * @category Class
 * @package  Avalara\ASV
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Avalara Shipping Verification for Beverage Alcohol
 *
 * API for evaluating transactions against direct-to-consumer Beverage Alcohol shipping regulations.  This API is currently in beta.
 *
 * The version of the OpenAPI document: 2.1.0-beta
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Please update the test case below to test the endpoint.
 */

namespace Avalara\ASV\Test\Api;

use \Avalara\ASV\Configuration;
use \Avalara\ASV\ApiException;
use \Avalara\ASV\ObjectSerializer;
use PHPUnit\Framework\TestCase;

/**
 * ShippingVerificationApiTest Class Doc Comment
 *
 * @category Class
 * @package  Avalara\ASV
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ShippingVerificationApiTest extends TestCase
{

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test case for deregisterShipment
     *
     * Removes the transaction from consideration when evaluating regulations that span multiple transactions..
     *
     */
    public function testDeregisterShipment()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for registerShipment
     *
     * Registers the transaction so that it may be included when evaluating regulations that span multiple transactions..
     *
     */
    public function testRegisterShipment()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for registerShipmentIfCompliant
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions..
     *
     */
    public function testRegisterShipmentIfCompliant()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for verifyShipment
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations..
     *
     */
    public function testVerifyShipment()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }
}
