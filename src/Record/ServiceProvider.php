<?php

namespace Volcengine\Record;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['record']) && $pimple['record'] = function ($app) {
            return new Client($app);
        };
    }
}
