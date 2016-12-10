[![Build Status](https://travis-ci.org/tentacode/jevendsdestrucs.svg?branch=master)](https://travis-ci.org/tentacode/jevendsdestrucs)

# jevendsdestrucs

**Disclaimer : this is a lab project, mostly for me to fiddle with stuff, USE AT YOUR OWN RISKS. By using Leboncoin or Audiofanzine providers, you agree on their usage terms.**

## What is this?

This project is meant to automatize offer creation in several online dealers, currently only French dealers Leboncoin and Audiofanzine are to be supported.

You just write your offers in YAML format, launch the command and they are automatically synchronized online with the chosen providers.

## Try it yourself with Vagrant

```
vagrant up
vagrant ssh -c "cd /vagrant && bin/app sync"
```

Note that you must first add your profile credentials by copying `data/config/profile.yml.dist` in `data/config/profile.yml`. Then add several ads in `data/ads` following the format of the example `data/ads/ad-example.yml.dist`.

It is still highly experimental (probably forever) so don't expect much of this. :)

## Technologies used

I used PHP7, Silly, php-di, several Symfony Components and Mink. Find more in [composer.json](composer.json).
