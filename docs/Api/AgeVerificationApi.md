# Avalara\\SDK\AgeVerificationApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**verifyAge()**](AgeVerificationApi.md#verifyAge) | **POST** /api/v2/ageverification/verify | Determines whether an individual meets or exceeds the minimum legal drinking age.


## `verifyAge()`

```php
verifyAge($age_verify_request, $simulated_failure_code): \Avalara\\SDK\Model\AgeVerifyResult
```

Determines whether an individual meets or exceeds the minimum legal drinking age.

The request must meet the following criteria in order to be evaluated: * *firstName*, *lastName*, and *address* are required fields. * One of the following sets of attributes are required for the *address*:   * *line1, city, region*   * *line1, postalCode*  Optionally, the transaction and its lines may use the following parameters: * A *DOB* (Date of Birth) field. The value should be ISO-8601 compliant (e.g. 2020-07-21). * Beyond the required *address* fields above, a *country* field is permitted   * The valid values for this attribute are [*US, USA*]  **Security Policies** This API depends on the active subscription *AgeVerification*

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: BasicAuth
$config = Avalara\\SDK\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');

// Configure API key authorization: Bearer
$config = Avalara\\SDK\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Avalara\\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Avalara\\SDK\Api\AgeVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$age_verify_request = new \Avalara\\SDK\Model\AgeVerifyRequest(); // \Avalara\\SDK\Model\AgeVerifyRequest | Information about the individual whose age is being verified.
$simulated_failure_code = new \Avalara\\SDK\Model\\Avalara\\SDK\Model\AgeVerifyFailureCode(); // \Avalara\\SDK\Model\AgeVerifyFailureCode | (Optional) The failure code included in the simulated response of the endpoint. Note that this endpoint is only available in Sandbox for testing purposes.

try {
    $result = $apiInstance->verifyAge($age_verify_request, $simulated_failure_code);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AgeVerificationApi->verifyAge: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **age_verify_request** | [**\Avalara\\SDK\Model\AgeVerifyRequest**](../Model/AgeVerifyRequest.md)| Information about the individual whose age is being verified. |
 **simulated_failure_code** | [**\Avalara\\SDK\Model\AgeVerifyFailureCode**](../Model/.md)| (Optional) The failure code included in the simulated response of the endpoint. Note that this endpoint is only available in Sandbox for testing purposes. | [optional]

### Return type

[**\Avalara\\SDK\Model\AgeVerifyResult**](../Model/AgeVerifyResult.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
