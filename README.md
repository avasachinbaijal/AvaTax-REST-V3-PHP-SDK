# OpenAPIClient-php

API for evaluating transactions against direct-to-consumer Beverage Alcohol shipping regulations.

This API is currently in beta.



## Installation & Usage

### Requirements

PHP 7.3 and later.
Should also work with PHP 8.0 but has not been tested.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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


$apiInstance = new Avalara\\SDK\Api\ShippingVerificationApi(
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

## API Endpoints

All URIs are relative to *http://localhost*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*ShippingVerificationApi* | [**deregisterShipment**](docs/Api/ShippingVerificationApi.md#deregistershipment) | **DELETE** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registration | Removes the transaction from consideration when evaluating regulations that span multiple transactions.
*ShippingVerificationApi* | [**registerShipment**](docs/Api/ShippingVerificationApi.md#registershipment) | **PUT** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registration | Registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
*ShippingVerificationApi* | [**registerShipmentIfCompliant**](docs/Api/ShippingVerificationApi.md#registershipmentifcompliant) | **PUT** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registerIfCompliant | Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
*ShippingVerificationApi* | [**verifyShipment**](docs/Api/ShippingVerificationApi.md#verifyshipment) | **GET** /api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/verify | Evaluates a transaction against a set of direct-to-consumer shipping regulations.

## Models

- [ErrorDetails](docs/Model/ErrorDetails.md)
- [ErrorDetailsError](docs/Model/ErrorDetailsError.md)
- [ErrorDetailsErrorDetails](docs/Model/ErrorDetailsErrorDetails.md)
- [ShippingVerifyResult](docs/Model/ShippingVerifyResult.md)
- [ShippingVerifyResultLines](docs/Model/ShippingVerifyResultLines.md)

## Authorization

### BasicAuth

- **Type**: HTTP basic authentication


### Bearer

- **Type**: API key
- **API key parameter name**: Authorization
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `2.1.7`
    - Package version: `2.3.9`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
