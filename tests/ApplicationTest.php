<?php

namespace Volcengine\Rtc\Tests;

use Volcengine\Rtc\Application;

class ApplicationTest extends TestCase
{
    public function testProperties()
    {
        $app = new Application([
            'key' => 'foo-merchant-id',
        ]);
        $this->assertInstanceOf(\Volcengine\Rtc\RoomManage\Client::class, $app->room_manage);
        $this->assertInstanceOf(\Volcengine\Rtc\Record\Client::class, $app->record);
        $this->assertInstanceOf(\Volcengine\Rtc\Transcode\Client::class, $app->transcode);
        $this->assertInstanceOf(\Volcengine\Rtc\Quota\Client::class, $app->quota);
    }

    public function testGetKey()
    {
        $app = new Application(['key' => '88888888888888888888888888888888']);
        $this->assertSame('88888888888888888888888888888888', $app->getKey());
    }
}
