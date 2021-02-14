<?php

namespace Ovesco\LotusBundle\Service;

use DeviceDetector\DeviceDetector;
use Symfony\Component\HttpFoundation\RequestStack;

class UserAgentParser {

    private $parser;

    public function __construct(RequestStack $stack)
    {
        $this->parser = new DeviceDetector($stack->getMasterRequest()->headers->get('User-Agent'));
        $this->parser->parse();
    }

    public function getParser() {
        return $this->parser;
    }
}
