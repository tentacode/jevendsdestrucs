<?php

declare(strict_types = 1);

namespace Tentacode\Domain;

class Ad
{
    protected $title;
    protected $text;
    protected $price;
    protected $allowPhoneContact = false;
    protected $pictures = [];

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
}
