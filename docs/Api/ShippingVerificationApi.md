# AvalaraSDK\ShippingVerificationApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**deregisterShipment()**](ShippingVerificationApi.md#deregisterShipment) | **DELETE** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registration | Removes the transaction from consideration when evaluating regulations that span multiple transactions.
[**registerShipment()**](ShippingVerificationApi.md#registerShipment) | **PUT** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registration | Registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
[**registerShipmentIfCompliant()**](ShippingVerificationApi.md#registerShipmentIfCompliant) | **PUT** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registerIfCompliant | Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
[**verifyShipment()**](ShippingVerificationApi.md#verifyShipment) | **GET** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/verify | Evaluates a transaction against a set of direct-to-consumer shipping regulations.


## `deregisterShipment()`

```php
deregisterShipment($company_code, $transaction_code, $document_type)
```

Removes the transaction from consideration when evaluating regulations that span multiple transactions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: BasicAuth
$config = AvalaraSDK\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');

// Configure API key authorization: Bearer
$config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new AvalaraSDK\Api\ShippingVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_code = 'company_code_example'; // string | The company code of the company that recorded the transaction
$transaction_code = 'transaction_code_example'; // string | The transaction code to retrieve
$document_type = 'document_type_example'; // string | (Optional): The document type of the transaction to operate on. If omitted, defaults to \"SalesInvoice\"

try {
    $apiInstance->deregisterShipment($company_code, $transaction_code, $document_type);
} catch (Exception $e) {
    echo 'Exception when calling ShippingVerificationApi->deregisterShipment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **company_code** | **string**| The company code of the company that recorded the transaction |
 **transaction_code** | **string**| The transaction code to retrieve |
 **document_type** | **string**| (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; | [optional]

### Return type

void (empty response body)

### Authorization

[BasicAuth](../../README.md#BasicAuth), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `registerShipment()`

```php
registerShipment($company_code, $transaction_code, $document_type)
```

Registers the transaction so that it may be included when evaluating regulations that span multiple transactions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: BasicAuth
$config = AvalaraSDK\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');

// Configure API key authorization: Bearer
$config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new AvalaraSDK\Api\ShippingVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_code = 'company_code_example'; // string | The company code of the company that recorded the transaction
$transaction_code = 'transaction_code_example'; // string | The transaction code to retrieve
$document_type = 'document_type_example'; // string | (Optional): The document type of the transaction to operate on. If omitted, defaults to \"SalesInvoice\"

try {
    $apiInstance->registerShipment($company_code, $transaction_code, $document_type);
} catch (Exception $e) {
    echo 'Exception when calling ShippingVerificationApi->registerShipment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **company_code** | **string**| The company code of the company that recorded the transaction |
 **transaction_code** | **string**| The transaction code to retrieve |
 **document_type** | **string**| (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; | [optional]

### Return type

void (empty response body)

### Authorization

[BasicAuth](../../README.md#BasicAuth), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `registerShipmentIfCompliant()`

```php
registerShipmentIfCompliant($company_code, $transaction_code, $document_type): \AvalaraSDK\Model\ShippingVerifyResult
```

Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: BasicAuth
$config = AvalaraSDK\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');

// Configure API key authorization: Bearer
$config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new AvalaraSDK\Api\ShippingVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_code = 'company_code_example'; // string | The company code of the company that recorded the transaction
$transaction_code = 'transaction_code_example'; // string | The transaction code to retrieve
$document_type = 'document_type_example'; // string | (Optional): The document type of the transaction to operate on. If omitted, defaults to \"SalesInvoice\"

try {
    $result = $apiInstance->registerShipmentIfCompliant($company_code, $transaction_code, $document_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ShippingVerificationApi->registerShipmentIfCompliant: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **company_code** | **string**| The company code of the company that recorded the transaction |
 **transaction_code** | **string**| The transaction code to retrieve |
 **document_type** | **string**| (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; | [optional]

### Return type

[**\AvalaraSDK\Model\ShippingVerifyResult**](../Model/ShippingVerifyResult.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifyShipment()`

```php
verifyShipment($company_code, $transaction_code, $document_type): \AvalaraSDK\Model\ShippingVerifyResult
```

Evaluates a transaction against a set of direct-to-consumer shipping regulations.

The transaction and its lines must meet the following criteria in order to be evaluated: * The transaction must be recorded. Using a type of *SalesInvoice* is recommended. * A parameter with the name *AlcoholRouteType* must be specified and the value must be one of the following: '*DTC*', '*Retailer DTC*' * A parameter with the name *RecipientName* must be specified and the value must be the name of the recipient. * Each alcohol line must include a *ContainerSize* parameter that describes the volume of a single container. Use the *unit* field to specify one of the following units: '*Litre*', '*Millilitre*', '*gallon (US fluid)*', '*quart (US fluid)*', '*ounce (fluid US customary)*' * Each alcohol line must include a *PackSize* parameter that describes the number of containers in a pack. Specify *Count* in the *unit* field.  Optionally, the transaction and its lines may use the following parameters: * The *ShipDate* parameter may be used if the date of shipment is different than the date of the transaction. The value should be ISO-8601 compliant (e.g. 2020-07-21). * The *RecipientDOB* parameter may be used to evaluate age restrictions. The value should be ISO-8601 compliant (e.g. 2020-07-21). * The *PurchaserDOB* parameter may be used to evaluate age restrictions. The value should be ISO-8601 compliant (e.g. 2020-07-21). * The *SalesLocation* parameter may be used to describe whether the sale was made *OnSite* or *OffSite*. *OffSite* is the default value. * The *AlcoholContent* parameter may be used to describe the alcohol percentage by volume of the item. Specify *Percentage* in the *unit* field.  **Security Policies** This API depends on all of the following active subscriptions: *AvaAlcohol, AutoAddress, AvaTaxPro*

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: BasicAuth
$config = AvalaraSDK\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');

// Configure API key authorization: Bearer
$config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = AvalaraSDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new AvalaraSDK\Api\ShippingVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$company_code = 'company_code_example'; // string | The company code of the company that recorded the transaction
$transaction_code = 'transaction_code_example'; // string | The transaction code to retrieve
$document_type = 'document_type_example'; // string | (Optional): The document type of the transaction to operate on. If omitted, defaults to \"SalesInvoice\"

try {
    $result = $apiInstance->verifyShipment($company_code, $transaction_code, $document_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ShippingVerificationApi->verifyShipment: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **company_code** | **string**| The company code of the company that recorded the transaction |
 **transaction_code** | **string**| The transaction code to retrieve |
 **document_type** | **string**| (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; | [optional]

### Return type

[**\AvalaraSDK\Model\ShippingVerifyResult**](../Model/ShippingVerifyResult.md)

### Authorization

[BasicAuth](../../README.md#BasicAuth), [Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
