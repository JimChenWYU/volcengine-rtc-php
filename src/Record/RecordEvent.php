<?php

namespace Volcengine\Rtc\Record;

use Closure;
use Volcengine\Rtc\Application;
use Volcengine\Kernel\Exceptions\Exception;
use Volcengine\Kernel\Exceptions\InvalidSignException;

class RecordEvent
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var array
     */
    protected $message;

    /**
     * @var bool
     */
    protected $check = true;

    /**
     * Recorded constructor.
     * @param Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param Closure $closure
     * @return false|mixed
     * @throws Exception
     */
    public function handle(Closure $closure)
    {
        return \call_user_func($closure, $this->getMessage());
    }

    /**
     * @return array
     * @throws Exception
     * @throws InvalidSignException
     */
    protected function getMessage(): array
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        $message = json_decode($this->app['request']->getContent(), true);

        if (!is_array($message) || empty($message)) {
            throw new Exception('Invalid request JSON.', 400);
        }

        if ($this->check) {
            $this->validate($message);
        }

        return $this->message = $message;
    }

    /**
     * @param array $message
     * @throws InvalidSignException
     */
    protected function validate(array $message)
    {
        $sign = $message['Signature'];
        unset($message['Signature']);
        $message['SecretKey'] = $this->app->getKey();
        sort($message);
        if (hash('sha256', implode('', $message)) !== $sign) {
            throw new InvalidSignException();
        }
    }
}
