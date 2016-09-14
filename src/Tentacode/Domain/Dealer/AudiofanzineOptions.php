<?php

declare(strict_types = 1);

namespace Tentacode\Domain\Dealer;

class AudiofanzineOptions extends AdOptions
{
    protected $product;
    protected $condition;
    protected $withAccessories;

    public function __construct(string $product, string $condition, bool $withAccessories)
    {
        $this->product = $product;
        $this->condition = $condition;
        $this->withAccessories = $withAccessories;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function withAccessories(): bool
    {
        return $this->withAccessories;
    }
}
