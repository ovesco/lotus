<?php

namespace Ovesco\LotusBundle\DependencyInjection;

use DeviceDetector\DeviceDetector;
use Ovesco\LotusBundle\Service\Geolite\DatabaseManager;
use Ovesco\LotusBundle\Service\Geolite\DatabaseReader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class OvescoLotusExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');


        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $GeoliteStoragePath = $config['geolite']['db_storage_path'];
        if (empty($GeoliteStoragePath)) $GeoliteStoragePath = $container->getParameter('kernel.cache_dir') . "/geolitedb";

        $container->getDefinition(DatabaseManager::class)->addArgument($GeoliteStoragePath);
        $container->getDefinition(DatabaseManager::class)->addArgument($config['geolite']['maxmind_license_key']);

        $container->getDefinition(DatabaseReader::class)->addArgument($GeoliteStoragePath);

        $container->setDefinition(DeviceDetector::class, new Definition(DeviceDetector::class));
    }
}
