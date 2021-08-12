<?php

namespace Volcengine\Rtc\RoomManage;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['room_manage']) && $pimple['room_manage'] = function ($app) {
            return new Client($app);
        };
    }
}
