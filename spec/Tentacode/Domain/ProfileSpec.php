<?php

namespace spec\Tentacode\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProfileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('profile.yml.dist');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Domain\Profile');
    }

    function it_has_leboincoin_logins()
    {
        $this->getLeboncoinEmail()->shouldReturn('lbc@foo.com');
        $this->getLeboncoinPassword()->shouldReturn('lbcfoobar');
    }

    function it_has_audiofanzine_logins()
    {
        $this->getAudiofanzineEmail()->shouldReturn('af@foo.com');
        $this->getAudiofanzinePassword()->shouldReturn('affoobar');
    }
}
