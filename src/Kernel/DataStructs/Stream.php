<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Stream implements JsonSerializable
{
    /**
     * @var int
     */
    protected $index;

    /**
     * @var string
     */
    protected $userId;

    /**
     * @var int
     */
    protected $streamType;

    /**
     * Stream constructor.
     * @param int    $index
     * @param string $userId
     * @param int    $streamType
     */
    public function __construct(int $index, string $userId, int $streamType)
    {
        $this->index = $index;
        $this->userId = $userId;
        $this->streamType = $streamType;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getStreamType(): int
    {
        return $this->streamType;
    }

    /**
     * @param int $streamType
     */
    public function setStreamType(int $streamType): void
    {
        $this->streamType = $streamType;
    }

    public function jsonSerialize()
    {
        return [
            'Index' => $this->index,
            'UserId' => $this->userId,
            'StreamType' => $this->streamType,
        ];
    }
}
