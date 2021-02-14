<?php

namespace Ovesco\LotusBundle;

use Ovesco\LotusBundle\DependencyInjection\OvescoLotusExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OvescoLotusBundle extends Bundle {

    public function getContainerExtension()
    {
        return new OvescoLotusExtension();
    }
}
