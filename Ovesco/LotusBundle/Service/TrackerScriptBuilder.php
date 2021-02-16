<?php

namespace Ovesco\LotusBundle\Service;

use Ovesco\LotusBundle\Model\TrackerPluginInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Twig\Environment;

const TRACKER_CACHE_KEY = 'ovesco_lotus_tracker_script';

class TrackerScriptBuilder {

    private $twig;

    private $trackerPlugins = [];

    private $cache;

    public function __construct(Environment $twig, CacheInterface $cache)
    {
        $this->twig = $twig;
        $this->cache = $cache;
    }

    public function buildScript(string $lotusPath) {
        return $this->twig->render('@OvescoLotus/tracker.twig.js', [
           'lotusPath' => $lotusPath,
            'plugins' => $this->trackerPlugins,
        ]);
    }

    public function getCachedScript() {
        return $this->cache->get(TRACKER_CACHE_KEY, function(ItemInterface $item) {
            $item->expiresAfter()
        });
    }

    public function registerTrackerPlugin(TrackerPluginInterface $plugin) {
        $this->trackerPlugins[] = $plugin;
    }
}
