<?php

namespace Volcengine\RoomManage;

use Volcengine\Kernel\BaseClient;
use Volcengine\Kernel\Traits\ApiCastable;

class Client extends BaseClient
{
    use ApiCastable;

    /**
     * 移出用户 KickUser
     * @see https://www.volcengine.com/docs/6348/69852
     * @param string $roomId
     * @param string $userId
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function kickUser(string $roomId, string $userId)
    {
        $results = $this->httpPostJson('/', [
            'AppId' => $this->app['config']->app_id,
            'RoomId' => $roomId,
            'UserId' => $userId,
        ], [
            'Action' => 'KickUser'
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 解散房间 DismissRoom
     * @see https://www.volcengine.com/docs/6348/69853
     * @param string $roomId
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function dismissRoom(string $roomId)
    {
        $results = $this->httpPostJson('/', [
            'AppId' => $this->app['config']->app_id,
            'RoomId' => $roomId,
        ], [
            'Action' => 'DismissRoom'
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 获取房间信息 ListRooms
     * @see https://www.volcengine.com/docs/6348/69854
     * @param string|null $roomId
     * @param bool        $reverse
     * @param int         $offset
     * @param int         $limit
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function listRooms(?string $roomId = null, bool $reverse = false, int $offset = 0, int $limit = 50)
    {
        $query = [
            'Action'  => 'ListRooms',
            'AppId'   => $this->app['config']->app_id,
            'Reverse' => $reverse ? 1 : 0,
            'Offset'  => $offset,
            'Limit'   => $limit,
        ];
        if ($roomId) {
            $query['RoomId'] = $roomId;
        }

        return $this->baseResponse($this->httpGet('/', $query));
    }

    /**
     * 获取用户信息 ListUsers
     * @see https://www.volcengine.com/docs/6348/69855
     * @param string      $roomId
     * @param bool        $reverse
     * @param int         $offset
     * @param int         $limit
     * @param int         $state
     * @param string|null $startTime
     * @param string|null $endTime
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function listUsers(string $roomId, bool $reverse = false, int $offset = 0, int $limit = 50, int $state = 1, ?string $startTime = null, ?string $endTime = null)
    {
        $query = [
            'Action'  => 'ListUsers',
            'AppId'   => $this->app['config']->app_id,
            'RoomId'  => $roomId,
            'Reverse' => $reverse ? 1 : 0,
            'State'   => $state,
            'Offset'  => $offset,
            'Limit'   => $limit,
        ];
        if ($startTime) {
            $query['StartTime'] = $startTime;
        }
        if ($endTime) {
            $query['EndTime'] = $endTime;
        }

        return $this->baseResponse($this->httpGet('/', $query));
    }
}