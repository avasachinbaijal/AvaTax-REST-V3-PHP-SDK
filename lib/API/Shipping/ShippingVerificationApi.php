<?php
/**
 * ShippingVerificationApi
 * PHP version 7.3
 *
 * @category Class
 */

/*
 * AvaTax Software Development Kit for PHP
 *
 * (c) 2004-2022 Avalara, Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Avalara Shipping Verification for Beverage Alcohol
 *
 * API for evaluating transactions against direct-to-consumer Beverage Alcohol shipping regulations.  This API is currently in beta.
 *
 * @category   Avalara client libraries
 * @package    Avalara\SDK\Api\Shipping
 * @author     Sachin Baijal <sachin.baijal@avalara.com>
 * @author     Jonathan Wenger <jonathan.wenger@avalara.com>
 * @copyright  2004-2022 Avalara, Inc.
 * @license    https://www.apache.org/licenses/LICENSE-2.0
 * @version    2.4.29
 * @link       https://github.com/avadev/AvaTax-REST-V3-PHP-SDK

 */



namespace Avalara\SDK\Api\Shipping;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Avalara\SDK\ApiClient;
use Avalara\SDK\ApiException;
use Avalara\SDK\Configuration;
use Avalara\SDK\HeaderSelector;
use Avalara\SDK\ObjectSerializer;

class ShippingVerificationApi
{
    /**
     * @var ApiClient
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client  )
	{
        $this->setConfiguration($client); 
    }
	
	/**
     * Set APIClient Configuration
     *
     * @param APIClient $client 
     */
    private function setConfiguration($client): void
    {
        $this->verifyAPIClient($client);
        $client->setSdkVersion("2.4.29");
        $this->headerSelector = new HeaderSelector(); 
        $this->client = $client;
    }
	
	/**
     * Verify APIClient object
     *
     * @param int $client 
     */
    private function verifyAPIClient($client): void
    {
        if (is_null($client)){
            throw new ApiException("APIClient not defined");
        }
    }
	
	
    /**
     * Set the HeaderSelector
     *
     * @param HeaderSelector $selector   (required)
     */
    public function setHeaderSelector($selector): void
    {
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->client->config;
    }

