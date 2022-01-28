<?php
/**
 * ApiClient.php
 * PHP version 7.3
 *
 * @category Class
 * @package  Avalara\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Avalara Shipping Verification for Beverage Alcohol
 *
 * API for evaluating transactions against direct-to-consumer Beverage Alcohol shipping regulations.  This API is currently in beta.
 *
 * The version of the OpenAPI document: 2.1.0-beta
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Avalara\SDK;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Avalara\SDK\ApiException;
use Avalara\SDK\Configuration;
use Avalara\SDK\HeaderSelector;
use Avalara\SDK\ObjectSerializer;

/**
 * ApiClient Class Doc Comment
 *
 * @category Class
 * @package  Avalara\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ApiClient
{
    /**
     * @var GuzzleHttp\Client
     */
    public $client;

    /**
     * @var string
     */
    public $sdkVersion;

    /**
     * @var Configuration
     */
    public $config;

    /**
     * @var HeaderSelector
     */
    public $headerSelector;

    

    /**
     * @param Configuration   $config
     */
    public function __construct(
        Configuration $config = null
    ) {

        if (is_null($config)){
            throw new ApiException("Configuration is not set or null");
        }

        $this->config = $config;
        $this->environment = $this->config->getEnvironment();
        
        if (strtolower($this->environment)=="sandbox"){
            $this->config->setHost('https://sandbox-rest.avatax.com');
        }
        elseif(strtolower($this->environment)=="production"){
            $this->config->setHost("https://rest.avatax.com");
        }
        else{
            throw new ApiException("Environment is not set correctly.");
        }

        $this->client = new Client();
                
        $this->headerSelector =  new HeaderSelector();
    }

    /**
     * Sets the sdkVersion
     *
     * @param string $sdkVersion 
     *
     * @return $this
     */
    public function setSdkVersion($sdkVersion)
    {
        $this->sdkVersion = $sdkVersion;
        return $this;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
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
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
       
    /**
     * Operation send_sync
     *
     * Executes http request synchronously
     *
     * @param  GuzzleHttp\Request
     * @param array of http client options
     * @param  \returnType
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return Http response
     */
    public function send_sync($request, $options)
    {
        return $this->client->send($request, $options);
    }

     /**
     * Operation send_async
     *
     * Executes http request synchronously
     *
     * @param  GuzzleHttp\Request
     * @param array of http client options
     * @param  \returnType
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return Http response
     */
    public function send_async($request, $options)
    {
        return $this->client->sendAsync($request, $options);
    }

    /**
     * Operation exec_sync_http_request
     *
     * Executes http request synchronously
     *
     * @param  GuzzleHttp\Request
     * @param array of http client options
     * @param  \returnType
     * @throws \Avalara\SDK\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return Http response
     */
    public function exec_async_http_request($request, $options)
    {
        return $this->client
            ->sendAsync($request, $options)
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

}