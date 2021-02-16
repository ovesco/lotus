<?php

namespace Ovesco\LotusBundle\Controller;

use Ovesco\LotusBundle\Service\TrackerScriptBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class TrackerController extends AbstractController {

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/tracker", name="ovesco_lotus_tracker")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function trackerAction(Request $request, TrackerScriptBuilder $scriptBuilder, Cache) {

        if (!$this->session->isStarted()) {
            $this->session->start();
            $this->session->set('lotus_visitor_id', random_bytes(64));
        }

        $lotusPath = $this->getParameter('lotus_path');
        if (empty($lotusPath)) $lotusPath = substr($request->getRequestUri(), 0, -8);


        die;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
