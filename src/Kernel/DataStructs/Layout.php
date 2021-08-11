<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Layout implements JsonSerializable
{
    /**
     * @var int
     */
    protected $layoutMode;
    /**
     * @var int
     */
    protected $mainVideoStreamIndex;
    /**
     * @var CustomLayout
     */
    protected $customLayout;

    /**
     * Layout constructor.
     * @param int          $layoutMode
     * @param int          $mainVideoStreamIndex
     * @param CustomLayout $customLayout
     */
    public function __construct(int $layoutMode, int $mainVideoStreamIndex, CustomLayout $customLayout)
    {
        $this->layoutMode = $layoutMode;
        $this->mainVideoStreamIndex = $mainVideoStreamIndex;
        $this->customLayout = $customLayout;
    }

    /**
     * @return int
     */
    public function getLayoutMode(): int
    {
        return $this->layoutMode;
    }

    /**
     * @param int $layoutMode
     */
    public function setLayoutMode(int $layoutMode): void
    {
        $this->layoutMode = $layoutMode;
    }

    /**
     * @return int
     */
    public function getMainVideoStreamIndex(): int
    {
        return $this->mainVideoStreamIndex;
    }

    /**
     * @param int $mainVideoStreamIndex
     */
    public function setMainVideoStreamIndex(int $mainVideoStreamIndex): void
    {
        $this->mainVideoStreamIndex = $mainVideoStreamIndex;
    }

    /**
     * @return CustomLayout
     */
    public function getCustomLayout(): CustomLayout
    {
        return $this->customLayout;
    }

    /**
     * @param CustomLayout $customLayout
     */
    public function setCustomLayout(CustomLayout $customLayout): void
    {
        $this->customLayout = $customLayout;
    }

    public function jsonSerialize()
    {
        return [
            'LayoutMode' => $this->layoutMode,
            'MainVideoStreamIndex' => $this->mainVideoStreamIndex,
            'CustomLayout' => $this->customLayout,
        ];
    }
}
