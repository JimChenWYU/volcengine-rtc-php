<?php

namespace Volcengine\Rtc\Tests\Quota;

use Volcengine\Kernel\DataStructs\BaseResponse;
use Volcengine\Rtc\Application;
use Volcengine\Rtc\Quota\Client;
use Volcengine\Rtc\Tests\TestCase;

class ClientTest extends TestCase
{
    protected function app()
    {
        return new Application([
            'key' => 'mock-key',
            'app_id' => 'mock-appid',
        ]);
    }

    public function testListIndicators()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['listIndicators'], $app)->makePartial();

        $params = [
            'AppId' => 'mock-appid',
            'StartTime' => '2021-07-24T00:00:00+08:00',
            'EndTime'   => '2021-07-28T00:00:00+08:00',
            'Indicator' => 'NetworkTransDelay',
        ];
        $client->expects()->request('/', 'GET', [
            'query' => [
                'Action' => 'ListIndicators'
            ],
            'json' => $params
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->listIndicators(
            (new \DateTime('2021-07-24T00:00:00+08:00')),
            (new \DateTime('2021-07-28T00:00:00+08:00')),
            'NetworkTransDelay'
        ));
    }

    public function testListUsages()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['listUsages'], $app)->makePartial();

        $params = [
            'AppId' => 'mock-appid',
            'StartTime' => '2021-07-24T00:00:00+08:00',
            'EndTime'   => '2021-07-28T00:00:00+08:00',
        ];
        $client->expects()->request('/', 'GET', [
            'query' => [
                'Action' => 'ListUsages'
            ],
            'json' => $params
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->listUsages(
            new \DateTime('2021-07-24T00:00:00+08:00'),
            new \DateTime('2021-07-28T00:00:00+08:00')
        ));
    }

    public function testListConcurrentData()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['listConcurrentData'], $app)->makePartial();

        $params = [
            'AppId' => 'mock-appid',
            'StartTime' => '2021-07-24T00:00:00+08:00',
            'EndTime'   => '2021-07-28T00:00:00+08:00',
            'Indicator' => 'NetworkTransDelay',
        ];
        $client->expects()->request('/', 'GET', [
            'query' => [
                'Action' => 'ListConcurrentData'
            ],
            'json' => $params
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->listConcurrentData(
            new \DateTime('2021-07-24T00:00:00+08:00'),
            new \DateTime('2021-07-28T00:00:00+08:00'),
            'NetworkTransDelay'
        ));
    }
}
