<?php

namespace spec\Tentacode\Crawler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LeboncoinCrawlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Crawler\LeboncoinCrawler');
        $this->shouldHaveType('Tentacode\Crawler\AbstractCrawler');
    }
}
