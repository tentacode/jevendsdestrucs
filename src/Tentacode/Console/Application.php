<?php

namespace Tentacode\Console;

use Tentacode\Console\Command\SyncCommand;
use Silly\Edition\PhpDi\Application as Silly;

class Application extends Silly
{
    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);

        $this->command('sync', SyncCommand::class);
    } 
}
