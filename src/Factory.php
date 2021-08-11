<?php

namespace Volcengine;

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
