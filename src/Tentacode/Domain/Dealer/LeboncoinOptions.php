<?php

declare(strict_types = 1);

namespace Tentacode\Domain\Dealer;

class LeboncoinOptions extends AdOptions
{
    protected $category;

    public function __construct(string $category, bool $isProcessed)
    {
        $this->category = $category;
        $this->isProcessed = $isProcessed;
    }

    public function getName()
    {
        return 'leboncoin';
    }

    public function toArray()
    {
        return [
            'category' => $this->category,
            'is_processed' => $this->isProcessed,
        ];
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}
