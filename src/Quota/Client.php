<?php

namespace Volcengine\Rtc\Quota;

use DateTimeInterface;
use Volcengine\Kernel\Traits\ApiCastable;
use Volcengine\Rtc\Kernel\BaseClient;

class Client extends BaseClient
{
    use ApiCastable;

    /**
     * 获取质量数据 ListIndicators
     * @see https://www.volcengine.com/docs/6348/71098
     * @param DateTimeInterface $startTime
     * @param DateTimeInterface $endTime
     * @param string       $indicator
     * @param string|null  $os
     * @param string|null  $network
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function listIndicators(DateTimeInterface $startTime, DateTimeInterface $endTime, string $indicator, ?string $os = null, ?string $network = null)
    {
        $results = $this->request('/', 'GET', [
            'query' => [
                'Action' => 'ListIndicators'
            ],
            'json' => array_merge([
                'AppId' => $this->app['config']->app_id,
                'StartTime' => $startTime->format(DATE_RFC3339),
                'EndTime' => $endTime->format(DATE_RFC3339),
                'Indicator' => $indicator
            ], array_filter([
                'OS' => $os,
                'Network' => $network
            ])),
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 获取通话时长数据 ListUsages
     * @see https://www.volcengine.com/docs/6348/71234
     * @param DateTimeInterface $startTime
     * @param DateTimeInterface $endTime
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function listUsages(DateTimeInterface $startTime, DateTimeInterface $endTime)
    {
        $results = $this->request('/', 'GET', [
            'query' => [
                'Action' => 'ListUsages'
            ],
            'json' => [
                'AppId' => $this->app['config']->app_id,
                'StartTime' => $startTime->format(DATE_RFC3339),
                'EndTime' => $endTime->format(DATE_RFC3339),
            ],
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 获取并发用户数峰值数据 ListConcurrentData
     * @see https://www.volcengine.com/docs/6348/71235
     * @param DateTimeInterface $startTime
     * @param DateTimeInterface $endTime
     * @param string            $indicator
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function listConcurrentData(DateTimeInterface $startTime, DateTimeInterface $endTime, string $indicator)
    {
        $results = $this->request('/', 'GET', [
            'query' => [
                'Action' => 'ListConcurrentData'
            ],
            'json' => [
                'AppId' => $this->app['config']->app_id,
                'StartTime' => $startTime->format(DATE_RFC3339),
                'EndTime' => $endTime->format(DATE_RFC3339),
                'Indicator' => $indicator,
            ],
        ]);

        return $this->baseResponse($results);
    }
}
