<?php

namespace Tentacode\Domain\Dealer;

abstract class AdOptions
{
    protected $isProcessed = false;

    public function isProcessed(): bool
    {
        return $this->isProcessed();
    }

    public function setIsProcessed(bool $isProcessed)
    {
        $this->isProcessed = $isProcessed;
    }
}
