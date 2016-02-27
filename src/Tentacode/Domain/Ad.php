<?php

declare(strict_types = 1);

namespace Tentacode\Domain;

use Tentacode\Domain\Dealer\AdOptions;

class Ad
{
    protected $title;
    protected $text;
    protected $price;
    protected $allowPhoneContact = false;
    protected $pictures = [];
    protected $dealerOptions = [];

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setAllowPhoneContact(bool $allowPhoneContact)
    {
        $this->allowPhoneContact = $allowPhoneContact;
    }

    public function getAllowPhoneContact(): bool
    {
        return $this->allowPhoneContact;
    }

    public function setPictures(array $pictures)
    {
        $this->pictures = $pictures;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function addDealerOptions(AdOptions $adOptions)
    {
        $sameClassOptions = array_filter($this->dealerOptions, function($options) use ($adOptions) {
            return get_class($options) === get_class($adOptions);
        });

        if (sizeof($sameClassOptions) > 0) {
            throw new \InvalidArgumentException(sprintf(
                'Cannot add another %s as an option of this type has already been added.',
                get_class($adOptions)
            )); 
        }

        $this->dealerOptions[] = $adOptions;
    }

    public function getDealerOptions(): array
    {
        return $this->dealerOptions;
    }
}