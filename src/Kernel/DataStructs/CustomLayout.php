<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class CustomLayout implements JsonSerializable
{
    /**
     * @var Canvas|null
     */
    protected $canvas;
    /**
     * @var Region[]
     */
    protected $regions;

    /**
     * CustomLayout constructor.
     * @param Region[] $regions
     * @param Canvas|null $canvas
     */
    public function __construct(array $regions, ?Canvas $canvas = null)
    {
        $this->canvas = $canvas;
        $this->regions = $regions;
    }

    /**
     * @return Canvas|null
     */
    public function getCanvas(): ?Canvas
    {
        return $this->canvas;
    }

    /**
     * @param Canvas|null $canvas
     */
    public function setCanvas(?Canvas $canvas): void
    {
        $this->canvas = $canvas;
    }

    /**
     * @return Region[]
     */
    public function getRegions(): array
    {
        return $this->regions;
    }

    /**
     * @param Region[] $regions
     */
    public function setRegions(array $regions): void
    {
        $this->regions = $regions;
    }

    public function jsonSerialize()
    {
        return $this->canvas ? [
            'Regions' => $this->regions,
            'Canvas' => $this->canvas
        ] : [
            'Regions' => $this->regions,
        ];
    }
}
