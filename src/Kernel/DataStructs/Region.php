<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Region implements JsonSerializable
{
    /**
     * @var int
     */
    protected $streamIndex;
    /**
     * @var float
     */
    protected $locationX;
    /**
     * @var float
     */
    protected $locationY;
    /**
     * @var float
     */
    protected $widthProportion;
    /**
     * @var float
     */
    protected $heightProportion;
    /**
     * @var int
     */
    protected $zOrder;
    /**
     * @var float
     */
    protected $alpha;
    /**
     * @var int
     */
    protected $renderMode;
    /**
     * @var SourceCrop
     */
    protected $sourceCrop;
    /**
     * @var string
     */
    protected $alternateImage;

    /**
     * Region constructor.
     * @param int        $streamIndex
     * @param float      $locationX
     * @param float      $locationY
     * @param float      $widthProportion
     * @param float      $heightProportion
     * @param int        $zOrder
     * @param float      $alpha
     * @param int        $renderMode
     * @param SourceCrop $sourceCrop
     * @param string     $alternateImage
     */
    public function __construct(
        int $streamIndex,
        float $locationX,
        float $locationY,
        float $widthProportion,
        float $heightProportion,
        int $zOrder,
        float $alpha,
        int $renderMode,
        SourceCrop $sourceCrop,
        string $alternateImage
    ) {
        $this->streamIndex = $streamIndex;
        $this->locationX = $locationX;
        $this->locationY = $locationY;
        $this->widthProportion = $widthProportion;
        $this->heightProportion = $heightProportion;
        $this->zOrder = $zOrder;
        $this->alpha = $alpha;
        $this->renderMode = $renderMode;
        $this->sourceCrop = $sourceCrop;
        $this->alternateImage = $alternateImage;
    }

    /**
     * @return int
     */
    public function getStreamIndex(): int
    {
        return $this->streamIndex;
    }

    /**
     * @param int $streamIndex
     */
    public function setStreamIndex(int $streamIndex): void
    {
        $this->streamIndex = $streamIndex;
    }

    /**
     * @return float
     */
    public function getLocationX(): float
    {
        return $this->locationX;
    }

    /**
     * @param float $locationX
     */
    public function setLocationX(float $locationX): void
    {
        $this->locationX = $locationX;
    }

    /**
     * @return float
     */
    public function getLocationY(): float
    {
        return $this->locationY;
    }

    /**
     * @param float $locationY
     */
    public function setLocationY(float $locationY): void
    {
        $this->locationY = $locationY;
    }

    /**
     * @return float
     */
    public function getWidthProportion(): float
    {
        return $this->widthProportion;
    }

    /**
     * @param float $widthProportion
     */
    public function setWidthProportion(float $widthProportion): void
    {
        $this->widthProportion = $widthProportion;
    }

    /**
     * @return float
     */
    public function getHeightProportion(): float
    {
        return $this->heightProportion;
    }

    /**
     * @param float $heightProportion
     */
    public function setHeightProportion(float $heightProportion): void
    {
        $this->heightProportion = $heightProportion;
    }

    /**
     * @return int
     */
    public function getZOrder(): int
    {
        return $this->zOrder;
    }

    /**
     * @param int $zOrder
     */
    public function setZOrder(int $zOrder): void
    {
        $this->zOrder = $zOrder;
    }

    /**
     * @return float
     */
    public function getAlpha(): float
    {
        return $this->alpha;
    }

    /**
     * @param float $alpha
     */
    public function setAlpha(float $alpha): void
    {
        $this->alpha = $alpha;
    }

    /**
     * @return int
     */
    public function getRenderMode(): int
    {
        return $this->renderMode;
    }

    /**
     * @param int $renderMode
     */
    public function setRenderMode(int $renderMode): void
    {
        $this->renderMode = $renderMode;
    }

    /**
     * @return SourceCrop
     */
    public function getSourceCrop(): SourceCrop
    {
        return $this->sourceCrop;
    }

    /**
     * @param SourceCrop $sourceCrop
     */
    public function setSourceCrop(SourceCrop $sourceCrop): void
    {
        $this->sourceCrop = $sourceCrop;
    }

    /**
     * @return string
     */
    public function getAlternateImage(): string
    {
        return $this->alternateImage;
    }

    /**
     * @param string $alternateImage
     */
    public function setAlternateImage(string $alternateImage): void
    {
        $this->alternateImage = $alternateImage;
    }

    public function jsonSerialize()
    {
        return [
            'StreamIndex' => $this->streamIndex,
            'LocationX' => $this->locationX,
            'LocationY' => $this->locationY,
            'WidthProportion' => $this->widthProportion,
            'HeightProportion' => $this->heightProportion,
            'ZOrder' => $this->zOrder,
            'Alpha' => $this->alpha,
            'RenderMode' => $this->renderMode,
            'SourceCrop' => $this->sourceCrop,
            'AlternateImage' => $this->alternateImage,
        ];
    }
}
