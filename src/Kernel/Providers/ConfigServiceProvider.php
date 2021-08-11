<?php

namespace Volcengine\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Volcengine\Kernel\Config;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['config']) && $pimple['config'] = function ($app) {
            return new Config($app->getConfig());
        };
    }
}
