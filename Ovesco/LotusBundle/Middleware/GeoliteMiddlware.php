<?php

namespace Ovesco\LotusBundle\Middleware;

use Ovesco\LotusBundle\Entity\EventRecord;
use Ovesco\LotusBundle\Model\MiddlewareInterface;
use Ovesco\LotusBundle\Service\Geolite\DatabaseReader;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class GeoliteMiddlware implements MiddlewareInterface {

    private $reader;

    private $request;

    private $logger;

    public function __construct(DatabaseReader $reader, Request $request, LoggerInterface $logger)
    {
        $this->reader = $reader;
        $this->request = $request;
        $this->logger = $logger;
    }

    public static function name(): string
    {
        return 'lotus-geolite';
    }

    public function run(EventRecord $record)
    {
        try {
            $geodata = $this->reader->getGeolocationData($this->request->getClientIp());
            if ($country = $geodata->country->isoCode)
                $record->setCountryCode($country);
            if ($subdivision = $geodata->mostSpecificSubdivision->isoCode)
                $record->setSubdivisionCode($subdivision);
            if ($city = $geodata->city->name)
                $record->setCity($city);

        } catch (\Exception $e) {
            $this->logger->notice("Couldnt read geolite data for ip {$this->request->getClientIp()}");
        }
    }
}
