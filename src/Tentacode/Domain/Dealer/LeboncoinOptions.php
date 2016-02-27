<?php

declare(strict_types = 1);

namespace Tentacode\Domain\Dealer;

class LeboncoinOptions implements AdOptions
{
    protected $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}