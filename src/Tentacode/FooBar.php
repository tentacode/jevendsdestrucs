<?php

// declare(strict_types = 1);

namespace Tentacode;

class FooBar
{
    protected $foo;

    public function setFoo(int $foo)
    {
        $this->foo = $foo;
    } 

    public function getFoo(): int
    {
        return $this->foo;
    } 
}
