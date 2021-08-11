<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class ResponseMetadata implements JsonSerializable
{
    /**
     * @var string
     */
    protected $requestId;
    /**
     * @var string
     */
    protected $action;
    /**
     * @var string
     */
    protected $version;
    /**
     * @var string
     */
    protected $service;
    /**
     * @var string
     */
    protected $region;
    /**
     * @var ErrorInfo|null
     */
    protected $error;

    /**
     * ResponseMetadata constructor.
     * @param string $requestId
     * @param string $action
     * @param string $version
     * @param string $service
     * @param string $region
     * @param ErrorInfo|null $error
     */
    public function __construct(
        string $requestId,
        string $action,
        string $version,
        string $service,
        string $region,
        ?ErrorInfo $error
    ) {
        $this->requestId = $requestId;
        $this->action = $action;
        $this->version = $version;
        $this->service = $service;
        $this->region = $region;
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     */
    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService(string $service): void
    {
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return ErrorInfo|null
     */
    public function getError(): ?ErrorInfo
    {
        return $this->error;
    }

    /**
     * @param ErrorInfo|null $error
     */
    public function setError(?ErrorInfo $error): void
    {
        $this->error = $error;
    }

    public function jsonSerialize()
    {
        return [
            'RequestId' => $this->requestId,
            'Action'    => $this->action,
            'Version'   => $this->version,
            'Service'   => $this->service,
            'Region'    => $this->region,
            'Error'     => $this->error,
        ];
    }
}
