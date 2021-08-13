<?php

namespace Volcengine\Rtc\Tests\RoomManage;

use Volcengine\Kernel\DataStructs\BaseResponse;
use Volcengine\Rtc\Application;
use Volcengine\Rtc\RoomManage\Client;

class ClientTest extends \Volcengine\Rtc\Tests\TestCase
{
    protected function app()
    {
        return new Application([
            'key' => 'mock-key',
            'app_id' => 'mock-appid',
        ]);
    }

    public function testKickUser()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['kickUser'], $app)->makePartial();

        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'RoomId' => '1',
            'UserId'   => '1',
        ], [
            'Action' => 'KickUser'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->kickUser(
            '1',
            '1'
        ));
    }

    public function testDismissRoom()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['dismissRoom'], $app)->makePartial();

        $client->expects()->httpPostJson('/', [
            'AppId' => 'mock-appid',
            'RoomId' => '1',
        ], [
            'Action' => 'DismissRoom'
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->dismissRoom(
            '1'
        ));
    }

    public function testListRooms()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['listRooms'], $app)->makePartial();

        $client->expects()->httpGet('/', [
            'AppId' => 'mock-appid',
            'Action' => 'ListRooms',
            'Reverse' => 1,
            'Offset' => 0,
            'Limit' => 50
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->listRooms(null, true, 0, 50));
    }

    public function testListUsers()
    {
        $app = $this->app();

        $client = $this->mockApiClient(Client::class, ['listUsers'], $app)->makePartial();

        $client->expects()->httpGet('/', [
            'AppId' => 'mock-appid',
            'Action' => 'ListUsers',
            'RoomId' => '1',
            'Reverse' => 1,
            'State'   => 1,
            'Offset' => 0,
            'Limit' => 50,
            'StartTime' => '1627056000',
            'EndTime'   => '1627401600',
        ])->andReturn(["success" => true]);
        $this->assertInstanceOf(BaseResponse::class, $client->listUsers('1', true, 0, 50, 1, new \DateTime('@1627056000'), new \DateTime('@1627401600')));
    }
}
