<?php

namespace Volcengine\Rtc\Kernel;

use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Volcengine\Rtc\Kernel\Support\Utils;

class BaseClient extends \Volcengine\Kernel\BaseClient
{
    public function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        $this->pushMiddleware($this->publicHeaderMiddleware(), 'public_headers');
        return parent::request($url, $method, $options, $returnRaw);
    }

    protected function publicHeaderMiddleware()
    {
        return Middleware::tap(function (
            RequestInterface $request,
            array $options
        ) {
            $method = $request->getMethod();
            $body = $options['body'] ?? (isset($options['json']) ? json_encode($options['json']) : '');
            $uri = $request->getUri()->getPath() ?: '/';
            $query = $request->getUri()->getQuery() ?: http_build_query(array_merge($options['query'], [
                'Version' => $this->getVersion()
            ]));
            $publicHeaders = $this->generateRtcPublicHeaders($this->app['config']->access_key_id, $body, $method, $uri, $query);
            foreach ($publicHeaders as $name => $value) {
                $request->withHeader($name, $value);
            }
        });
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

    private function generateRtcPublicHeaders(string $accessKeyId, string $body, string $method, string $uri, string $query)
    {
        $longDate = gmdate('Ymd\THis\Z');
        $shortDate = substr($longDate, 0, 8);

        $headers = [
            'Host'             => parse_url($this->baseUri ?: $this->app['config']->get('http.base_uri'), PHP_URL_HOST),
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
}
