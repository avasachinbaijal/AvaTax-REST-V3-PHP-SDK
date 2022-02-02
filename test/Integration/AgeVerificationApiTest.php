<?php

namespace Avalara\SDK\Test\Integration;
// Include the AvaTaxClient library
// require_once(__DIR__ . '/vendor/autoload.php');
use \Avalara\SDK\Configuration;
use \Avalara\SDK\ApiClient;
use \Avalara\SDK\API\AgeVerificationApi;
use \Avalara\SDK\Model\AgeVerifyRequestAddress;
use \Avalara\SDK\Model\AgeVerifyRequest;
use PHPUnit\Framework\TestCase;

class AgeVerificationApiIntegrationTest extends TestCase
{
    public function testVerifyShipment()
    {
        $config = new \Avalara\SDK\Configuration();
        $config->username=getenv('USERNAME');
        $config->password=getenv('PASSWORD');
        $config->appName='testApplication';
        $config->appVersion='2.1.2';
        $config->machineName='localhost';
        $config->environment='sandbox';    

        $client=  new \Avalara\SDK\ApiClient($config);
        $apiInstance = new \Avalara\SDK\API\AgeVerificationApi($client);

        $age_verify_add= new  \Avalara\SDK\Model\AgeVerifyRequestAddress();
        $age_verify_add->setLine1('255 S King St');
        $age_verify_add->setPostalCode('98109');

        $age_verify_request = new \Avalara\SDK\Model\AgeVerifyRequest(); 

        $age_verify_request->setFirstName('Test');
        $age_verify_request->setLastName('Person');
        $age_verify_request->setDob('1970-01-01');
        $age_verify_request->setAddress($age_verify_add);

        try {
            $result=$apiInstance->verifyAge($age_verify_request);
            $this->assertEquals(1, $result["is_of_age"]);
            print_r($result);
            
        }
        catch (Exception $e) {
            echo 'Exception : ', $e->getMessage(), PHP_EOL;
        }
        
    }
}