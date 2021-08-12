<?php

namespace Volcengine\Rtc\Transcode;

use Volcengine\Kernel\Traits\ApiCastable;
use Volcengine\Rtc\Kernel\BaseClient;
use Volcengine\Rtc\Kernel\DataStructs\Control;
use Volcengine\Rtc\Kernel\DataStructs\Encode;
use Volcengine\Rtc\Kernel\DataStructs\Layout;
use Volcengine\Rtc\Kernel\DataStructs\Streams;

class Client extends BaseClient
{
    use ApiCastable;

    /**
     * 开始合流转推 StartTranscode
     * @see https://www.volcengine.com/docs/6348/69850
     * @param string       $businessId
     * @param string       $roomId
     * @param string       $taskId
     * @param string       $pushURL
     * @param Streams|null $targetStreams
     * @param Streams|null $excludeStreams
     * @param Encode|null  $encode
     * @param Layout|null  $layout
     * @param Control|null $control
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function startTranscode(string $businessId, string $roomId, string $taskId, string $pushURL, ?Streams $targetStreams = null, ?Streams $excludeStreams = null, ?Encode $encode = null, ?Layout $layout = null, ?Control $control = null)
    {
        $results = $this->httpPostJson('/', array_merge([
            'AppId' => $this->app['config']->app_id,
            'BusinessId' => $businessId,
            'RoomId' => $roomId,
            'TaskId' => $taskId,
            'PushURL' => $pushURL,
        ], array_filter([
            'TargetStreams' => $targetStreams,
            'ExcludeStreams' => $excludeStreams,
            'Encode'  => $encode,
            'Layout'  => $layout,
            'Control' => $control,
        ])), [
            'Action' => 'StartTranscode',
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 更新合流转推 UpdateTranscode
     * @see https://www.volcengine.com/docs/6348/69849
     * @param string       $businessId
     * @param string       $roomId
     * @param string       $taskId
     * @param Streams|null $targetStreams
     * @param Layout|null  $layout
     * @param Encode|null  $encode
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function updateTranscode(string $businessId, string $roomId, string $taskId, ?Streams $targetStreams = null, ?Layout $layout = null, ?Encode $encode = null)
    {
        $results = $this->httpPostJson('/', array_merge([
            'AppId' => $this->app['config']->app_id,
            'BusinessId' => $businessId,
            'RoomId' => $roomId,
            'TaskId' => $taskId,
        ], array_filter([
            'TargetStreams' => $targetStreams,
            'Layout'  => $layout,
            'Encode'  => $encode,
        ])), [
            'Action' => 'UpdateTranscode',
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 结束合流转推 StopTranscode
     * @see https://www.volcengine.com/docs/6348/69851
     * @param string $businessId
     * @param string $roomId
     * @param string $taskId
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function stopTranscode(string $businessId, string $roomId, string $taskId)
    {
        $results = $this->httpPostJson('/', [
            'AppId' => $this->app['config']->app_id,
            'BusinessId' => $businessId,
            'RoomId' => $roomId,
            'TaskId' => $taskId,
        ], [
            'Action' => 'StopTranscode',
        ]);

        return $this->baseResponse($results);
    }
}