    /**
     * Operation deregisterShipment
     *
     * Removes the transaction from consideration when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deregisterShipment($company_code, $transaction_code, $document_type = null)
    {
        $this->deregisterShipmentWithHttpInfo($company_code, $transaction_code, $document_type);
    }

    /**
     * Operation deregisterShipmentWithHttpInfo
     *
     * Removes the transaction from consideration when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deregisterShipmentWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $request = $this->deregisterShipmentRequest($company_code, $transaction_code, $document_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send_sync($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\Shipping\ErrorDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deregisterShipmentAsync
     *
     * Removes the transaction from consideration when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deregisterShipmentAsync($company_code, $transaction_code, $document_type = null)
    {
        return $this->deregisterShipmentAsyncWithHttpInfo($company_code, $transaction_code, $document_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deregisterShipmentAsyncWithHttpInfo
     *
     * Removes the transaction from consideration when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deregisterShipmentAsyncWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $returnType = '';
        $request = $this->deregisterShipmentRequest($company_code, $transaction_code, $document_type);

        return $this->client
            ->send_async($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deregisterShipment'
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deregisterShipmentRequest($company_code, $transaction_code, $document_type = null)
    {
        // verify the required parameter 'company_code' is set
        if ($company_code === null || (is_array($company_code) && count($company_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_code when calling deregisterShipment'
            );
        }
        // verify the required parameter 'transaction_code' is set
        if ($transaction_code === null || (is_array($transaction_code) && count($transaction_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $transaction_code when calling deregisterShipment'
            );
        }

        $resourcePath = '/api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registration';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($document_type !== null) {
            if('form' === 'form' && is_array($document_type)) {
                foreach($document_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['documentType'] = $document_type;
            }
        }


        // path params
        if ($company_code !== null) {
            $resourcePath = str_replace(
                '{' . 'companyCode' . '}',
                ObjectSerializer::toPathValue($company_code),
                $resourcePath
            );
        }
        // path params
        if ($transaction_code !== null) {
            $resourcePath = str_replace(
                '{' . 'transactionCode' . '}',
                ObjectSerializer::toPathValue($transaction_code),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.29; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint rehquires HTTP basic authentication
        if (!empty($this->client->config->getUsername()) || !(empty($this->client->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->config->getUsername() . ":" . $this->client->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->client->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation registerShipment
     *
     * Registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function registerShipment($company_code, $transaction_code, $document_type = null)
    {
        $this->registerShipmentWithHttpInfo($company_code, $transaction_code, $document_type);
    }

    /**
     * Operation registerShipmentWithHttpInfo
     *
     * Registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function registerShipmentWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $request = $this->registerShipmentRequest($company_code, $transaction_code, $document_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send_sync($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\Shipping\ErrorDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation registerShipmentAsync
     *
     * Registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function registerShipmentAsync($company_code, $transaction_code, $document_type = null)
    {
        return $this->registerShipmentAsyncWithHttpInfo($company_code, $transaction_code, $document_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation registerShipmentAsyncWithHttpInfo
     *
     * Registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function registerShipmentAsyncWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $returnType = '';
        $request = $this->registerShipmentRequest($company_code, $transaction_code, $document_type);

        return $this->client
            ->send_async($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'registerShipment'
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function registerShipmentRequest($company_code, $transaction_code, $document_type = null)
    {
        // verify the required parameter 'company_code' is set
        if ($company_code === null || (is_array($company_code) && count($company_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_code when calling registerShipment'
            );
        }
        // verify the required parameter 'transaction_code' is set
        if ($transaction_code === null || (is_array($transaction_code) && count($transaction_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $transaction_code when calling registerShipment'
            );
        }

        $resourcePath = '/api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registration';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($document_type !== null) {
            if('form' === 'form' && is_array($document_type)) {
                foreach($document_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['documentType'] = $document_type;
            }
        }


        // path params
        if ($company_code !== null) {
            $resourcePath = str_replace(
                '{' . 'companyCode' . '}',
                ObjectSerializer::toPathValue($company_code),
                $resourcePath
            );
        }
        // path params
        if ($transaction_code !== null) {
            $resourcePath = str_replace(
                '{' . 'transactionCode' . '}',
                ObjectSerializer::toPathValue($transaction_code),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.29; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint rehquires HTTP basic authentication
        if (!empty($this->client->config->getUsername()) || !(empty($this->client->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->config->getUsername() . ":" . $this->client->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->client->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation registerShipmentIfCompliant
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\Shipping\ShippingVerifyResult|\Avalara\SDK\Model\Shipping\ErrorDetails
     */
    public function registerShipmentIfCompliant($company_code, $transaction_code, $document_type = null)
    {
        list($response) = $this->registerShipmentIfCompliantWithHttpInfo($company_code, $transaction_code, $document_type);
        return $response;
    }

