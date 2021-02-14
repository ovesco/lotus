<?php

namespace Ovesco\LotusBundle\Command;

use Ovesco\LotusBundle\Service\Geolite\DatabaseManager;
use Ovesco\LotusBundle\Service\Geolite\DatabaseReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends Command {

    protected static $defaultName = 'ovesco:lotus:test';

    private $reader;

    public function __construct(DatabaseReader $reader)
    {
        $this->reader = $reader;
        parent::__construct();
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sout = new SymfonyStyle($input, $output);
        $this->reader->getGeolocationData("178.39.193.170");
        return Command::SUCCESS;
    }
}
