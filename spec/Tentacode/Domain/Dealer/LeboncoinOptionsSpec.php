<?php

namespace spec\Tentacode\Domain\Dealer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LeboncoinOptionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Instruments de musique');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Domain\Dealer\LeboncoinOptions');
        $this->shouldImplement('Tentacode\Domain\Dealer\AdOptions');
    }

    function it_has_a_category()
    {
        $this->getCategory()->shouldReturn('Instruments de musique');
    }
}
