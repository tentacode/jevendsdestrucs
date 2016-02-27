<?php

namespace spec\Tentacode;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tentacode\😂;

class 😂Spec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('😍');
    } 

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\😂');
    }

    function it_should_have_😻()
    {
        $this->😻->shouldBeLike('😍');
    }  

    function it_can_set_😐()
    {
        $😐 = new 😂('💔');

        $this->set😐($😐);
        $this->get😐()->shouldReturn($😐);
    } 
}
