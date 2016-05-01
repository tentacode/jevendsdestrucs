<?php

namespace spec\Tentacode\Repository;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tentacode\Serialization\AdSerializer;

class AdRepositorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new AdSerializer, '*.yml.dist');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Repository\AdRepository');
    }

    function it_gets_all_ads()
    {
        $ads = $this->getAds();

        $ads->shouldHaveCount(1);

        $ad = $ads[0];
        $ad->shouldHaveType('Tentacode\Domain\Ad');
        $ad->getTitle()->shouldReturn('Lag Roxane 500, Cherry Sunburst');
    }
}
