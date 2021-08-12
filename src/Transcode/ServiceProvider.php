<?php

namespace Volcengine\Rtc\Transcode;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['transcode']) && $pimple['transcode'] = function ($app) {
            return new Client($app);
        };
    }
}
