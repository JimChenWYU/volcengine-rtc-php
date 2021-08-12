<?php

namespace Volcengine\Rtc\Tests\Record;

use Symfony\Component\HttpFoundation\Request;
use Volcengine\Kernel\Exceptions\InvalidSignException;
use Volcengine\Rtc\Application;
use Volcengine\Rtc\Record\RecordEvent;
use Volcengine\Rtc\Tests\TestCase;

class RecordEventTest extends TestCase
{
    protected function app()
    {
        return new Application([
            'key' => 'mock-key',
            'app_id' => 'mock-appid',
        ]);
    }

    public function testNotify()
    {
        $app = $this->app();

        $app['request'] = Request::create('', 'POST', [], [], [], [], '{
            "Signature": "7a9161d19b119e27a7e585a4893e24fb4d5e20b19b784de3864a5be2b26446aa",
            "foo": "bar"
        }');

        $notify = new RecordEvent($app);
        $that = $this;
        $response = $notify->handle(function ($message) use ($that) {
            $that->assertSame([
                'Signature' => '7a9161d19b119e27a7e585a4893e24fb4d5e20b19b784de3864a5be2b26446aa',
                'foo' => 'bar',
            ], $message);

            return true;
        });

        $this->assertTrue($response);
    }

    public function testInvalidSign()
    {
        $app = $this->app();

        $app['request'] = Request::create('', 'POST', [], [], [], [], '{
            "Signature": "invalid-sign",
            "foo": "bar"
        }');
        $notify = new RecordEvent($app);
        $this->expectException(InvalidSignException::class);
        $notify->handle(function () {});
    }
}
