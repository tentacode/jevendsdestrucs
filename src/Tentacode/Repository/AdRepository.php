<?php

declare(strict_types = 1);

namespace Tentacode\Repository;

use Symfony\Component\Finder\Finder;
use Tentacode\Serialization\AdSerializer;

class AdRepository
{
    protected $adSerializer;
    protected $filePattern;

    public function __construct(AdSerializer $adSerializer, $filePattern = '*.yml')
    {
        $this->adSerializer = $adSerializer;
        $this->filePattern = $filePattern;
    }

    public function getAds(): array
    {
        $ads = [];

        $finder = new Finder();
        $finder->files()->name($this->filePattern)->in($this->getAdsDirectory());

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
