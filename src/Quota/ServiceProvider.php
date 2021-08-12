<?php

namespace Volcengine\Rtc\Quota;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['quota']) && $pimple['quota'] = function ($app) {
            return new Client($app);
        };
    }
}
