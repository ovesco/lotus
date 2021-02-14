<?php

namespace Ovesco\LotusBundle\Command;

use Ovesco\LotusBundle\Service\Geolite\DatabaseManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RefreshGeoliteCommand extends Command {

    protected static $defaultName = 'ovesco:lotus:refresh-geolite';

    private $dbManager;

    public function __construct(DatabaseManager $manager)
    {
        $this->dbManager = $manager;
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('database', InputArgument::OPTIONAL, 'database name to refresh');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sout = new SymfonyStyle($input, $output);
        $dbName = $input->getArgument('database');
        $validDbNames = array_values($this->dbManager->getDBNames());
        if (!empty($dbName) && !in_array($dbName, $validDbNames)) {
            throw new \Exception("Database name must be one of [" . implode(", ", $validDbNames) . "]");
        }

        $refreshingDbs = empty($dbName) ? $validDbNames : [$dbName];
        if (!$this->dbManager->keyDefined()) {
            $sout->warning("No maxmind license key defined, using the open source redistributed version");
        }

        foreach ($refreshingDbs as $db) {
            $sout->writeln("Refreshing " . $db . "");
            try {
                $this->dbManager->refresh($db);
            } catch (\Exception $e) {
                $sout->error("Encountered an error: \n{$e->getMessage()}");
                die();
            }
            $sout->writeln("Done with " . $db);
        }

        $sout->success("Done refreshing database(s)");
        return Command::SUCCESS;
    }
}
