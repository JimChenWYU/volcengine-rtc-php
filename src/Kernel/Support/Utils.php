<?php

namespace Volcengine\Kernel\Support;

class Utils
{
    /**
     * @param string $httpMethod
     * @param string $uri
     * @param string $query
     * @param string $canonicalHeadersString
     * @param string $signedHeadersString
     * @param string $body
     * @return string
     */
    public static function createCanonicalRequest(string $httpMethod, string $uri, string $query, string $canonicalHeadersString, string $signedHeadersString, string $body)
    {
        $payload = hash('sha256', $body, true);
        return "{$httpMethod}\n{$uri}\n{$query}\n{$canonicalHeadersString}\n{$signedHeadersString}\n{$payload}";
    }

    /**
     * @param array $headers
     * @return string
     */
    public static function createSignedHeadersString(array $headers)
    {
        return implode(';', array_keys($headers));
    }

    /**
     * @param array $headers
     * @return string
     */
    public static function createCanonicalHeadersString(array $headers)
    {
        $canonicalHeaders = '';
        foreach ($headers as $headerName => $value) {
            $headerName = strtolower($headerName);
            $canonicalHeadersEntry = $headerName . ':' . trim($value) . "\n";
            $canonicalHeaders .= $canonicalHeadersEntry;
        }
        return $canonicalHeaders;
    }

    /**
     * @param string $accessKeyId
     * @param string $nowTime
     * @param string $region
     * @param string $service
     * @return string
     */
    public static function createCredentialScope(string $accessKeyId, string $nowTime, string $region, string $service)
    {
        return "{$accessKeyId}/{$nowTime}/{$region}/{$service}/request";
    }

    /**
     * @param string $signString
     * @param string $signKey
     * @return false|string
     */
    public static function generateSign(string $signString, string $signKey)
    {
        return hash_hmac('sha256', $signString, $signKey);
    }

    /**
     * @param string $longDate
     * @param string $credentialScope
     * @param string $canonicalRequest
     * @param string $algo
     * @return string
     */
    public static function generateSignString(string $longDate, string $credentialScope, string $canonicalRequest, string $algo = 'HMAC-SHA256')
    {
        $hash = hash('sha256', $canonicalRequest);
        return "{$algo}\n{$longDate}\n{$credentialScope}\n{$hash}";
    }

    /**
     * @param string $shortDate
     * @param string $region
     * @param string $service
     * @param string $accessKeyId
     * @return false|string
     */
    public static function generateSignKey(string $shortDate, string $region, string $service, string $accessKeyId)
    {
        $kDate = hash_hmac('sha256', $shortDate, $accessKeyId, true);
        $kRegion = hash_hmac('sha256', $region, $kDate, true);
        $kService = hash_hmac('sha256', $service, $kRegion, true);
        return hash_hmac('sha256', 'request', $kService, true);
    }
}
