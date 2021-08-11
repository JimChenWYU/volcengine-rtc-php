<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Vod implements JsonSerializable
{
    /**
     * @var string
     */
    protected $accountId;
    /**
     * @var string
     */
    protected $space;

    /**
     * Vod constructor.
     * @param string $accountId
     * @param string $space
     */
    public function __construct(string $accountId, string $space)
    {
        $this->accountId = $accountId;
        $this->space = $space;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return string
     */
    public function getSpace(): string
    {
        return $this->space;
    }

    /**
     * @param string $space
     */
    public function setSpace(string $space): void
    {
        $this->space = $space;
    }

    public function jsonSerialize()
    {
        return [
            'AccountId' => $this->accountId,
            'Space' => $this->space,
        ];
    }
}
