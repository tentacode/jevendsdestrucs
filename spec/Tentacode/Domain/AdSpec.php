<?php

namespace spec\Tentacode\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tentacode\Domain\Dealer\LeboncoinOptions;

class AdSpec extends ObjectBehavior
{
    function let()
    {
        //default values
        $this->getAllowPhoneContact()->shouldReturn(false);
        $this->getPictures()->shouldReturn([]);
        $this->getDealerOptions()->shouldReturn([]);

        $this->setTitle('Lorem Ipsum');
        $this->setText('Lorem Ipsum Dolor Sit Amet');
        $this->setPrice(100);
        $this->setAllowPhoneContact(true);
        $this->setPictures(['data/picture.jpg']);

        $this->addDealerOptions(new LeboncoinOptions('foo'));
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

    function it_has_dealer_options()
    {
        $this->getDealerOptions()->shouldBeLike([new LeboncoinOptions('foo')]);
    }

    function it_cant_add_a_dealer_options_from_already_existing_type()
    {
        $anotherOptions = new LeboncoinOptions('bar');

        $this
            ->shouldThrow(new \InvalidArgumentException(sprintf(
                'Cannot add another %s as an option of this type has already been added.',
                LeboncoinOptions::class
            )))
            ->duringAddDealerOptions($anotherOptions)
        ;
    }
}
