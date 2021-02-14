<?php

namespace Ovesco\LotusBundle\Model;

use Ovesco\LotusBundle\Entity\EventRecord;

interface MiddlewareInterface {

    public static function name(): string;

    public function run(EventRecord $record);
}
