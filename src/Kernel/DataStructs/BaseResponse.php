<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class BaseResponse implements JsonSerializable
{
    /**
     * @var ResponseMetadata
     */
    protected $responseMetadata;
    /**
     * @var mixed
     */
    protected $result;

    /**
     * BaseResponse constructor.
     * @param ResponseMetadata $responseMetadata
     * @param mixed            $result
     */
    public function __construct(ResponseMetadata $responseMetadata, $result)
    {
        $this->responseMetadata = $responseMetadata;
        $this->result = $result;
    }

    /**
     * @return ResponseMetadata
     */
    public function getResponseMetadata(): ResponseMetadata
    {
        return $this->responseMetadata;
    }

    /**
     * @param ResponseMetadata $responseMetadata
     */
    public function setResponseMetadata(ResponseMetadata $responseMetadata): void
    {
        $this->responseMetadata = $responseMetadata;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result): void
    {
        $this->result = $result;
    }

    public function jsonSerialize()
    {
        return [
            'ResponseMetadata' => $this->responseMetadata,
            'Result' => $this->result,
        ];
    }
}
