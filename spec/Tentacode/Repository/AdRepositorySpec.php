<?php

namespace spec\Tentacode\Repository;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Repository\AdRepository');
    }
}
