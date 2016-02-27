<?php

namespace spec\Tentacode\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdSpec extends ObjectBehavior
{
    function let()
    {
        //default values
        $this->getAllowPhoneContact()->shouldReturn(false);
        $this->getPictures()->shouldReturn([]);

        $this->setTitle('Lorem Ipsum');
        $this->setText('Lorem Ipsum Dolor Sit Amet');
        $this->setPrice(100);
        $this->setAllowPhoneContact(true);
        $this->setPictures(['data/picture.jpg']);
    } 

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Domain\Ad');
    }

    function it_has_a_title()
    {
        $this->getTitle()->shouldReturn('Lorem Ipsum');
    }

    function it_has_a_text()
    {
        $this->getText()->shouldReturn('Lorem Ipsum Dolor Sit Amet');
    }

    function it_has_a_price()
    {
        $this->getPrice()->shouldReturn(100);
    }

    function it_tells_if_phone_contact_is_allowed()
    {
        $this->getAllowPhoneContact()->shouldReturn(true);
    }

    function it_has_pictures()
    {
        $this->getPictures()->shouldReturn(['data/picture.jpg']);
    }
}
