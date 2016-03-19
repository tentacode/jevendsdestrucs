<?php

declare(strict_types = 1);

namespace Tentacode\Serialization;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tentacode\Domain\Ad;
use Tentacode\Domain\Dealer\AudiofanzineOptions;
use Tentacode\Domain\Dealer\LeboncoinOptions;

class AdSerializer
{
    public function deserialize(string $yaml): Ad
    {
        $parser = new Parser();

        $data = $parser->parse($yaml);
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Not a valid yaml format.');
        }

        $resolved = $this->resolve($data);

        $ad = new Ad();
        $ad->setTitle($resolved['title']);
        $ad->setText($resolved['text']);
        $ad->setPrice($resolved['price']);
        $ad->setAllowPhoneContact($resolved['allow_phone_contact']);
        $ad->setPictures($resolved['pictures']);

        if (isset($resolved['audiofanzine'])) {
            $ad->addDealerOptions(new AudiofanzineOptions(
                $resolved['audiofanzine']['product'],
                $resolved['audiofanzine']['condition'],
                $resolved['audiofanzine']['with_accessories']
            ));
        }

        if (isset($resolved['leboncoin'])) {
            $ad->addDealerOptions(new LeboncoinOptions($resolved['leboncoin']['category']));
        }

        return $ad;
    }

    protected function resolve(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired([
            'title',
            'text',
        ]);

        $resolver->setDefaults([
            'allow_phone_contact' => false,
            'price' => 0,
            'pictures' => [],
            'leboncoin' => null,
            'audiofanzine' => null,
        ]);

        $resolver->setAllowedTypes('title', 'string');
        $resolver->setAllowedTypes('text', 'string');
        $resolver->setAllowedTypes('price', 'int');
        $resolver->setAllowedTypes('allow_phone_contact', 'bool');
        $resolver->setAllowedTypes('pictures', 'array');
        $resolver->setAllowedTypes('leboncoin', 'array');
        $resolver->setAllowedTypes('audiofanzine', 'array');

        return $resolver->resolve($data);
    }
}
