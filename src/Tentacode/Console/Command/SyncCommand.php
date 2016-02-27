<?php

namespace Tentacode\Console\Command;

use Symfony\Component\Console\Output\OutputInterface;

class SyncCommand
{
    public function __invoke(OutputInterface $output)
    {
        $output->writeln('<info>Syncing offers...</info>');
    }
}
