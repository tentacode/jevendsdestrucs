<?php

declare(strict_types = 1);

namespace Tentacode\Domain;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Profile
{
    protected $profile;

    public function __construct(string $filePattern = 'profile.yml')
    {
        $finder = new Finder();
        $finder->files()->name($filePattern)->in($this->getConfigDirectory());

        $profiles = [];
        foreach ($finder as $file) {
            $profiles[] = $this->deserialize(file_get_contents($file->getRealPath()));
        }

        if (sizeof($profiles) == 0) {
            throw new \RuntimeException('No profile file found.');
        }

        $this->profile = $profiles[0];
    }

    public function getLeboncoinEmail()
    {
        if (!isset($this->profile['leboncoin']['email'])) {
            throw new \RuntimeException('Leboncoin email not defined in profile.yml');
        }

        return $this->profile['leboncoin']['email'];
    }

    public function getLeboncoinPassword()
    {
        if (!isset($this->profile['leboncoin']['password'])) {
            throw new \RuntimeException('Leboncoin password not defined in profile.yml');
        }

        return $this->profile['leboncoin']['password'];
    }

    public function getAudiofanzineEmail()
    {
        if (!isset($this->profile['audiofanzine']['email'])) {
            throw new \RuntimeException('Audiofanzine email not defined in profile.yml');
        }

        return $this->profile['audiofanzine']['email'];
    }

    public function getAudiofanzinePassword()
    {
        if (!isset($this->profile['audiofanzine']['password'])) {
            throw new \RuntimeException('Audiofanzine password not defined in profile.yml');
        }

        return $this->profile['audiofanzine']['password'];
    }

    protected function deserialize(string $yaml): array
    {
        $parser = new Parser();

        $data = $parser->parse($yaml);
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Not a valid yaml format for profile.yml.');
        }

        return $this->resolve($data);
    }

    protected function resolve(array $data)
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'leboncoin' => [
                'email' => null,
                'password' => null,
            ],
            'audiofanzine' => [
                'email' => null,
                'password' => null,
            ],
        ]);

        $resolver->setAllowedTypes('leboncoin', 'array');
        $resolver->setAllowedTypes('audiofanzine', 'array');

        return $resolver->resolve($data);
    }

    protected function getConfigDirectory(): string
    {
        $dir = __DIR__;

        return sprintf(
            '%s/data/config',
            substr($dir, 0, strpos($dir, '/src'))
        );
    }
}
