<?php

namespace Volcengine\Rtc\Record;

use Closure;
use Volcengine\Kernel\Traits\ApiCastable;
use Volcengine\Rtc\Kernel\BaseClient;
use Volcengine\Rtc\Kernel\DataStructs\Control;
use Volcengine\Rtc\Kernel\DataStructs\Encode;
use Volcengine\Rtc\Kernel\DataStructs\Layout;
use Volcengine\Rtc\Kernel\DataStructs\Streams;
use Volcengine\Rtc\Kernel\DataStructs\Vod;

class Client extends BaseClient
{
    use ApiCastable;

    /**
     * 开始云端录制 StartRecord
     * @see https://www.volcengine.com/docs/6348/69844
     * @param string       $businessId
     * @param string       $roomId
     * @param string       $taskId
     * @param int          $recordMode
     * @param Streams|null $targetStreams
     * @param Streams|null $excludeStreams
     * @param Encode|null  $encode
     * @param Layout|null  $layout
     * @param Control|null $control
     * @param Vod|null     $vod
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function startRecord(string $businessId, string $roomId, string $taskId, int $recordMode, ?Streams $targetStreams = null, ?Streams $excludeStreams = null, ?Encode $encode = null, ?Layout $layout = null, ?Control $control = null, ?Vod $vod = null)
    {
        $results = $this->httpPostJson('/', array_merge([
            'AppId' => $this->app['config']->app_id,
            'BusinessId' => $businessId,
            'RoomId' => $roomId,
            'TaskId' => $taskId,
            'RecordMode' => $recordMode,
        ], array_filter([
            'TargetStreams' => $targetStreams,
            'ExcludeStreams' => $excludeStreams,
            'Encode'  => $encode,
            'Layout'  => $layout,
            'Control' => $control,
            'Vod'     => $vod,
        ])), [
            'Action' => 'StartRecord',
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 更新云端录制 Update Record
     * @see https://www.volcengine.com/docs/6348/69845
     * @param string       $businessId
     * @param string       $roomId
     * @param string       $taskId
     * @param Streams|null $targetStreams
     * @param Layout|null  $layout
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function updateRecord(string $businessId, string $roomId, string $taskId, ?Streams $targetStreams = null, ?Layout $layout = null)
    {
        $results = $this->httpPostJson('/', array_merge([
            'AppId' => $this->app['config']->app_id,
            'BusinessId' => $businessId,
            'RoomId' => $roomId,
            'TaskId' => $taskId,
        ], array_filter([
            'TargetStreams' => $targetStreams,
            'Layout'  => $layout,
        ])), [
            'Action' => 'UpdateRecord',
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 结束云端录制 Stop Record
     * @see https://www.volcengine.com/docs/6348/69846
     * @param string $businessId
     * @param string $roomId
     * @param string $taskId
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function stopRecord(string $businessId, string $roomId, string $taskId)
    {
        $results = $this->httpPostJson('/', [
            'AppId' => $this->app['config']->app_id,
            'BusinessId' => $businessId,
            'RoomId' => $roomId,
            'TaskId' => $taskId,
        ], [
            'Action' => 'StopRecord'
        ]);

        return $this->baseResponse($results);
    }

    /**
     * 查询录制任务状态
     * @see https://www.volcengine.com/docs/6348/70980
     * @param string $roomId
     * @param string $taskId
     * @return \Volcengine\Kernel\DataStructs\BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Volcengine\Kernel\Exceptions\InvalidConfigException
     */
    public function getRecordTask(string $roomId, string $taskId)
    {
        $oldBaseUri = $this->baseUri;
        try {
            $this->baseUri = 'https://rtc.bytedanceapi.com/';
            return $this->baseResponse(
                $this->httpGet('/', [
                    'Action' => 'GetRecordTask',
                    'AppId' => $this->app['config']->app_id,
                    'RoomId' => $roomId,
                    'TaskId' => $taskId,
                ])
            );
        } finally {
            $this->baseUri = $oldBaseUri;
        }
    }

    /**
     * 录制事件回调
     * @see https://www.volcengine.com/docs/6348/69847
     * @param Closure $closure
     * @return false|mixed
     * @throws \Volcengine\Kernel\Exceptions\Exception
     */
    public function handleRecordEvent(Closure $closure)
    {
        return (new RecordEvent($this->app))->handle($closure);
    }
}
