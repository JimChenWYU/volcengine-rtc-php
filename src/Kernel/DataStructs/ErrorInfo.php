<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class ErrorInfo implements JsonSerializable
{
    /**
     * @var int
     */
    protected $codeN;
    /**
     * @var string
     */
    protected $code;
    /**
     * @var string
     */
    protected $message;

    /**
     * ErrorInfo constructor.
     * @param int    $codeN
     * @param string $code
     * @param string $message
     */
    public function __construct(int $codeN, string $code, string $message)
    {
        $this->codeN = $codeN;
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getCodeN(): int
    {
        return $this->codeN;
    }

    /**
     * @param int $codeN
     */
    public function setCodeN(int $codeN): void
    {
        $this->codeN = $codeN;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return [
            'CodeN'   => $this->codeN,
            'Code'    => $this->code,
            'Message' => $this->message,
        ];
    }
}
