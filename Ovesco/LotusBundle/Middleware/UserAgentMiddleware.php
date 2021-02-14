<?php

namespace Ovesco\LotusBundle\Middleware;

use Ovesco\LotusBundle\Entity\EventRecord;
use Ovesco\LotusBundle\Model\MiddlewareInterface;
use Ovesco\LotusBundle\Service\UserAgentParser;

class UserAgentMiddleware implements MiddlewareInterface {

    private $parser;

    public function __construct(UserAgentParser $parser)
    {
        $this->parser = $parser->getParser();
    }

    public static function name(): string
    {
        return 'lotus-user-agent';
    }

    public function run(EventRecord $record)
    {
        $client = array_merge([
            'type' => null,
            'name' => null,
            'version' => null,
            'engine' => null,
            'engineVersion' => null
        ], $this->parser->getClient());

        $record->setBrowser($client['name']);
        $record->setBrowserVersion($client['version']);
        $record->setEngine($client['engine']);
        $record->setEngineVersion($client['engineVersion']);

        $os = array_merge([
            'name' => null,
            'version' => null,
            'platform' => null
        ], $this->parser->getOs());

        $record->setOperatingSystem($os['name']);
        $record->setOperatingSystemVersion($os['version']);
        $record->setPlatform($os['platform']);

        $type = $this->parser->getDeviceName();
        if (!empty($type)) $record->setDeviceType($type);
    }
}
