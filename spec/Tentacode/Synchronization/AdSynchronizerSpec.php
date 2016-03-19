<?php

namespace spec\Tentacode\Synchronization;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdSynchronizerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Synchronization\AdSynchronizer');
    }
}
