<?php

namespace Ovesco\LotusBundle\Middleware;

use Ovesco\LotusBundle\Entity\EventRecord;
use Ovesco\LotusBundle\Exception\IsBotException;
use Ovesco\LotusBundle\Model\MiddlewareInterface;
use Ovesco\LotusBundle\Service\UserAgentParser;

class BotDetectorMiddleware implements MiddlewareInterface
{
    private $parser;

    public function __construct(UserAgentParser $parser)
    {
        $this->parser = $parser->getParser();
    }

    public function run(EventRecord $record)
    {
        if ($this->parser->isBot()) {
            throw new IsBotException();
        }
    }

    public static function name(): string
    {
        return 'lotus-bot-detector';
    }
}
