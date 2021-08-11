<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Control implements JsonSerializable
{
    /**
     * @var int
     */
    protected $mediaType;
    /**
     * @var int
     */
    protected $frameInterpolationMode;
    /**
     * @var int
     */
    protected $maxIdleTime;
    /**
     * @var int
     */
    protected $maxRecordTime;
    /**
     * @var int
     */
    protected $encryptionType;

    /**
     * Control constructor.
     * @param int $mediaType
     * @param int $frameInterpolationMode
     * @param int $maxIdleTime
     * @param int $maxRecordTime
     * @param int $encryptionType
     */
    public function __construct(
        int $mediaType,
        int $frameInterpolationMode,
        int $maxIdleTime,
        int $maxRecordTime,
        int $encryptionType
    ) {
        $this->mediaType = $mediaType;
        $this->frameInterpolationMode = $frameInterpolationMode;
        $this->maxIdleTime = $maxIdleTime;
        $this->maxRecordTime = $maxRecordTime;
        $this->encryptionType = $encryptionType;
    }

    public function jsonSerialize()
    {
        return [
            'MediaType' => $this->mediaType,
            'FrameInterpolationMode' => $this->frameInterpolationMode,
            'MaxIdleTime' => $this->maxIdleTime,
            'MaxRecordTime' => $this->maxRecordTime,
            'EncryptionType' => $this->encryptionType,
        ];
    }
}
