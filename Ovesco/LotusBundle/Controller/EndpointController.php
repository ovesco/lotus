<?php

namespace Ovesco\LotusBundle\Controller;

use Ovesco\LotusBundle\Service\UserAgentParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EndpointController extends AbstractController {

    /**
     * @param Request $request
     * @Route("/yo", name="endpoint")
     * @return string
     */
    public function eventAction(Request $request, UserAgentParser $parser) {
        $detector = $parser->getParser();
        dump(
            $detector,
            $detector->getClient(),
            $detector->getOs(),
            $detector->getDevice(),
            $detector->getDeviceName(),
            $detector->getModel(),
            $detector->getBrandName()
        );

        die();
    }
}
