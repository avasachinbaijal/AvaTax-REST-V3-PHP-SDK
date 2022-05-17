<?php
/**
 * AppApi
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

class AppApi
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
     * Operation addGrantToApp
     *
     * Add a grant to an app.
     *
     * @param  string $app_id app_id (required)
     * @param  string $grant_id grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function addGrantToApp($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        $this->addGrantToAppWithHttpInfo($app_id, $grant_id, $avalara_version, $x_correlation_id);
    }

    /**
     * Operation addGrantToAppWithHttpInfo
     *
     * Add a grant to an app.
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function addGrantToAppWithHttpInfo($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        $request = $this->addGrantToAppRequest($app_id, $grant_id, $avalara_version, $x_correlation_id);

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
     * Operation addGrantToAppAsync
     *
     * Add a grant to an app.
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addGrantToAppAsync($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        return $this->addGrantToAppAsyncWithHttpInfo($app_id, $grant_id, $avalara_version, $x_correlation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addGrantToAppAsyncWithHttpInfo
     *
     * Add a grant to an app.
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addGrantToAppAsyncWithHttpInfo($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        $returnType = '';
        $request = $this->addGrantToAppRequest($app_id, $grant_id, $avalara_version, $x_correlation_id);

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
     * Create request for operation 'addGrantToApp'
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function addGrantToAppRequest($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling addGrantToApp'
            );
        }
        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $grant_id when calling addGrantToApp'
            );
        }

        $resourcePath = '/apps/{app-id}/grants/{grant-id}';
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

        // path params
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
                $resourcePath
            );
        }
        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant-id' . '}',
                ObjectSerializer::toPathValue($grant_id),
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
            'PUT',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createApp
     *
     * Add an app.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app app (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\IAMDS\App|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function createApp($avalara_version = null, $x_correlation_id = null, $app = null)
    {
        list($response) = $this->createAppWithHttpInfo($avalara_version, $x_correlation_id, $app);
        return $response;
    }

    /**
     * Operation createAppWithHttpInfo
     *
     * Add an app.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\IAMDS\App|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function createAppWithHttpInfo($avalara_version = null, $x_correlation_id = null, $app = null)
    {
        $request = $this->createAppRequest($avalara_version, $x_correlation_id, $app);

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
                    if ('\Avalara\SDK\Model\IAMDS\App' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\App', []),
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

            $returnType = '\Avalara\SDK\Model\IAMDS\App';
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
                        '\Avalara\SDK\Model\IAMDS\App',
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
     * Operation createAppAsync
     *
     * Add an app.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createAppAsync($avalara_version = null, $x_correlation_id = null, $app = null)
    {
        return $this->createAppAsyncWithHttpInfo($avalara_version, $x_correlation_id, $app)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAppAsyncWithHttpInfo
     *
     * Add an app.
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createAppAsyncWithHttpInfo($avalara_version = null, $x_correlation_id = null, $app = null)
    {
        $returnType = '\Avalara\SDK\Model\IAMDS\App';
        $request = $this->createAppRequest($avalara_version, $x_correlation_id, $app);

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
     * Create request for operation 'createApp'
     *
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createAppRequest($avalara_version = null, $x_correlation_id = null, $app = null)
    {

        $resourcePath = '/apps';
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
        if (isset($app)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($app));
            } else {
                $httpBody = $app;
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
     * Operation createAppSecret
     *
     * Create a new secret for the app.
     *
     * @param  string $app_id app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return string|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function createAppSecret($app_id, $avalara_version = null, $x_correlation_id = null)
    {
        list($response) = $this->createAppSecretWithHttpInfo($app_id, $avalara_version, $x_correlation_id);
        return $response;
    }

    /**
     * Operation createAppSecretWithHttpInfo
     *
     * Create a new secret for the app.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of string|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function createAppSecretWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null)
    {
        $request = $this->createAppSecretRequest($app_id, $avalara_version, $x_correlation_id);

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
                    if ('string' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'string', []),
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

            $returnType = 'string';
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
                        'string',
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
     * Operation createAppSecretAsync
     *
     * Create a new secret for the app.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createAppSecretAsync($app_id, $avalara_version = null, $x_correlation_id = null)
    {
        return $this->createAppSecretAsyncWithHttpInfo($app_id, $avalara_version, $x_correlation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createAppSecretAsyncWithHttpInfo
     *
     * Create a new secret for the app.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createAppSecretAsyncWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null)
    {
        $returnType = 'string';
        $request = $this->createAppSecretRequest($app_id, $avalara_version, $x_correlation_id);

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
     * Create request for operation 'createAppSecret'
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createAppSecretRequest($app_id, $avalara_version = null, $x_correlation_id = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling createAppSecret'
            );
        }

        $resourcePath = '/apps/{app-id}/secret';
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

        // path params
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
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
            'POST',
            $this->client->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteApp
     *
     * Delete an app by ID.
     *
     * @param  string $app_id app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteApp($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        $this->deleteAppWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_match);
    }

    /**
     * Operation deleteAppWithHttpInfo
     *
     * Delete an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteAppWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        $request = $this->deleteAppRequest($app_id, $avalara_version, $x_correlation_id, $if_match);

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
     * Operation deleteAppAsync
     *
     * Delete an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAppAsync($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        return $this->deleteAppAsyncWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_match)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAppAsyncWithHttpInfo
     *
     * Delete an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAppAsyncWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        $returnType = '';
        $request = $this->deleteAppRequest($app_id, $avalara_version, $x_correlation_id, $if_match);

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
     * Create request for operation 'deleteApp'
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteAppRequest($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling deleteApp'
            );
        }

        $resourcePath = '/apps/{app-id}';
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
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
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
     * Operation getApp
     *
     * Get an app by ID.
     *
     * @param  string $app_id app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\IAMDS\App|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function getApp($app_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        list($response) = $this->getAppWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_none_match);
        return $response;
    }

    /**
     * Operation getAppWithHttpInfo
     *
     * Get an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\IAMDS\App|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAppWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        $request = $this->getAppRequest($app_id, $avalara_version, $x_correlation_id, $if_none_match);

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
                    if ('\Avalara\SDK\Model\IAMDS\App' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\App', []),
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

            $returnType = '\Avalara\SDK\Model\IAMDS\App';
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
                        '\Avalara\SDK\Model\IAMDS\App',
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
     * Operation getAppAsync
     *
     * Get an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAppAsync($app_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        return $this->getAppAsyncWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_none_match)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAppAsyncWithHttpInfo
     *
     * Get an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAppAsyncWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        $returnType = '\Avalara\SDK\Model\IAMDS\App';
        $request = $this->getAppRequest($app_id, $avalara_version, $x_correlation_id, $if_none_match);

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
     * Create request for operation 'getApp'
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_none_match Only return the resource if the ETag is different from the ETag passed in. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getAppRequest($app_id, $avalara_version = null, $x_correlation_id = null, $if_none_match = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling getApp'
            );
        }

        $resourcePath = '/apps/{app-id}';
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
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
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
     * Operation listAppGrants
     *
     * List all grants for a given app.
     *
     * @param  string $app_id app_id (required)
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
     * @return \Avalara\SDK\Model\IAMDS\AppList|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function listAppGrants($app_id, $filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        list($response) = $this->listAppGrantsWithHttpInfo($app_id, $filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);
        return $response;
    }

    /**
     * Operation listAppGrantsWithHttpInfo
     *
     * List all grants for a given app.
     *
     * @param  string $app_id (required)
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
     * @return array of \Avalara\SDK\Model\IAMDS\AppList|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function listAppGrantsWithHttpInfo($app_id, $filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        $request = $this->listAppGrantsRequest($app_id, $filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);

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
                    if ('\Avalara\SDK\Model\IAMDS\AppList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\AppList', []),
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

            $returnType = '\Avalara\SDK\Model\IAMDS\AppList';
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
                        '\Avalara\SDK\Model\IAMDS\AppList',
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
     * Operation listAppGrantsAsync
     *
     * List all grants for a given app.
     *
     * @param  string $app_id (required)
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
    public function listAppGrantsAsync($app_id, $filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        return $this->listAppGrantsAsyncWithHttpInfo($app_id, $filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listAppGrantsAsyncWithHttpInfo
     *
     * List all grants for a given app.
     *
     * @param  string $app_id (required)
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
    public function listAppGrantsAsyncWithHttpInfo($app_id, $filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        $returnType = '\Avalara\SDK\Model\IAMDS\AppList';
        $request = $this->listAppGrantsRequest($app_id, $filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);

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
     * Create request for operation 'listAppGrants'
     *
     * @param  string $app_id (required)
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
    public function listAppGrantsRequest($app_id, $filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling listAppGrants'
            );
        }

        $resourcePath = '/apps/{app-id}/grants';
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

        // path params
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
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
     * Operation listApps
     *
     * List apps which the user has access to.
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
     * @return \Avalara\SDK\Model\IAMDS\AppList|\Avalara\SDK\Model\IAMDS\VersionError
     */
    public function listApps($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        list($response) = $this->listAppsWithHttpInfo($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);
        return $response;
    }

    /**
     * Operation listAppsWithHttpInfo
     *
     * List apps which the user has access to.
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
     * @return array of \Avalara\SDK\Model\IAMDS\AppList|\Avalara\SDK\Model\IAMDS\VersionError, HTTP status code, HTTP response headers (array of strings)
     */
    public function listAppsWithHttpInfo($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        $request = $this->listAppsRequest($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);

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
                    if ('\Avalara\SDK\Model\IAMDS\AppList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\IAMDS\AppList', []),
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

            $returnType = '\Avalara\SDK\Model\IAMDS\AppList';
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
                        '\Avalara\SDK\Model\IAMDS\AppList',
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
     * Operation listAppsAsync
     *
     * List apps which the user has access to.
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
    public function listAppsAsync($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        return $this->listAppsAsyncWithHttpInfo($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listAppsAsyncWithHttpInfo
     *
     * List apps which the user has access to.
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
    public function listAppsAsyncWithHttpInfo($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {
        $returnType = '\Avalara\SDK\Model\IAMDS\AppList';
        $request = $this->listAppsRequest($filter, $top, $skip, $order_by, $count, $count_only, $avalara_version, $x_correlation_id);

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
     * Create request for operation 'listApps'
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
    public function listAppsRequest($filter = null, $top = null, $skip = null, $order_by = null, $count = null, $count_only = null, $avalara_version = null, $x_correlation_id = null)
    {

        $resourcePath = '/apps';
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
     * Operation patchApp
     *
     * Update only fields in the body for the app.
     *
     * @param  string $app_id app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app app (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function patchApp($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        $this->patchAppWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_match, $app);
    }

    /**
     * Operation patchAppWithHttpInfo
     *
     * Update only fields in the body for the app.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchAppWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        $request = $this->patchAppRequest($app_id, $avalara_version, $x_correlation_id, $if_match, $app);

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
     * Operation patchAppAsync
     *
     * Update only fields in the body for the app.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchAppAsync($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        return $this->patchAppAsyncWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_match, $app)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation patchAppAsyncWithHttpInfo
     *
     * Update only fields in the body for the app.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchAppAsyncWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        $returnType = '';
        $request = $this->patchAppRequest($app_id, $avalara_version, $x_correlation_id, $if_match, $app);

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
     * Create request for operation 'patchApp'
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function patchAppRequest($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling patchApp'
            );
        }

        $resourcePath = '/apps/{app-id}';
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
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
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
        if (isset($app)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($app));
            } else {
                $httpBody = $app;
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
     * Operation removeGrantFromApp
     *
     * Remove a grant from an app.
     *
     * @param  string $app_id app_id (required)
     * @param  string $grant_id grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function removeGrantFromApp($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        $this->removeGrantFromAppWithHttpInfo($app_id, $grant_id, $avalara_version, $x_correlation_id);
    }

    /**
     * Operation removeGrantFromAppWithHttpInfo
     *
     * Remove a grant from an app.
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function removeGrantFromAppWithHttpInfo($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        $request = $this->removeGrantFromAppRequest($app_id, $grant_id, $avalara_version, $x_correlation_id);

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
     * Operation removeGrantFromAppAsync
     *
     * Remove a grant from an app.
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function removeGrantFromAppAsync($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        return $this->removeGrantFromAppAsyncWithHttpInfo($app_id, $grant_id, $avalara_version, $x_correlation_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation removeGrantFromAppAsyncWithHttpInfo
     *
     * Remove a grant from an app.
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function removeGrantFromAppAsyncWithHttpInfo($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        $returnType = '';
        $request = $this->removeGrantFromAppRequest($app_id, $grant_id, $avalara_version, $x_correlation_id);

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
     * Create request for operation 'removeGrantFromApp'
     *
     * @param  string $app_id (required)
     * @param  string $grant_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function removeGrantFromAppRequest($app_id, $grant_id, $avalara_version = null, $x_correlation_id = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling removeGrantFromApp'
            );
        }
        // verify the required parameter 'grant_id' is set
        if ($grant_id === null || (is_array($grant_id) && count($grant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $grant_id when calling removeGrantFromApp'
            );
        }

        $resourcePath = '/apps/{app-id}/grants/{grant-id}';
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

        // path params
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
                $resourcePath
            );
        }
        // path params
        if ($grant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'grant-id' . '}',
                ObjectSerializer::toPathValue($grant_id),
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
     * Operation replaceApp
     *
     * Update all fields in an app by ID.
     *
     * @param  string $app_id app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app app (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function replaceApp($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        $this->replaceAppWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_match, $app);
    }

    /**
     * Operation replaceAppWithHttpInfo
     *
     * Update all fields in an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function replaceAppWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        $request = $this->replaceAppRequest($app_id, $avalara_version, $x_correlation_id, $if_match, $app);

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
     * Operation replaceAppAsync
     *
     * Update all fields in an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function replaceAppAsync($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        return $this->replaceAppAsyncWithHttpInfo($app_id, $avalara_version, $x_correlation_id, $if_match, $app)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation replaceAppAsyncWithHttpInfo
     *
     * Update all fields in an app by ID.
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function replaceAppAsyncWithHttpInfo($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        $returnType = '';
        $request = $this->replaceAppRequest($app_id, $avalara_version, $x_correlation_id, $if_match, $app);

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
     * Create request for operation 'replaceApp'
     *
     * @param  string $app_id (required)
     * @param  string $avalara_version States the version of the API to use. (optional)
     * @param  string $x_correlation_id Correlation ID to pass into the method. Returned in any response. (optional)
     * @param  string $if_match Only execute the operation if the ETag for the current version of the resource matches the ETag in this header. (optional)
     * @param  \Avalara\SDK\Model\IAMDS\App $app (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function replaceAppRequest($app_id, $avalara_version = null, $x_correlation_id = null, $if_match = null, $app = null)
    {
        // verify the required parameter 'app_id' is set
        if ($app_id === null || (is_array($app_id) && count($app_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $app_id when calling replaceApp'
            );
        }

        $resourcePath = '/apps/{app-id}';
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
        if ($app_id !== null) {
            $resourcePath = str_replace(
                '{' . 'app-id' . '}',
                ObjectSerializer::toPathValue($app_id),
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
        if (isset($app)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($app));
            } else {
                $httpBody = $app;
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
