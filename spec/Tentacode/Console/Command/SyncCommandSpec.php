<?php

namespace spec\Tentacode\Console\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Output\OutputInterface;

class SyncCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Console\Command\SyncCommand');
    }

    function it_syncs_offers(OutputInterface $output)
    {
        $output->writeln('<info>Syncing offers...</info>')->shouldBeCalled();
        $this->__invoke($output);
    } 
}
