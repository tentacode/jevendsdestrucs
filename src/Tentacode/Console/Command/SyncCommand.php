<?php

declare(strict_types = 1);

namespace Tentacode\Console\Command;

use Symfony\Component\Console\Output\OutputInterface;
use Tentacode\Repository\AdRepository;
use Tentacode\Domain\Ad;
use Tentacode\Domain\Dealer\LeboncoinOptions;
use Tentacode\Domain\Dealer\AudiofanzineOptions;
use Tentacode\Crawler\LeboncoinCrawler;
use Tentacode\Crawler\AudiofanzineCrawler;

class SyncCommand
{
    protected $output;
    protected $adRepository;
    protected $leboncoinCrawler;
    protected $audiofanzineCrawler;

    public function __construct(
        AdRepository $adRepository,
        LeboncoinCrawler $leboncoinCrawler,
        AudiofanzineCrawler $audiofanzineCrawler
    ) {
        $this->adRepository = $adRepository;
        $this->leboncoinCrawler = $leboncoinCrawler;
        $this->audiofanzineCrawler = $audiofanzineCrawler;
    }

    public function __invoke(OutputInterface $output)
    {
        $this->output = $output;
        $this->output->writeln('<info>Syncing offers...</info>');

        $ads = $this->adRepository->getAds();
        foreach ($ads as $ad) {
            try {
                $this->synchronize($ad);
            } catch (\Exception $e) {
                $this->output->writeln(sprintf(
                    '<error>Ad was not synced: %s</error>',
                    $e->getMessage()
                ));
            }
        }
    }

    protected function synchronize(Ad $ad)
    {
        $dealerOptions = $ad->getDealerOptions();
        if (sizeof($dealerOptions) === 0) {
            throw new \InvalidArgumentException('Ad has no associated dealer options.');
        }

        foreach ($dealerOptions as $dealerOption) {
            if ($dealerOption instanceof LeboncoinOptions) {
                $this->synchronizeLeboncoin($ad);
                continue;
            } elseif ($dealerOption instanceof AudiofanzineOptions) {
                $this->synchronizeAudiofanzine($ad);
                continue;
            }

            throw new \InvalidArgumentException(sprintf(
                'Unsupported dealer options "%s".',
                get_class($dealerOptions)
            ));
        }
    }

    protected function synchronizeLeboncoin(Ad $ad)
    {
        $this->leboncoinCrawler->synchronize($ad);

        $this->output->writeln(sprintf(
            '<info>Ad "%s" was synced on Leboncoin.</info>',
            $ad->getTitle()
        ));
    }

    protected function synchronizeAudiofanzine(Ad $ad)
    {
        $this->audiofanzineCrawler->synchronize($ad);

        $this->output->writeln(sprintf(
            '<info>Ad "%s" was synced on Audiofanzine.</info>',
            $ad->getTitle()
        ));
    }
}
