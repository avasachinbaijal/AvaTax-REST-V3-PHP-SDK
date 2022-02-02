<?php
/**
 * AgeVerificationApi
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
 * Avalara Shipping Verification only
 *
 * API for evaluating transactions against direct-to-consumer Beverage Alcohol shipping regulations.  This API is currently in beta.
 *
 * @category   Avalara client libraries
 * @package    Avalara\SDK\API
 * @author     Sachin Baijal <sachin.baijal@avalara.com>
 * @author     Jonathan Wenger <jonathan.wenger@avalara.com>
 * @copyright  2004-2022 Avalara, Inc.
 * @license    https://www.apache.org/licenses/LICENSE-2.0
 * @version    2.4.7.2
 * @link       https://github.com/avadev/AvaTax-REST-V3-PHP-SDK

 */



namespace Avalara\SDK\API;

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

class AgeVerificationApi
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
        $client->setSdkVersion("2.4.7.2");
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
     * Operation verifyAge
     *
     * Determines whether an individual meets or exceeds the minimum legal drinking age.
     *
     * @param  \Avalara\SDK\Model\AgeVerifyRequest $age_verify_request Information about the individual whose age is being verified. (required)
     * @param  \Avalara\SDK\Model\AgeVerifyFailureCode $simulated_failure_code (Optional) The failure code included in the simulated response of the endpoint. Note that this endpoint is only available in Sandbox for testing purposes. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Avalara\SDK\Model\AgeVerifyResult
     */
    public function verifyAge($age_verify_request, $simulated_failure_code = null)
    {
        list($response) = $this->verifyAgeWithHttpInfo($age_verify_request, $simulated_failure_code);
        return $response;
    }

    /**
     * Operation verifyAgeWithHttpInfo
     *
     * Determines whether an individual meets or exceeds the minimum legal drinking age.
     *
     * @param  \Avalara\SDK\Model\AgeVerifyRequest $age_verify_request Information about the individual whose age is being verified. (required)
     * @param  \Avalara\SDK\Model\AgeVerifyFailureCode $simulated_failure_code (Optional) The failure code included in the simulated response of the endpoint. Note that this endpoint is only available in Sandbox for testing purposes. (optional)
     *
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Avalara\SDK\Model\AgeVerifyResult, HTTP status code, HTTP response headers (array of strings)
     */
    public function verifyAgeWithHttpInfo($age_verify_request, $simulated_failure_code = null)
    {
        $request = $this->verifyAgeRequest($age_verify_request, $simulated_failure_code);

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
                    if ('\Avalara\SDK\Model\AgeVerifyResult' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Avalara\SDK\Model\AgeVerifyResult', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Avalara\SDK\Model\AgeVerifyResult';
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
                        '\Avalara\SDK\Model\AgeVerifyResult',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation verifyAgeAsync
     *
     * Determines whether an individual meets or exceeds the minimum legal drinking age.
     *
     * @param  \Avalara\SDK\Model\AgeVerifyRequest $age_verify_request Information about the individual whose age is being verified. (required)
     * @param  \Avalara\SDK\Model\AgeVerifyFailureCode $simulated_failure_code (Optional) The failure code included in the simulated response of the endpoint. Note that this endpoint is only available in Sandbox for testing purposes. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifyAgeAsync($age_verify_request, $simulated_failure_code = null)
    {
        return $this->verifyAgeAsyncWithHttpInfo($age_verify_request, $simulated_failure_code)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation verifyAgeAsyncWithHttpInfo
     *
     * Determines whether an individual meets or exceeds the minimum legal drinking age.
     *
     * @param  \Avalara\SDK\Model\AgeVerifyRequest $age_verify_request Information about the individual whose age is being verified. (required)
     * @param  \Avalara\SDK\Model\AgeVerifyFailureCode $simulated_failure_code (Optional) The failure code included in the simulated response of the endpoint. Note that this endpoint is only available in Sandbox for testing purposes. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifyAgeAsyncWithHttpInfo($age_verify_request, $simulated_failure_code = null)
    {
        $returnType = '\Avalara\SDK\Model\AgeVerifyResult';
        $request = $this->verifyAgeRequest($age_verify_request, $simulated_failure_code);

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
     * Create request for operation 'verifyAge'
     *
     * @param  \Avalara\SDK\Model\AgeVerifyRequest $age_verify_request Information about the individual whose age is being verified. (required)
     * @param  \Avalara\SDK\Model\AgeVerifyFailureCode $simulated_failure_code (Optional) The failure code included in the simulated response of the endpoint. Note that this endpoint is only available in Sandbox for testing purposes. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function verifyAgeRequest($age_verify_request, $simulated_failure_code = null)
    {
        // verify the required parameter 'age_verify_request' is set
        if ($age_verify_request === null || (is_array($age_verify_request) && count($age_verify_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $age_verify_request when calling verifyAge'
            );
        }

        $resourcePath = '/api/v2/ageverification/verify';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($simulated_failure_code !== null) {
            if('form' === 'form' && is_array($simulated_failure_code)) {
                foreach($simulated_failure_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['simulatedFailureCode'] = $simulated_failure_code;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }
        $clientId="{$this->client->config->getAppName()}; {$this->client->config->getAppVersion()}; PhpRestClient; 2.4.7.2; {$this->client->config->getMachineName()}";

        $headers['X-Avalara-Client']=$clientId;

        // for model (json/xml)
        if (isset($age_verify_request)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($age_verify_request));
            } else {
                $httpBody = $age_verify_request;
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
            'POST',
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
