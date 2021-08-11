<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class SourceCrop implements JsonSerializable
{
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
     * SourceCrop constructor.
     * @param float $locationX
     * @param float $locationY
     * @param float $widthProportion
     * @param float $heightProportion
     */
    public function __construct(float $locationX, float $locationY, float $widthProportion, float $heightProportion)
    {
        $this->locationX = $locationX;
        $this->locationY = $locationY;
        $this->widthProportion = $widthProportion;
        $this->heightProportion = $heightProportion;
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

    public function jsonSerialize()
    {
        return [
            'LocationX' => $this->locationX,
            'LocationY' => $this->locationY,
            'WidthProportion' => $this->widthProportion,
            'HeightProportion' => $this->heightProportion,
        ];
    }
}
