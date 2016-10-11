<?php

declare(strict_types = 1);

namespace Tentacode\Domain\Dealer;

class AudiofanzineOptions extends AdOptions
{
    protected $product;
    protected $condition;
    protected $withAccessories;

    public function __construct(string $product, string $condition, bool $withAccessories, bool $isProcessed)
    {
        $this->product = $product;
        $this->condition = $condition;
        $this->withAccessories = $withAccessories;
        $this->isProcessed = $isProcessed;
    }

    public function getName()
    {
        return 'audiofanzine';
    }

    public function toArray()
    {
        return [
            'product' => $this->product,
            'condition' => $this->condition,
            'with_accessories' => $this->withAccessories,
            'is_processed' => $this->isProcessed,
        ];
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
