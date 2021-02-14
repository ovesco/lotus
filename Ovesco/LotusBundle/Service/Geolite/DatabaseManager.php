<?php

namespace Ovesco\LotusBundle\Service\Geolite;

use GuzzleHttp\Client;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

const FILE_WILDCARD = "%FILE%";
const KEY_WILDCARD = "%KEY%";

const PUBLIC_DOWNLOAD_PATH = "https://raw.githubusercontent.com/GitSquared/node-geolite2-redist/master/redist/" . FILE_WILDCARD . ".tar.gz";
const MAXMIND_DOWNLOAD_PATH = "https://download.maxmind.com/app/geoip_download?edition_id=" . FILE_WILDCARD . "&license_key=". KEY_WILDCARD . "&suffix=tar.gz";

class DatabaseManager {

    private $maxmindKey;

    private $storagePath;

    private $fs;

    public function __construct(?string $storagePath, ?string $maxmindKey) {
        $this->storagePath = $storagePath;
        $this->maxmindKey = $maxmindKey;
        $this->fs = new Filesystem();
        $this->createCacheDirectory();
    }

    public function keyDefined() {
        return !empty($this->maxmindKey);
    }

    public function getDBNames() {
        return [
            'country' => 'GeoLite2-Country',
            'asn' => 'GeoLite2-ASN',
            'city' => 'GeoLite2-City',
        ];
    }

    public function isReady(string $dbName) {
        return $this->fs->exists($this->storagePath . DIRECTORY_SEPARATOR . $dbName . ".mmdb");
    }

    public function refresh(string $dbName) {

        // Download archive
        $dbArchiveName = $this->downloadArchive($dbName);

        // extract database on disk and get path of actual db file
        $this->extractDb($dbArchiveName, $dbName);

        // erase downloaded archive
        $this->fs->remove($dbArchiveName);
    }

    private function downloadArchive(string $dbName) {
        $client = new Client();
        $uri = empty($maxmindKey) ? PUBLIC_DOWNLOAD_PATH : MAXMIND_DOWNLOAD_PATH;
        $uri = str_replace(FILE_WILDCARD, $dbName, $uri);
        $uri = str_replace(KEY_WILDCARD, $dbName, $uri);

        // Download archive
        $filePath = $this->storagePath . DIRECTORY_SEPARATOR . $dbName . ".tar.gz";
        $resource = fopen($filePath, 'w');

        $client->get( $uri, ['sink' => $resource]);
        return $filePath;
    }

    private function extractDb(string $archivePath, string $dbName) {
        $phar = new \PharData($archivePath);
        $phar->extractTo($this->storagePath);
        $finder = new Finder();
        $finder->in($this->storagePath)->directories()->name($dbName . "*");
        if (!$finder->count() === 1) {
            throw new \Exception("Unexpected downloaded file, clear cache and try again");
        } else {
            foreach (iterator_to_array($finder) as $file) {
                $dbFilePath = $file->getRealPath() . DIRECTORY_SEPARATOR . $dbName . ".mmdb";
                $this->fs->rename($dbFilePath, $this->storagePath . DIRECTORY_SEPARATOR . $dbName . ".mmdb");

                // Clear download files
                $this->fs->remove($file->getRealPath());
            }
        }
    }

    private function createCacheDirectory() {
        if (!file_exists($this->storagePath)) {
            @mkdir($this->storagePath);
        }
    }
}
