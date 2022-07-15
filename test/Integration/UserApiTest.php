<?php

namespace Avalara\SDK\Test\Integration;
// Include the AvaTaxClient library
// require_once(__DIR__ . '/vendor/autoload.php');
use \Avalara\SDK\Test;
use \Avalara\SDK\Configuration;
use \Avalara\SDK\ApiClient;
use \Avalara\SDK\Test\DotEnv;
use \Avalara\SDK\API\IAMDS\UserApi;
use \Avalara\SDK\Model\IAMDS\User;
use PHPUnit\Framework\TestCase;
use \GuzzleHttp\Promise\queue;

class UserApiIntegrationTest extends TestCase
{
    private static $client;

    public static function setUpBeforeClass(): void
    {
        (new \Avalara\SDK\Test\DotEnv(getcwd() . '/.env'))->load();
        $config = new \Avalara\SDK\Configuration();
        $config->setClientId(getenv('CLIENT_ID'));
        $config->setClientSecret(getenv('CLIENT_SECRET'));
        // $config->setTestTokenUrl(getenv('TEST_TOKEN_URL'));
        // $config->setTestBasePath('http://localhost:3000');
        $config->appName='testApplication';
        $config->appVersion='2.1.2';
        $config->machineName='localhost';
        $config->environment='qa';  

        self::$client =  new \Avalara\SDK\ApiClient($config);
    }
    /**
     * @expectedException AuthenticationException
     */
    public function testCreateUser()
    {
        $apiInstance = new \Avalara\SDK\API\IAMDS\UserApi(self::$client);

        $user_request = new \Avalara\SDK\Model\IAMDS\User(); 

        try {
            $result=$apiInstance->createUserAsync(null, null, $user_request);
            $result->then(
                function($response) {
                    $this->assertNotNull($response);
                    print_r($response);
                }
            );
            //  Tick the promise queue to trigger the callback
            $result->wait();
            \GuzzleHttp\Promise\queue();
        }
        catch (Exception $e) {
            echo 'Exception : ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * @expectedException AuthenticationException
     */
    public function testCreateUser2()
    {
        $apiInstance = new \Avalara\SDK\API\IAMDS\UserApi(self::$client);

        $user_request = new \Avalara\SDK\Model\IAMDS\User(); 

        try {
            $result=$apiInstance->createUser(null, null, $user_request);
            $this->assertNotNull($result);
            print_r($result);
        }
        catch (Exception $e) {
            echo 'Exception : ', $e->getMessage(), PHP_EOL;
        }
    }
}