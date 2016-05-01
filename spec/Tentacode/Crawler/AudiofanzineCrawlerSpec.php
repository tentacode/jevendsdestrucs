<?php

namespace spec\Tentacode\Crawler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tentacode\Domain\Profile;

class AudiofanzineCrawlerSpec extends ObjectBehavior
{
    function let(Profile $profile)
    {
        $this->beConstructedWith($profile);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Crawler\AudiofanzineCrawler');
        $this->shouldHaveType('Tentacode\Crawler\AbstractCrawler');
    }
}
