<?php

declare(strict_types = 1);

namespace Tentacode\Repository;

use Symfony\Component\Finder\Finder;
use Tentacode\Serialization\AdSerializer;

class AdRepository
{
    protected $adSerializer;

    public function __construct(AdSerializer $adSerializer)
    {
        $this->adSerializer = $adSerializer;
    }

    public function getAds(): array
    {
        $ads = [];

        $finder = new Finder();
        $finder->files()->in($this->getAdsDirectory());

        foreach ($finder as $file) {
            $ads[] = $this->adSerializer->deserialize(file_get_contents($file->getRealPath()));
        }

        return $ads;
    }

    protected function getAdsDirectory(): string
    {
        $dir = __DIR__;

        return sprintf(
            '%s/data/ads',
            substr($dir, 0, strpos($dir, '/src'))
        );
    }
}
