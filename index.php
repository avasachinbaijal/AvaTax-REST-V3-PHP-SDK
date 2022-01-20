<?php

// Include the AvaTaxClient library
require_once(__DIR__ . '/vendor/autoload.php');


$config = Avalara\ASV\Configuration::getDefaultConfiguration()
              ->setUsername('demo.compliance-verification')
              ->setPassword('sxgv7KK4HX*B7vY@')
              ->setEnvironment('sandbox');


$client=  new Avalara\ASV\ApiClient($config);
$apiInstance = new Avalara\ASV\API\AgeVerificationApi($client);

$age_verify_add= new  \Avalara\ASV\Model\AgeVerifyRequestAddress();
$age_verify_add->setLine1('255 S King St');
$age_verify_add->setPostalCode('98109');

$age_verify_request = new \Avalara\ASV\Model\AgeVerifyRequest(); 

$age_verify_request->setFirstName('Test');
$age_verify_request->setLastName('Person');
$age_verify_request->setDob('1970-01-01');
$age_verify_request->setAddress($age_verify_add);

$result=$apiInstance->verifyAge($age_verify_request);
print_r($result);

$apiInstance2 = new Avalara\ASV\API\ShippingVerificationApi($client);
try {
    $apiInstance2->deregisterShipment("DEFAULT", "575f7201-ae11-483a-bc4e-0b3f948e4397", null);
    print_r('success');
    
}
catch (Exception $e) {
    echo 'Exception : ', $e->getMessage(), PHP_EOL;
}



/*$apiInstance = new OpenAPI\Client\Api\ShippingVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$age_verify_request = new \OpenAPI\Client\Model\AgeVerifyRequest(); // \OpenAPI\Client\Model\AgeVerifyRequest | Information about the individual whose age is being verified.

try {
    $result = $apiInstance->deregisterShipment("DEFAULT", "575f7201-ae11-483a-bc4e-0b3f948e4397", null);
    print_r('success');
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AgeVerificationApi->verifyAge: ', $e->getMessage(), PHP_EOL;
}
*/


?>
<html>
<head>
    <title>AvaTax PHP Example</title>
</head>
<body>
<h1>AvaTax PHP Example</h1>

<p>This example calls the 'Ping' API to detect whether we are connected to AvaTax.

<div style="width:960px;">
    <pre>
        
    </pre>
</div>

</body>
</html>