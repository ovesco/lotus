<?php

namespace Ovesco\LotusBundle\Controller;

use Ovesco\LotusBundle\Service\TokenManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndpointController extends AbstractController {

    /**
     * @param Request $request
     * @Route("/pageView", name="ovesco_lotus_page_view")
     * @return string
     */
    public function pageViewAction(Request $request, TokenManager $tokenManager) {

        $token = $tokenManager->getLotusToken();
        dump($token);

        return new Response('<body></body>');
    }
}
