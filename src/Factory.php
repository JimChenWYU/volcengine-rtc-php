<?php

namespace Volcengine\Rtc;

class Factory
{
    /**
     * @param array $config
     * @return Application
     */
    public static function make(array $config)
    {
        return new Application($config);
    }
}
