<?php

namespace Volcengine\Rtc;

use Volcengine\Rtc\Kernel\ServiceContainer;

/**
 * Class Application
 *
 * @property \Volcengine\Rtc\RoomManage\Client $room_manage
 * @property \Volcengine\Rtc\Record\Client     $record
 * @property \Volcengine\Rtc\Transcode\Client  $transcode
 * @property \Volcengine\Rtc\Quota\Client      $quota
 */
class Application extends ServiceContainer
{
    protected $providers = [
        RoomManage\ServiceProvider::class,
        Record\ServiceProvider::class,
        Transcode\ServiceProvider::class,
        Quota\ServiceProvider::class,
    ];

    public function getKey(): string
    {
        return $this['config']->key;
    }
}
