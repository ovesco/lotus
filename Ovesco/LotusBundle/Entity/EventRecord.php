<?php

namespace Ovesco\LotusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EventRecord
 * @package Ovesco\LotusBundle\Entity
 * @ORM\Entity()
 */
class EventRecord {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $sessionId;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $event;


    // User agent data

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $deviceType = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $browser = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $browserVersion = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $engine = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $engineVersion = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $operatingSystem = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $operatingSystemVersion = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $platform = null;


    // Geolite data

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $countryCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $subdivisionCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $city;


    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event): void
    {
        $this->event = $event;
    }

    /**
     * @return null
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param null $browser
     */
    public function setBrowser($browser): void
    {
        $this->browser = $browser;
    }

    /**
     * @return null
     */
    public function getBrowserVersion()
    {
        return $this->browserVersion;
    }

    /**
     * @param null $browserVersion
     */
    public function setBrowserVersion($browserVersion): void
    {
        $this->browserVersion = $browserVersion;
    }

    /**
     * @return null
     */
    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }

    /**
     * @param null $operatingSystem
     */
    public function setOperatingSystem($operatingSystem): void
    {
        $this->operatingSystem = $operatingSystem;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode($countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return mixed
     */
    public function getSubdivisionCode()
    {
        return $this->subdivisionCode;
    }

    /**
     * @param mixed $subdivisionCode
     */
    public function setSubdivisionCode($subdivisionCode): void
    {
        $this->subdivisionCode = $subdivisionCode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return null
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param null $engine
     */
    public function setEngine($engine): void
    {
        $this->engine = $engine;
    }

    /**
     * @return null
     */
    public function getEngineVersion()
    {
        return $this->engineVersion;
    }

    /**
     * @param null $engineVersion
     */
    public function setEngineVersion($engineVersion): void
    {
        $this->engineVersion = $engineVersion;
    }

    /**
     * @return null
     */
    public function getDeviceType()
    {
        return $this->deviceType;
    }

    /**
     * @param null $deviceType
     */
    public function setDeviceType($deviceType): void
    {
        $this->deviceType = $deviceType;
    }

    /**
     * @return null
     */
    public function getOperatingSystemVersion()
    {
        return $this->operatingSystemVersion;
    }

    /**
     * @param null $operatingSystemVersion
     */
    public function setOperatingSystemVersion($operatingSystemVersion): void
    {
        $this->operatingSystemVersion = $operatingSystemVersion;
    }

    /**
     * @return null
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param null $platform
     */
    public function setPlatform($platform): void
    {
        $this->platform = $platform;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }
}
