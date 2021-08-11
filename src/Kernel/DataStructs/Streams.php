<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Streams implements JsonSerializable
{
    /** @var Stream[] */
    protected $streamList;

    /**
     * Streams constructor.
     * @param Stream[] $streamList
     */
    public function __construct(array $streamList)
    {
        $this->streamList = $streamList;
    }

    public function jsonSerialize()
    {
        return [
            'StreamList' => $this->streamList
        ];
    }
}
