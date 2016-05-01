<?php

declare(strict_types = 1);

namespace Tentacode\Crawler;

use Tentacode\Domain\Ad;

class AudiofanzineCrawler extends AbstractCrawler
{
    protected function isLoggedIn(): bool
    {
        return false;
    }

    protected function logIn()
    {
    }

    protected function adExists(Ad $ad): bool
    {
        return $ad->getTitle() === '';
    }

    protected function addAd(Ad $ad)
    {
        $ad->getTitle();
    }
}
