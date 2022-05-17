<?php
/**
 * EntitlementApi
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
 * foundation
 *
 * Platform foundation consists of services on top of which the Avalara Compliance Cloud platform is built. These services are foundational and provide functionality such as common organization, tenant and user management for the rest of the compliance platform.
 *
 * @category   Avalara client libraries
 * @package    Avalara\SDK\API\IAMDS
 * @author     Sachin Baijal <sachin.baijal@avalara.com>
 * @author     Jonathan Wenger <jonathan.wenger@avalara.com>
 * @copyright  2004-2022 Avalara, Inc.
 * @license    https://www.apache.org/licenses/LICENSE-2.0
 * @version    2.4.33
 * @link       https://github.com/avadev/AvaTax-REST-V3-PHP-SDK

 */



namespace Avalara\SDK\API\IAMDS;

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

class EntitlementApi
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
        $client->setSdkVersion("2.4.33");
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
     * Operation createEntitlement
     *
     * Create an entitlement.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement entitlement (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\IAMDS\Entitlement|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function createEntitlement($avalara_version = null, $x_correlation_id = null, $entitlement = null)
    {
        list($response) = $this->createEntitlementWithHttpInfo($avalara_version, $x_correlation_id, $entitlement);
        return $response;
    }

    /**
     * Operation createEntitlementWithHttpInfo
     *
     * Create an entitlement.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\IAMDS\Entitlement|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function createEntitlementWithHttpInfo($avalara_version = null, $x_correlation_id = null, $entitlement = null)
    {
        $request = $this->createEntitlementRequest($avalara_version, $x_correlation_id, $entitlement);

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
                case 201:
                    if ('\Avalara\SDK\Model\IAMDS\Entitlement' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\Entitlement', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Avalara\SDK\Model\IAMDS\VersionError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\VersionError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Avalara\SDK\Model\IAMDS\Entitlement';
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
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\IAMDS\Entitlement',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\IAMDS\VersionError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createEntitlementAsync
     *
     * Create an entitlement.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createEntitlementAsync($avalara_version = null, $x_correlation_id = null, $entitlement = null)
    {
        return $this->createEntitlementAsyncWithHttpInfo($avalara_version, $x_correlation_id, $entitlement)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createEntitlementAsyncWithHttpInfo
     *
     * Create an entitlement.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createEntitlementAsyncWithHttpInfo($avalara_version = null, $x_correlation_id = null, $entitlement = null)
    {
        $returnType = '\Avalara\SDK\Model\IAMDS\Entitlement';
        $request = $this->createEntitlementRequest($avalara_version, $x_correlation_id, $entitlement);

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
     * Create request for operation 'createEntitlement'
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createEntitlementRequest($avalara_version = null, $x_correlation_id = null, $entitlement = null)
    {

        $resourcePath = '/entitlements';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($avalara_version !== null) {
            $headerParams['avalara-version'] = ObjectSerializer::toHeaderValue($avalara_version);
        }
        // header params
        if ($x_correlation_id !== null) {
            $headerParams['X-Correlation-Id'] = ObjectSerializer::toHeaderValue($x_correlation_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'text/plain']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'text/plain'],
                ['application/json']
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.33; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (isset($entitlement)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($entitlement));
            } else {
                $httpBody = $entitlement;
            }
        } elseif (count($formParams) > 0) {
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

        // this endpoint requires OAuth (access token)
        if ($this->client->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->client->config->getAccessToken();
        }

        $defaultHeaders = [];
        
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteEntitlement
     *
     * Delete an entitlement.
     *
     * @param  string $entitlement_id entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteEntitlement($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        $this->deleteEntitlementWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_match);
    }

    /**
     * Operation deleteEntitlementWithHttpInfo
     *
     * Delete an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteEntitlementWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        $request = $this->deleteEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_match);

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
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\IAMDS\VersionError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteEntitlementAsync
     *
     * Delete an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteEntitlementAsync($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        return $this->deleteEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_match)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteEntitlementAsyncWithHttpInfo
     *
     * Delete an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        $returnType = '';
        $request = $this->deleteEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_match);

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
     * Create request for operation 'deleteEntitlement'
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteEntitlementRequest($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        // verify the required parameter 'entitlement_id' is set
        if ($entitlement_id === null || (is_array($entitlement_id) && count($entitlement_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entitlement_id when calling deleteEntitlement'
            );
        }

        $resourcePath = '/entitlements/{entitlement-id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($avalara_version !== null) {
            $headerParams['avalara-version'] = ObjectSerializer::toHeaderValue($avalara_version);
        }
        // header params
        if ($x_correlation_id !== null) {
            $headerParams['X-Correlation-Id'] = ObjectSerializer::toHeaderValue($x_correlation_id);
        }
        // header params
        if ($if_match !== null) {
            $headerParams['If-Match'] = ObjectSerializer::toHeaderValue($if_match);
        }

        // path params
        if ($entitlement_id !== null) {
            $resourcePath = str_replace(
                '{' . 'entitlement-id' . '}',
                ObjectSerializer::toPathValue($entitlement_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['text/plain']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['text/plain'],
                []
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.33; {$this->client->config->getMachineName()}";

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

        // this endpoint requires OAuth (access token)
        if ($this->client->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->client->config->getAccessToken();
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
     * Operation getEntitlement
     *
     * Get an entitlement.
     *
     * @param  string $entitlement_id entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\IAMDS\Entitlement|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function getEntitlement($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        list($response) = $this->getEntitlementWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_none_match);
        return $response;
    }

    /**
     * Operation getEntitlementWithHttpInfo
     *
     * Get an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\IAMDS\Entitlement|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function getEntitlementWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        $request = $this->getEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_none_match);

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
                    if ('\Avalara\SDK\Model\IAMDS\Entitlement' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\Entitlement', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Avalara\SDK\Model\IAMDS\VersionError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\VersionError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Avalara\SDK\Model\IAMDS\Entitlement';
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
                        '\Avalara\SDK\Model\IAMDS\Entitlement',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\IAMDS\VersionError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getEntitlementAsync
     *
     * Get an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEntitlementAsync($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        return $this->getEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_none_match)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getEntitlementAsyncWithHttpInfo
     *
     * Get an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        $returnType = '\Avalara\SDK\Model\IAMDS\Entitlement';
        $request = $this->getEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_none_match);

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
     * Create request for operation 'getEntitlement'
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getEntitlementRequest($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        // verify the required parameter 'entitlement_id' is set
        if ($entitlement_id === null || (is_array($entitlement_id) && count($entitlement_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entitlement_id when calling getEntitlement'
            );
        }

        $resourcePath = '/entitlements/{entitlement-id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($avalara_version !== null) {
            $headerParams['avalara-version'] = ObjectSerializer::toHeaderValue($avalara_version);
        }
        // header params
        if ($x_correlation_id !== null) {
            $headerParams['X-Correlation-Id'] = ObjectSerializer::toHeaderValue($x_correlation_id);
        }
        // header params
        if ($if_none_match !== null) {
            $headerParams['If-None-Match'] = ObjectSerializer::toHeaderValue($if_none_match);
        }

        // path params
        if ($entitlement_id !== null) {
            $resourcePath = str_replace(
                '{' . 'entitlement-id' . '}',
                ObjectSerializer::toPathValue($entitlement_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'text/plain']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'text/plain'],
                []
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.33; {$this->client->config->getMachineName()}";

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

        // this endpoint requires OAuth (access token)
        if ($this->client->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->client->config->getAccessToken();
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
     * Operation listEntitlements
     *
     * List all entitlements.
     *
     * @param  string $filter A filter statement to identify specific records to retrieve. (optional)
     * @param  string $top If nonzero, return no more than this number of results.  Used with &#x60;$skip&#x60; to provide pagination for large datasets.  Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records. (optional)
     * @param  string $skip If nonzero, skip this number of results before returning data.  Used with &#x60;$top&#x60; to provide pagination for large datasets. (optional)
     * @param  string $order_by A comma separated list of sort statements in the format &#x60;(fieldname) [ASC|DESC]&#x60;, for example &#x60;id ASC&#x60;. (optional)
     * @param  bool $count If set to &#39;true&#39;, requests the count of items as part of the response. Default: &#39;false&#39;. If the value cannot be (optional)
     * @param  bool $count_only If set to &#39;true&#39;, requests the count of items as part of the response. No values are returned. Default: &#39;false&#39;. (optional)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\IAMDS\EntitlementList|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function listEntitlements($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        list($response) = $this->listEntitlementsWithHttpInfo($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);
        return $response;
    }

    /**
     * Operation listEntitlementsWithHttpInfo
     *
     * List all entitlements.
     *
     * @param  string $filter A filter statement to identify specific records to retrieve. (optional)
     * @param  string $top If nonzero, return no more than this number of results.  Used with &#x60;$skip&#x60; to provide pagination for large datasets.  Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records. (optional)
     * @param  string $skip If nonzero, skip this number of results before returning data.  Used with &#x60;$top&#x60; to provide pagination for large datasets. (optional)
     * @param  string $order_by A comma separated list of sort statements in the format &#x60;(fieldname) [ASC|DESC]&#x60;, for example &#x60;id ASC&#x60;. (optional)
     * @param  bool $count If set to &#39;true&#39;, requests the count of items as part of the response. Default: &#39;false&#39;. If the value cannot be (optional)
     * @param  bool $count_only If set to &#39;true&#39;, requests the count of items as part of the response. No values are returned. Default: &#39;false&#39;. (optional)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\IAMDS\EntitlementList|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function listEntitlementsWithHttpInfo($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        $request = $this->listEntitlementsRequest($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);

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
                    if ('\Avalara\SDK\Model\IAMDS\EntitlementList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\EntitlementList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Avalara\SDK\Model\IAMDS\VersionError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\VersionError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Avalara\SDK\Model\IAMDS\EntitlementList';
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
                        '\Avalara\SDK\Model\IAMDS\EntitlementList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\IAMDS\VersionError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listEntitlementsAsync
     *
     * List all entitlements.
     *
     * @param  string $filter A filter statement to identify specific records to retrieve. (optional)
     * @param  string $top If nonzero, return no more than this number of results.  Used with &#x60;$skip&#x60; to provide pagination for large datasets.  Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records. (optional)
     * @param  string $skip If nonzero, skip this number of results before returning data.  Used with &#x60;$top&#x60; to provide pagination for large datasets. (optional)
     * @param  string $order_by A comma separated list of sort statements in the format &#x60;(fieldname) [ASC|DESC]&#x60;, for example &#x60;id ASC&#x60;. (optional)
     * @param  bool $count If set to &#39;true&#39;, requests the count of items as part of the response. Default: &#39;false&#39;. If the value cannot be (optional)
     * @param  bool $count_only If set to &#39;true&#39;, requests the count of items as part of the response. No values are returned. Default: &#39;false&#39;. (optional)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listEntitlementsAsync($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        return $this->listEntitlementsAsyncWithHttpInfo($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listEntitlementsAsyncWithHttpInfo
     *
     * List all entitlements.
     *
     * @param  string $filter A filter statement to identify specific records to retrieve. (optional)
     * @param  string $top If nonzero, return no more than this number of results.  Used with &#x60;$skip&#x60; to provide pagination for large datasets.  Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records. (optional)
     * @param  string $skip If nonzero, skip this number of results before returning data.  Used with &#x60;$top&#x60; to provide pagination for large datasets. (optional)
     * @param  string $order_by A comma separated list of sort statements in the format &#x60;(fieldname) [ASC|DESC]&#x60;, for example &#x60;id ASC&#x60;. (optional)
     * @param  bool $count If set to &#39;true&#39;, requests the count of items as part of the response. Default: &#39;false&#39;. If the value cannot be (optional)
     * @param  bool $count_only If set to &#39;true&#39;, requests the count of items as part of the response. No values are returned. Default: &#39;false&#39;. (optional)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listEntitlementsAsyncWithHttpInfo($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        $returnType = '\Avalara\SDK\Model\IAMDS\EntitlementList';
        $request = $this->listEntitlementsRequest($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);

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
     * Create request for operation 'listEntitlements'
     *
     * @param  string $filter A filter statement to identify specific records to retrieve. (optional)
     * @param  string $top If nonzero, return no more than this number of results.  Used with &#x60;$skip&#x60; to provide pagination for large datasets.  Unless otherwise specified, the maximum number of records that can be returned from an API call is 1,000 records. (optional)
     * @param  string $skip If nonzero, skip this number of results before returning data.  Used with &#x60;$top&#x60; to provide pagination for large datasets. (optional)
     * @param  string $order_by A comma separated list of sort statements in the format &#x60;(fieldname) [ASC|DESC]&#x60;, for example &#x60;id ASC&#x60;. (optional)
     * @param  bool $count If set to &#39;true&#39;, requests the count of items as part of the response. Default: &#39;false&#39;. If the value cannot be (optional)
     * @param  bool $count_only If set to &#39;true&#39;, requests the count of items as part of the response. No values are returned. Default: &#39;false&#39;. (optional)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listEntitlementsRequest($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {

        $resourcePath = '/entitlements';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($filter !== null) {
            if('form' === 'form' && is_array($filter)) {
                foreach($filter as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['$filter'] = $filter;
            }
        }
        // query params
        if ($top !== null) {
            if('form' === 'form' && is_array($top)) {
                foreach($top as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['$top'] = $top;
            }
        }
        // query params
        if ($skip !== null) {
            if('form' === 'form' && is_array($skip)) {
                foreach($skip as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['$skip'] = $skip;
            }
        }
        // query params
        if ($order_by !== null) {
            if('form' === 'form' && is_array($order_by)) {
                foreach($order_by as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['$orderBy'] = $order_by;
            }
        }
        // query params
        if ($count !== null) {
            if('form' === 'form' && is_array($count)) {
                foreach($count as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['count'] = $count;
            }
        }
        // query params
        if ($count_only !== null) {
            if('form' === 'form' && is_array($count_only)) {
                foreach($count_only as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['countOnly'] = $count_only;
            }
        }

        // header params
        if ($avalara_version !== null) {
            $headerParams['avalara-version'] = ObjectSerializer::toHeaderValue($avalara_version);
        }
        // header params
        if ($x_correlation_id !== null) {
            $headerParams['X-Correlation-Id'] = ObjectSerializer::toHeaderValue($x_correlation_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'text/plain']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'text/plain'],
                []
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.33; {$this->client->config->getMachineName()}";

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

        // this endpoint requires OAuth (access token)
        if ($this->client->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->client->config->getAccessToken();
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
     * Operation patchEntitlement
     *
     * Update selected fields in an entitlement.
     *
     * @param  string $entitlement_id entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement entitlement (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function patchEntitlement($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        $this->patchEntitlementWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement);
    }

    /**
     * Operation patchEntitlementWithHttpInfo
     *
     * Update selected fields in an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchEntitlementWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        $request = $this->patchEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement);

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
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\IAMDS\VersionError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation patchEntitlementAsync
     *
     * Update selected fields in an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchEntitlementAsync($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        return $this->patchEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation patchEntitlementAsyncWithHttpInfo
     *
     * Update selected fields in an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        $returnType = '';
        $request = $this->patchEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement);

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
     * Create request for operation 'patchEntitlement'
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function patchEntitlementRequest($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        // verify the required parameter 'entitlement_id' is set
        if ($entitlement_id === null || (is_array($entitlement_id) && count($entitlement_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entitlement_id when calling patchEntitlement'
            );
        }

        $resourcePath = '/entitlements/{entitlement-id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($avalara_version !== null) {
            $headerParams['avalara-version'] = ObjectSerializer::toHeaderValue($avalara_version);
        }
        // header params
        if ($x_correlation_id !== null) {
            $headerParams['X-Correlation-Id'] = ObjectSerializer::toHeaderValue($x_correlation_id);
        }
        // header params
        if ($if_match !== null) {
            $headerParams['If-Match'] = ObjectSerializer::toHeaderValue($if_match);
        }

        // path params
        if ($entitlement_id !== null) {
            $resourcePath = str_replace(
                '{' . 'entitlement-id' . '}',
                ObjectSerializer::toPathValue($entitlement_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['text/plain']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['text/plain'],
                ['application/json']
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.33; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (isset($entitlement)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($entitlement));
            } else {
                $httpBody = $entitlement;
            }
        } elseif (count($formParams) > 0) {
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

        // this endpoint requires OAuth (access token)
        if ($this->client->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->client->config->getAccessToken();
        }

        $defaultHeaders = [];
        
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PATCH',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation replaceEntitlement
     *
     * Update all fields in an entitlement.
     *
     * @param  string $entitlement_id entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement entitlement (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function replaceEntitlement($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        $this->replaceEntitlementWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement);
    }

    /**
     * Operation replaceEntitlementWithHttpInfo
     *
     * Update all fields in an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function replaceEntitlementWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        $request = $this->replaceEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement);

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
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Avalara\SDK\Model\IAMDS\VersionError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation replaceEntitlementAsync
     *
     * Update all fields in an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function replaceEntitlementAsync($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        return $this->replaceEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation replaceEntitlementAsyncWithHttpInfo
     *
     * Update all fields in an entitlement.
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function replaceEntitlementAsyncWithHttpInfo($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        $returnType = '';
        $request = $this->replaceEntitlementRequest($entitlement_id, $avalara_version, $x_correlation_id, $if_match, $entitlement);

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
     * Create request for operation 'replaceEntitlement'
     *
     * @param  string $entitlement_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\Entitlement $entitlement (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function replaceEntitlementRequest($entitlement_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $entitlement = null)
    {
        // verify the required parameter 'entitlement_id' is set
        if ($entitlement_id === null || (is_array($entitlement_id) && count($entitlement_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entitlement_id when calling replaceEntitlement'
            );
        }

        $resourcePath = '/entitlements/{entitlement-id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($avalara_version !== null) {
            $headerParams['avalara-version'] = ObjectSerializer::toHeaderValue($avalara_version);
        }
        // header params
        if ($x_correlation_id !== null) {
            $headerParams['X-Correlation-Id'] = ObjectSerializer::toHeaderValue($x_correlation_id);
        }
        // header params
        if ($if_match !== null) {
            $headerParams['If-Match'] = ObjectSerializer::toHeaderValue($if_match);
        }

        // path params
        if ($entitlement_id !== null) {
            $resourcePath = str_replace(
                '{' . 'entitlement-id' . '}',
                ObjectSerializer::toPathValue($entitlement_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['text/plain']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['text/plain'],
                ['application/json']
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.33; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (isset($entitlement)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($entitlement));
            } else {
                $httpBody = $entitlement;
            }
        } elseif (count($formParams) > 0) {
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

        // this endpoint requires OAuth (access token)
        if ($this->client->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->client->config->getAccessToken();
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
