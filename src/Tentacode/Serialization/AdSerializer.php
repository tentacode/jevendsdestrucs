<?php

declare(strict_types = 1);

namespace Tentacode\Serialization;

use Symfony\Component\Yaml\Parser;
use Tentacode\Domain\Ad;
use Tentacode\Domain\Dealer\AudiofanzineOptions;
use Tentacode\Domain\Dealer\LeboncoinOptions;

class AdSerializer
{
    public function deserialize($path): Ad
    {
        $yaml = new Parser();

        $data = $yaml->parse(file_get_contents($path));

        $ad = new Ad();
        $ad->setTitle($data['title']);
        $ad->setText($data['text']);
        $ad->setPrice($data['price']);
        $ad->setAllowPhoneContact($data['allow_phone_contact']);
        $ad->setPictures($data['pictures']);

        if (isset($data['audiofanzine'])) {
            $ad->addDealerOptions(new AudiofanzineOptions(
                $data['audiofanzine']['product'],
                $data['audiofanzine']['condition'],
                $data['audiofanzine']['with_accessories']
            ));
        }

        if (isset($data['leboncoin'])) {
            $ad->addDealerOptions(new LeboncoinOptions($data['leboncoin']['category']));
        }

        return $ad;
    }
}
