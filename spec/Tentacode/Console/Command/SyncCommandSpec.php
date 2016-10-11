<?php

namespace spec\Tentacode\Console\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Output\OutputInterface;
use Tentacode\Domain\Ad;
use Tentacode\Domain\Dealer\LeboncoinOptions;
use Tentacode\Domain\Dealer\AudiofanzineOptions;
use Tentacode\Repository\AdRepository;
use Tentacode\Crawler\LeboncoinCrawler;
use Tentacode\Crawler\AudiofanzineCrawler;

class SyncCommandSpec extends ObjectBehavior
{
    function let(
        AdRepository $adRepository,
        Ad $ad,
        OutputInterface $output,
        LeboncoinCrawler $leboncoinCrawler,
        AudiofanzineCrawler $audiofanzineCrawler
    ) {
        $ad->getTitle()->willReturn('Guitar');
        $ad->getDealerOptions()->willReturn([]);
        $adRepository->getAds()->willReturn([$ad]);

        $this->beConstructedWith($adRepository, $leboncoinCrawler, $audiofanzineCrawler);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tentacode\Console\Command\SyncCommand');
    }

    function it_synchronize_an_ad_on_leboncoin($output, $ad, $adRepository, LeboncoinOptions $leboncoinOptions)
    {
        $leboncoinOptions->isProcessed()->willReturn(false);
        $ad->getDealerOptions()->willReturn([
            $leboncoinOptions
        ]);

        $leboncoinOptions->setIsProcessed(true)->shouldBeCalled();
        $output->writeln('<info>Syncing offers...</info>')->shouldBeCalled();
        $output->writeln('<info>Ad "Guitar" was synced on Leboncoin.</info>')->shouldBeCalled();
        $adRepository->updateAd($ad)->shouldBeCalled();

        $this->__invoke($output);
    }

    function it_synchronize_an_ad_on_audiofanzine($output, $ad, $adRepository, AudiofanzineOptions $audiofanzineOptions)
    {
        $audiofanzineOptions->isProcessed()->willReturn(false);
        $ad->getDealerOptions()->willReturn([
            $audiofanzineOptions
        ]);

        $audiofanzineOptions->setIsProcessed(true)->shouldBeCalled();
        $output->writeln('<info>Syncing offers...</info>')->shouldBeCalled();
        $output->writeln('<info>Ad "Guitar" was synced on Audiofanzine.</info>')->shouldBeCalled();
        $adRepository->updateAd($ad)->shouldBeCalled();

        $this->__invoke($output);
    }

    function it_does_not_synchronize_if_ad_as_no_dealer_options($output)
    {
        $output->writeln('<error>Ad was not synced: Ad has no associated dealer options.</error>');

        $this->__invoke($output);
    }

    function it_does_not_synchronize_if_ad_is_already_processed($output, $ad, AudiofanzineOptions $audiofanzineOptions)
    {
        $audiofanzineOptions->isProcessed()->willReturn(true);
        $ad->getDealerOptions()->willReturn([
            $audiofanzineOptions
        ]);

        $output->writeln('<error>Ad was not synced: Ad has no associated dealer options.</error>');

        $this->__invoke($output);
    }
}