    /**
     * Operation registerShipmentIfCompliantWithHttpInfo
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\Shipping\ShippingVerifyResult|\Avalara\SDK\Model\Shipping\ErrorDetails, HTTP status code, HTTP response headers (array of strings)
     */
    public function registerShipmentIfCompliantWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $request = $this->registerShipmentIfCompliantRequest($company_code, $transaction_code, $document_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send_sync($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Avalara\SDK\Model\Shipping\ShippingVerifyResult' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\Shipping\ShippingVerifyResult', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 409:
                    if ('\Avalara\SDK\Model\Shipping\ErrorDetails' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\Shipping\ErrorDetails', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Avalara\SDK\Model\Shipping\ShippingVerifyResult';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\Shipping\ShippingVerifyResult',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\Shipping\ErrorDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation registerShipmentIfCompliantAsync
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function registerShipmentIfCompliantAsync($company_code, $transaction_code, $document_type = null)
    {
        return $this->registerShipmentIfCompliantAsyncWithHttpInfo($company_code, $transaction_code, $document_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation registerShipmentIfCompliantAsyncWithHttpInfo
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations and, if compliant, registers the transaction so that it may be included when evaluating regulations that span multiple transactions.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function registerShipmentIfCompliantAsyncWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $returnType = '\Avalara\SDK\Model\Shipping\ShippingVerifyResult';
        $request = $this->registerShipmentIfCompliantRequest($company_code, $transaction_code, $document_type);

        return $this->client
            ->send_async($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'registerShipmentIfCompliant'
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function registerShipmentIfCompliantRequest($company_code, $transaction_code, $document_type = null)
    {
        // verify the required parameter 'company_code' is set
        if ($company_code === null || (is_array($company_code) && count($company_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_code when calling registerShipmentIfCompliant'
            );
        }
        // verify the required parameter 'transaction_code' is set
        if ($transaction_code === null || (is_array($transaction_code) && count($transaction_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $transaction_code when calling registerShipmentIfCompliant'
            );
        }

        $resourcePath = '/api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/registerIfCompliant';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($document_type !== null) {
            if('form' === 'form' && is_array($document_type)) {
                foreach($document_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['documentType'] = $document_type;
            }
        }


        // path params
        if ($company_code !== null) {
            $resourcePath = str_replace(
                '{' . 'companyCode' . '}',
                ObjectSerializer::toPathValue($company_code),
                $resourcePath
            );
        }
        // path params
        if ($transaction_code !== null) {
            $resourcePath = str_replace(
                '{' . 'transactionCode' . '}',
                ObjectSerializer::toPathValue($transaction_code),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.29; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint rehquires HTTP basic authentication
        if (!empty($this->client->config->getUsername()) || !(empty($this->client->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->config->getUsername() . ":" . $this->client->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->client->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation verifyShipment
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\Shipping\ShippingVerifyResult|\Avalara\SDK\Model\Shipping\ErrorDetails
     */
    public function verifyShipment($company_code, $transaction_code, $document_type = null)
    {
        list($response) = $this->verifyShipmentWithHttpInfo($company_code, $transaction_code, $document_type);
        return $response;
    }

    /**
     * Operation verifyShipmentWithHttpInfo
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\Shipping\ShippingVerifyResult|\Avalara\SDK\Model\Shipping\ErrorDetails, HTTP status code, HTTP response headers (array of strings)
     */
    public function verifyShipmentWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $request = $this->verifyShipmentRequest($company_code, $transaction_code, $document_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send_sync($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Avalara\SDK\Model\Shipping\ShippingVerifyResult' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\Shipping\ShippingVerifyResult', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 409:
                    if ('\Avalara\SDK\Model\Shipping\ErrorDetails' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\Shipping\ErrorDetails', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Avalara\SDK\Model\Shipping\ShippingVerifyResult';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\Shipping\ShippingVerifyResult',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\Shipping\ErrorDetails',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation verifyShipmentAsync
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifyShipmentAsync($company_code, $transaction_code, $document_type = null)
    {
        return $this->verifyShipmentAsyncWithHttpInfo($company_code, $transaction_code, $document_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation verifyShipmentAsyncWithHttpInfo
     *
     * Evaluates a transaction against a set of direct-to-consumer shipping regulations.
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifyShipmentAsyncWithHttpInfo($company_code, $transaction_code, $document_type = null)
    {
        $returnType = '\Avalara\SDK\Model\Shipping\ShippingVerifyResult';
        $request = $this->verifyShipmentRequest($company_code, $transaction_code, $document_type);

        return $this->client
            ->send_async($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'verifyShipment'
     *
     * @param  string $company_code The company code of the company that recorded the transaction (required)
     * @param  string $transaction_code The transaction code to retrieve (required)
     * @param  string $document_type (Optional): The document type of the transaction to operate on. If omitted, defaults to \&quot;SalesInvoice\&quot; (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function verifyShipmentRequest($company_code, $transaction_code, $document_type = null)
    {
        // verify the required parameter 'company_code' is set
        if ($company_code === null || (is_array($company_code) && count($company_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_code when calling verifyShipment'
            );
        }
        // verify the required parameter 'transaction_code' is set
        if ($transaction_code === null || (is_array($transaction_code) && count($transaction_code) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $transaction_code when calling verifyShipment'
            );
        }

        $resourcePath = '/api/v2/companies/{companyCode}/transactions/{transactionCode}/shipment/verify';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($document_type !== null) {
            if('form' === 'form' && is_array($document_type)) {
                foreach($document_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['documentType'] = $document_type;
            }
        }


        // path params
        if ($company_code !== null) {
            $resourcePath = str_replace(
                '{' . 'companyCode' . '}',
                ObjectSerializer::toPathValue($company_code),
                $resourcePath
            );
        }
        // path params
        if ($transaction_code !== null) {
            $resourcePath = str_replace(
                '{' . 'transactionCode' . '}',
                ObjectSerializer::toPathValue($transaction_code),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.29; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint rehquires HTTP basic authentication
        if (!empty($this->client->config->getUsername()) || !(empty($this->client->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->config->getUsername() . ":" . $this->client->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->client->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->client->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->client->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->client->config->getDebugFile());
            }
        }

        return $options;
    }
}
