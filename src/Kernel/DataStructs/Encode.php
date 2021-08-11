<?php

namespace Volcengine\Kernel\DataStructs;

use JsonSerializable;

class Encode implements JsonSerializable
{
    /**
     * @var int
     */
    protected $videoWidth;
    /**
     * @var int
     */
    protected $videoHeight;
    /**
     * @var int
     */
    protected $videoFps;
    /**
     * @var int
     */
    protected $videoBitrate;
    /**
     * @var int
     */
    protected $videoCodec;
    /**
     * @var int
     */
    protected $videoGop;
    /**
     * @var int
     */
    protected $audioCodec;
    /**
     * @var int
     */
    protected $audioProfile;
    /**
     * @var int
     */
    protected $audioBitrate;
    /**
     * @var int
     */
    protected $audioSampleRate;
    /**
     * @var int
     */
    protected $audioChannels;

    /**
     * Encode constructor.
     * @param int $videoWidth
     * @param int $videoHeight
     * @param int $videoFps
     * @param int $videoBitrate
     * @param int $videoCodec
     * @param int $videoGop
     * @param int $audioCodec
     * @param int $audioProfile
     * @param int $audioBitrate
     * @param int $audioSampleRate
     * @param int $audioChannels
     */
    public function __construct(
        int $videoWidth,
        int $videoHeight,
        int $videoFps,
        int $videoBitrate,
        int $videoCodec,
        int $videoGop,
        int $audioCodec,
        int $audioProfile,
        int $audioBitrate,
        int $audioSampleRate,
        int $audioChannels
    ) {
        $this->videoWidth = $videoWidth;
        $this->videoHeight = $videoHeight;
        $this->videoFps = $videoFps;
        $this->videoBitrate = $videoBitrate;
        $this->videoCodec = $videoCodec;
        $this->videoGop = $videoGop;
        $this->audioCodec = $audioCodec;
        $this->audioProfile = $audioProfile;
        $this->audioBitrate = $audioBitrate;
        $this->audioSampleRate = $audioSampleRate;
        $this->audioChannels = $audioChannels;
    }

    /**
     * @return int
     */
    public function getVideoWidth(): int
    {
        return $this->videoWidth;
    }

    /**
     * @param int $videoWidth
     */
    public function setVideoWidth(int $videoWidth): void
    {
        $this->videoWidth = $videoWidth;
    }

    /**
     * @return int
     */
    public function getVideoHeight(): int
    {
        return $this->videoHeight;
    }

    /**
     * @param int $videoHeight
     */
    public function setVideoHeight(int $videoHeight): void
    {
        $this->videoHeight = $videoHeight;
    }

    /**
     * @return int
     */
    public function getVideoFps(): int
    {
        return $this->videoFps;
    }

    /**
     * @param int $videoFps
     */
    public function setVideoFps(int $videoFps): void
    {
        $this->videoFps = $videoFps;
    }

    /**
     * @return int
     */
    public function getVideoBitrate(): int
    {
        return $this->videoBitrate;
    }

    /**
     * @param int $videoBitrate
     */
    public function setVideoBitrate(int $videoBitrate): void
    {
        $this->videoBitrate = $videoBitrate;
    }

    /**
     * @return int
     */
    public function getVideoCodec(): int
    {
        return $this->videoCodec;
    }

    /**
     * @param int $videoCodec
     */
    public function setVideoCodec(int $videoCodec): void
    {
        $this->videoCodec = $videoCodec;
    }

    /**
     * @return int
     */
    public function getVideoGop(): int
    {
        return $this->videoGop;
    }

    /**
     * @param int $videoGop
     */
    public function setVideoGop(int $videoGop): void
    {
        $this->videoGop = $videoGop;
    }

    /**
     * @return int
     */
    public function getAudioCodec(): int
    {
        return $this->audioCodec;
    }

    /**
     * @param int $audioCodec
     */
    public function setAudioCodec(int $audioCodec): void
    {
        $this->audioCodec = $audioCodec;
    }

    /**
     * @return int
     */
    public function getAudioProfile(): int
    {
        return $this->audioProfile;
    }

    /**
     * @param int $audioProfile
     */
    public function setAudioProfile(int $audioProfile): void
    {
        $this->audioProfile = $audioProfile;
    }

    /**
     * @return int
     */
    public function getAudioBitrate(): int
    {
        return $this->audioBitrate;
    }

    /**
     * @param int $audioBitrate
     */
    public function setAudioBitrate(int $audioBitrate): void
    {
        $this->audioBitrate = $audioBitrate;
    }

    /**
     * @return int
     */
    public function getAudioSampleRate(): int
    {
        return $this->audioSampleRate;
    }

    /**
     * @param int $audioSampleRate
     */
    public function setAudioSampleRate(int $audioSampleRate): void
    {
        $this->audioSampleRate = $audioSampleRate;
    }

    /**
     * @return int
     */
    public function getAudioChannels(): int
    {
        return $this->audioChannels;
    }

    /**
     * @param int $audioChannels
     */
    public function setAudioChannels(int $audioChannels): void
    {
        $this->audioChannels = $audioChannels;
    }

    public function jsonSerialize()
    {
        return [
            'VideoWidth' => $this->videoWidth,
            'VideoHeight' => $this->videoHeight,
            'VideoFps' => $this->videoFps,
            'VideoBitrate' => $this->videoBitrate,
            'VideoCodec' => $this->videoCodec,
            'VideoGop' => $this->videoGop,
            'AudioCodec' => $this->audioCodec,
            'AudioProfile' => $this->audioProfile,
            'AudioBitrate' => $this->audioBitrate,
            'AudioSampleRate' => $this->audioSampleRate,
            'AudioChannels' => $this->audioChannels,
        ];
    }
}
