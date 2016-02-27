<?php

namespace spec\Tentacode\Domain\Dealer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AudiofanzineOptionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Mox ruby', 'Near mint', false);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Domain\Dealer\AudiofanzineOptions');
        $this->shouldImplement('Tentacode\Domain\Dealer\AdOptions');
    }

    function it_has_a_product()
    {
        $this->getProduct()->shouldReturn('Mox ruby');
    }

    function it_has_a_category()
    {
        $this->getCondition()->shouldReturn('Near mint');
    }

    function it_tells_if_the_product_is_sold_with_accessories()
    {
        $this->withAccessories()->shouldReturn(false);
    }
}
