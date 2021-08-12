<?php

namespace Volcengine\Rtc\Kernel;

class ServiceContainer extends \Volcengine\Kernel\ServiceContainer
{
    protected function getBaseUri(): string
    {
        return 'https://open.volcengineapi.com/';
    }
}
