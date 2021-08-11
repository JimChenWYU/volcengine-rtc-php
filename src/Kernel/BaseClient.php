<?php

namespace Volcengine\Kernel;

use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Volcengine\Kernel\Exceptions\InvalidConfigException;
use Volcengine\Kernel\Support\Collection;
use Volcengine\Kernel\Support\Utils;
use Volcengine\Kernel\Traits\HasHttpRequests;

class BaseClient
{
    use HasHttpRequests {
        request as performRequest;
    }

    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * BaseClient constructor.
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * GET request.
     *
     * @return ResponseInterface|Collection|array|object|string
     *
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpGet(string $url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    /**
     * POST request.
     *
     * @return ResponseInterface|Collection|array|object|string
     *
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpPost(string $url, array $data = [])
    {
        return $this->request($url, 'POST', ['form_params' => $data]);
    }

    /**
     * JSON request.
     *
     * @return ResponseInterface|Collection|array|object|string
     *
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpPostJson(string $url, array $data = [], array $query = [])
    {
        return $this->request($url, 'POST', ['query' => $query, 'json' => $data]);
    }

    /**
     * @param bool $returnRaw
     *
     * @return ResponseInterface|Collection|array|object|string
     *
     * @throws InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $body = $options['body'] ?? json_encode($options['json']);
        $uri = parse_url($url, PHP_URL_PATH);
        $query = http_build_query(array_merge($options['query'], [
            'Version' => $this->getVersion()
        ]));
        $publicHeaders = $this->getRtcPublicHeaders($this->app['config']->access_key_id, $body, $method, $uri, $query);
        $options['headers'] = $options['headers'] ?? array_merge($options['headers'], $publicHeaders);

        $response = $this->performRequest($url, $method, $options);

        return $returnRaw ? $response : $this->castResponseToType($response, 'collection');
    }

    private function getRtcPublicHeaders(string $accessKeyId, string $body, string $method, string $uri, string $query)
    {
        $longDate = gmdate('Ymd\THis\Z');
        $shortDate = substr($longDate, 0, 8);

        $headers = [
            'Host'             => parse_url($this->baseUri ?? $this->app['config']->get('http.base_uri'), PHP_URL_HOST),
            'Content-Type'     => 'application/x-www-form-urlencoded; charset=utf-8',
            'Accept'           => 'application/json',
            'X-Date	'          => gmdate(DATE_ATOM),
            'X-Content-Sha256' => hash('sha256', $body),
            'Version'          => $this->getVersion(),
        ];
        $headers['Authorization'] = vsprintf("%s Credential=%s, SignedHeaders=%s, Signature=%s", [
            'HMAC-SHA256',
            $cs = Utils::createCredentialScope($accessKeyId, $shortDate, $region = $this->getRegion(), $this->getService()),
            $shs = Utils::createSignedHeadersString($headers),
            Utils::generateSign(
                Utils::generateSignString(
                    $longDate,
                    $cs,
                    Utils::createCanonicalRequest($method, $uri, $query, Utils::createCanonicalHeadersString($headers), $shs, $body)
                ),
                Utils::generateSignKey($shortDate, $region, 'rtc', $accessKeyId)
            )
        ]);

        return $headers;
    }

    protected function getRegion()
    {
        return 'cn-north-1';
    }

    protected function getService()
    {
        return 'rtc';
    }

    protected function getVersion()
    {
        return '2020-12-01';
    }

    /**
     * Register Guzzle middlewares.
     */
    protected function registerHttpMiddlewares()
    {
        // retry
        $this->pushMiddleware($this->retryMiddleware(), 'retry');
        // log
        $this->pushMiddleware($this->logMiddleware(), 'log');
    }

    /**
     * Log the request.
     *
     * @return callable
     */
    protected function logMiddleware()
    {
        $formatter = new MessageFormatter($this->app['config']['http.log_template'] ?? MessageFormatter::DEBUG);

        return Middleware::log($this->app['logger'], $formatter, LogLevel::DEBUG);
    }

    /**
     * Return retry middleware.
     *
     * @return callable
     */
    protected function retryMiddleware()
    {
        return Middleware::retry(function (
            $retries,
            RequestInterface $request,
            ResponseInterface $response = null
        ) {
            // Limit the number of retries to 2
            if ($retries < $this->app['config']->get(
                    'http.max_retries',
                    1
                ) && $response && $body = $response->getBody()) {
                // Retry on server errors
                $response = json_decode($body, true);
                if (isset($response['ResponseMetadata']['Error'])) {
                    if ($response['ResponseMetadata']['Error']['Code'] === 'InternalError.UnknownInternalError') {
                        $this->app['logger']->debug('Retrying with `InternalError.UnknownInternalError`.');
                        return true;
                    }
                }
            }

            return false;
        }, function () {
            return abs($this->app['config']->get('http.retry_delay', 500));
        });
    }
}
