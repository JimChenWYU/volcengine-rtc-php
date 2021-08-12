<?php

namespace Volcengine\Rtc;

use Volcengine\Rtc\Kernel\ServiceContainer;

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
