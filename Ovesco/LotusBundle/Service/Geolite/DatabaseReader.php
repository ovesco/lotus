<?php

namespace Ovesco\LotusBundle\Service\Geolite;

use GeoIp2\Database\Reader;

const USED_DB = "GeoLite2-City";

class DatabaseReader {

    private $reader;

    public function __construct(string $storagePath, DatabaseManager $manager)
    {
        if (!$manager->isReady(USED_DB)) {
            $manager->refresh(USED_DB);
        }

        $this->reader = new Reader($storagePath . DIRECTORY_SEPARATOR . USED_DB . ".mmdb");
    }

    public function getGeolocationData(string $ip) {
        return $this->reader->city($ip);
    }
}
