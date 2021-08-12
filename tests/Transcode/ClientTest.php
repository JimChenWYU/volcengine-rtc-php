<?php

namespace Volcengine\Rtc\Tests\Transcode;

use Volcengine\Kernel\DataStructs\BaseResponse;
use Volcengine\Rtc\Application;
use Volcengine\Rtc\Tests\TestCase;
use Volcengine\Rtc\Transcode\Client;

class ClientTest extends TestCase
{
    protected function app()
    {
        return new Application([
            'key' => 'mock-key',
            'app_id' => 'mock-appid',
        ]);
    }

    public function testStartTranscode()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['startTranscode'], $app)->makePartial();
        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'BusinessId' => '1',
            'RoomId' => '2',
            'TaskId' => '3',
            'PushURL' => 'http://volcengine.org',
        ], [
            'Action' => 'StartTranscode'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->startTranscode(
            '1',
            '2',
            '3',
            'http://volcengine.org'
        ));
    }

    public function testUpdateTranscode()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['updateTranscode'], $app)->makePartial();
        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'BusinessId' => '1',
            'RoomId' => '2',
            'TaskId' => '3',
        ], [
            'Action' => 'UpdateTranscode'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->updateTranscode(
            '1',
            '2',
            '3'
        ));
    }

    public function testStopTranscode()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['stopTranscode'], $app)->makePartial();
        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'BusinessId' => '1',
            'RoomId' => '2',
            'TaskId' => '3',
        ], [
            'Action' => 'StopTranscode'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->stopTranscode(
            '1',
            '2',
            '3'
        ));
    }
}
