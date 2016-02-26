<?php

namespace spec\Tentacode;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FooBarSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\FooBar');
    }

    function it_sets_foo()
    {
        $this->setFoo(12);
        $this->getFoo()->shouldReturn(12);
    }
}
