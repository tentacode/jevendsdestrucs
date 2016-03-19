<?php

declare(strict_types = 1);

namespace Tentacode\Crawler;

use Tentacode\Domain\Ad;

abstract class AbstractCrawler
{
    abstract protected function isLoggedIn(): bool;
    abstract protected function logIn();
    abstract protected function adExists(Ad $ad): bool;
    abstract protected function addAd(Ad $ad);

    public function synchronize(Ad $ad)
    {
        if (!$this->isLoggedIn()) {
            $this->logIn();
        }

        if ($this->adExists($ad)) {
            throw new \RuntimeException("Ad already exists.");
        }

        $this->addAd($ad);
    }
}
