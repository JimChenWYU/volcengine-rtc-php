<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Canvas implements JsonSerializable
{
    /**
     * @var int
     */
    protected $width;
    /**
     * @var int
     */
    protected $height;
    /**
     * @var string
     */
    protected $background;
    /**
     * @var string
     */
    protected $backgroundImage;

    /**
     * Canvas constructor.
     * @param int    $width
     * @param int    $height
     * @param string $background
     * @param string $backgroundImage
     */
    public function __construct(int $width, int $height, string $background, string $backgroundImage)
    {
        $this->width = $width;
        $this->height = $height;
        $this->background = $background;
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getBackground(): string
    {
        return $this->background;
    }

    /**
     * @param string $background
     */
    public function setBackground(string $background): void
    {
        $this->background = $background;
    }

    /**
     * @return string
     */
    public function getBackgroundImage(): string
    {
        return $this->backgroundImage;
    }

    /**
     * @param string $backgroundImage
     */
    public function setBackgroundImage(string $backgroundImage): void
    {
        $this->backgroundImage = $backgroundImage;
    }

    public function jsonSerialize()
    {
        return [
            'Width' => $this->width,
            'Height' => $this->height,
            'Background' => $this->background,
            'BackgroundImage' => $this->backgroundImage,
        ];
    }
}
