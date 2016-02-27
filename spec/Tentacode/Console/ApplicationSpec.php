<?php

namespace spec\Tentacode\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Console\Application');
        $this->shouldHaveType('Silly\Application');
    }
}
