<?php

namespace spec\Tentacode\Serialization;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdSerializerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Serialization\AdSerializer');
    }

    function it_deserialize_an_ad()
    {
        $ad = $this->deserialize('data/ads/ad-example.yml.dist');

        $ad->shouldHaveType('Tentacode\Domain\Ad');
        $ad->getTitle()->shouldReturn("Lag Roxane 500, Cherry Sunburst");
        $ad->getText()->shouldReturn("Willing to sell this guitar, it's in perfect condition.\n");
        $ad->getPrice()->shouldReturn(500);
        $ad->getAllowPhoneContact()->shouldReturn(true);
        $ad->getPictures()->shouldReturn(['data/pictures/guitar-1.jpg', 'data/pictures/guitar-2.jpg']);

        $dealerOptions = $ad->getDealerOptions();

        $audiofanzineOptions = $dealerOptions[0];
        $audiofanzineOptions->shouldHaveType('Tentacode\Domain\Dealer\AudiofanzineOptions');
        $audiofanzineOptions->getProduct()->shouldReturn('lag roxane 500');
        $audiofanzineOptions->getCondition()->shouldReturn('Perfect condition');
        $audiofanzineOptions->withAccessories()->shouldReturn(false);

        $leboncoinOptions = $dealerOptions[1];
        $leboncoinOptions->shouldHaveType('Tentacode\Domain\Dealer\LeboncoinOptions');
        $leboncoinOptions->getCategory()->shouldReturn('Instruments de musique');
    }
}
