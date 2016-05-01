<?php

declare(strict_types = 1);

namespace Tentacode\Crawler;

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Session;
use Behat\Mink\Mink;
use Tentacode\Domain\Ad;
use Tentacode\Domain\Profile;

abstract class AbstractCrawler
{
    abstract protected function isLoggedIn(): bool;
    abstract protected function logIn();
    abstract protected function adExists(Ad $ad): bool;
    abstract protected function addAd(Ad $ad);

    protected $mink;
    protected $session;

    protected static $wsendUser = null;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;

        $driver = new Selenium2Driver('phantomjs');
        $this->session = new Session($driver);
        $this->session->start();
        $this->session->resizeWindow(1280, 960, 'current');

        $this->mink = new Mink();
        $this->mink->registerSession('selenium2', $this->session);
        $this->mink->setDefaultSessionName('selenium2');
    }

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

    public function takeScreenshot()
    {
        $screenshot = $this->getSession()->getDriver()->getScreenshot();

        $filename = $this->getScreenshotFilename();
        file_put_contents($filename, $screenshot);

        $url = $this->getScreenshotUrl($filename);

        print sprintf("Screenshot is available : %s\n", $url);
    }

    protected function getScreenshotUrl($filename)
    {
        if (!self::$wsendUser) {
            self::$wsendUser = $this->getWsendUser();
        }

        exec(sprintf(
            'curl -F "uid=%s" -F "filehandle=@%s" %s 2>/dev/null',
            self::$wsendUser,
            $filename,
            'https://wsend.net/upload_cli'
        ), $output, $return);

        if (!$return) {
            return 'Not available';
        }

        return $output[0];
    }

    protected function getWsendUser()
    {
        // create a wsend anonymous user
        $curl = curl_init('https://wsend.net/createunreg');
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'start=1');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $wsendUser = curl_exec($curl);
        curl_close($curl);

        return $wsendUser;
    }

    protected function getScreenshotFilename()
    {
        return sprintf('%s/%s.png', sys_get_temp_dir(), uniqid());
    }

    public function __call($method, $parameters)
    {
        $page = $this->session->getPage();
        if (method_exists($page, $method)) {
            return call_user_func_array(array($page, $method), $parameters);
        }

        if (method_exists($this->session, $method)) {
            return call_user_func_array(array($this->session, $method), $parameters);
        }

        throw new \RuntimeException(sprintf('The "%s()" method does not exist.', $method));
    }

    protected function assert()
    {
        return $this->mink->assertSession();
    }

    protected function getLogDirectory(): string
    {
        return sprintf(
            '%s/logs/error',
            substr(__DIR__, 0, strpos(__DIR__, '/src'))
        );
    }

    protected function getPicturePath($path): string
    {
        return sprintf(
            '%s/%s',
            substr(__DIR__, 0, strpos(__DIR__, '/src')),
            ltrim($path, '/')
        );
    }

    protected function spins($closure, $tries = 10)
    {
        for ($i = 0; $i <= $tries; $i++) {
            try {
                $closure();

                return;
            } catch (\Exception $e) {
                if ($i == $tries) {
                    throw $e;
                }
            }

            sleep(1);
        }
    }
}
