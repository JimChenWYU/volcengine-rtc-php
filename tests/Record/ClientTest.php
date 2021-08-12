<?php

namespace Volcengine\Rtc\Tests\Record;

use Volcengine\Kernel\DataStructs\BaseResponse;
use Volcengine\Rtc\Application;
use Volcengine\Rtc\Record\Client;
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

    public function testStartRecord()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['startRecord'], $app)->makePartial();
        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'BusinessId' => '1',
            'RoomId' => '2',
            'TaskId' => '3',
            'RecordMode' => 2,
        ], [
            'Action' => 'StartRecord'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->startRecord(
            '1',
            '2',
            '3',
            2
        ));
    }

    public function testUpdateRecord()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['updateRecord'], $app)->makePartial();
        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'BusinessId' => '1',
            'RoomId' => '2',
            'TaskId' => '3',
        ], [
            'Action' => 'UpdateRecord'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->updateRecord(
            '1',
            '2',
            '3'
        ));
    }

    public function testStopRecord()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['stopRecord'], $app)->makePartial();
        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'BusinessId' => '1',
            'RoomId' => '2',
            'TaskId' => '3',
        ], [
            'Action' => 'StopRecord'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->stopRecord(
            '1',
            '2',
            '3'
        ));
    }

    public function testGetRecordTask()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['getRecordTask'], $app)->makePartial();
        $client->expects()->httpGet('/', [
            'AppId' => 'mock-appid',
            'Action' => 'GetRecordTask',
            'RoomId' => '1',
            'TaskId' => '2',
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->getRecordTask(
            '1',
            '2'
        ));
    }
}
