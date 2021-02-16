<?php

namespace Ovesco\LotusBundle\Service;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

const TOKEN_KEY = 'lotus_visitor_token';

class TokenManager implements EventSubscriberInterface {

    private $request;

    private $waitingToken = null;

    public function __construct(RequestStack $stack)
    {
        $this->request = $stack->getMasterRequest();
    }

    public function getLotusToken() {
        $token = $this->request->cookies->get(TOKEN_KEY);
        if ($token === null) {
            $token = $this->generateToken();
            $this->waitingToken = $token;
        }

        return $token;
    }

    public function onKernelResponse(ResponseEvent $event) {

        $response = $event->getResponse();
        if ($this->waitingToken !== null) {
            $cookie = new Cookie(TOKEN_KEY, $this->waitingToken, 2147483647);
            $cookie->withSecure(true);
            $response->headers->setCookie($cookie);
        }
    }

    private function generateToken() {
        return bin2hex(random_bytes(32));
    }


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
