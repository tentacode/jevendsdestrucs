<?php

declare(strict_types = 1);

namespace Tentacode\Console\Command;

use Symfony\Component\Console\Output\OutputInterface;
use Tentacode\Repository\AdRepository;
use Tentacode\Synchronization\AdSynchronizer;

class SyncCommand
{
    protected $output;
    protected $adRepository;
    protected $adSynchronizer;

    public function __construct(AdRepository $adRepository, AdSynchronizer $adSynchronizer)
    {
        $this->adRepository = $adRepository;
        $this->adSynchronizer = $adSynchronizer;
    }

    public function __invoke(OutputInterface $output)
    {
        $this->output = $output;
        $this->output->writeln('<info>Syncing offers...</info>');
    }
}
