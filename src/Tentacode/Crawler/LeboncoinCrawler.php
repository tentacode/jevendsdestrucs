<?php

declare(strict_types = 1);

namespace Tentacode\Crawler;

use Behat\Mink\Exception\ResponseTextException;
use Tentacode\Domain\Ad;
use Tentacode\Domain\Dealer\LeboncoinOptions;

class LeboncoinCrawler extends AbstractCrawler
{
    const LOGOUT_URL = 'https://compteperso.leboncoin.fr/store/logout/0';
    const ACCOUNT_URL = 'https://compteperso.leboncoin.fr/account/index.html';
    const ADD_AD_URL = 'https://www2.leboncoin.fr/ai/form/';

    const AD_ACCEPTED = 'Nous avons bien reçu votre annonce.';

    protected function isLoggedIn(): bool
    {
        $this->visit(self::ACCOUNT_URL);

        try {
            $this->assert()->pageTextNotContains('Se connecter');
        } catch (ResponseTextException $e) {
            return false;
        }

        return true;
    }

    protected function logIn()
    {
        $this->fillField('st_username', $this->profile->getLeboncoinEmail());
        $this->fillField('st_passwd', $this->profile->getLeboncoinPassword());
        $this->pressButton('connect_button');

        $this->assert()->pageTextContains('Se déconnecter');
    }

    protected function adExists(Ad $ad): bool
    {
        $this->visit(self::ACCOUNT_URL);

        try {
            $this->assert()->pageTextContains($ad->getTitle());
        } catch (ResponseTextException $e) {
            return false;
        }

        return true;
    }

    protected function addAd(Ad $ad)
    {
        $this->clickLink("Déposer une annonce");

        $leboncoinOptions = $ad->getDealerOption(LeboncoinOptions::class);

        $this->findField('category')->selectOption($leboncoinOptions->getCategory());
        $this->fillField('subject', $ad->getTitle());
        $this->fillField('body', $ad->getText());
        $this->fillField('price', $ad->getPrice());

        $hidePhoneField = $this->findField('phone_hidden');
        $ad->getAllowPhoneContact() ?
            $hidePhoneField->uncheck() :
            $hidePhoneField->check()
        ;

        $pictures = array_slice($ad->getPictures(), 0, 3);
        foreach ($pictures as $key => $picture) {
            $this->findField('image'.$key)->attachFile($this->getPicturePath($picture));

            $this->spins(function () use ($key) {
                $uploadPhoto = $this->find('css', '#uploadPhoto-'.$key);

                if ($uploadPhoto->getAttribute('data-state') !== 'uploaded') {
                    throw new \RuntimeException("Picture was not uploaded.");
                }
            });
        }

        $this->spins(function () {
            $emailField = $this->find('css', '#email');
            if (!$emailField || $emailField->getAttribute('value') !== $this->profile->getLeboncoinEmail()) {
                throw new \RuntimeException("User not properly authenticated.");
            }
        });

        $this->pressButton('newadSubmit');

        $this->spins(function () {
            $rulesField =  $this->findField('accept_rule');

            if (!$rulesField) {
                throw new \Exception("Rule checkbox not found.");
            }

            $rulesField->check();
            $this->find('css', 'h2.title')->click();

            $this->pressButton('lbc_submit');
        });

        $this->assert()->pageTextContains(self::AD_ACCEPTED);
    }
}
