<?php

namespace spec\Tentacode\Crawler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AudiofanzineCrawlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Crawler\AudiofanzineCrawler');
        $this->shouldHaveType('Tentacode\Crawler\AbstractCrawler');
    }
}
