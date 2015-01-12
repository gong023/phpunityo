PHPUnityo
=====================

[![Build Status](https://travis-ci.org/gong023/phpunityo.svg)](https://travis-ci.org/gong023/phpunityo)

Send [Yo](http://www.justyo.co/) when PHPUnit successes or fails.

You can use at [travis](https://travis-ci.org).

# How to use

## 1. Set up Yo

Get api token from http://dev.justyo.co/, and export it.

```bash
export YO_API_TOKEN="xxxx"
```
If you want to use PHPUnityo at travis, encrypt token.

```bash
gem install travis # if you need
travis encrypt -r your/repository YO_API_TOKEN=xxxx
```

And add encrypted token to .travis.yml

```yml
env:
  global:
    YO_API_TOKEN='yourencryptedtoken'
```

## 2. Setup PHPUnityo

Install PHPUnityo.

```bash
composer require --dev gong023/phpunityo:0.1.*
```

Add PHPUnit listener setting to your phpunit.xml.dist.

```xml
<listeners>
  <listener class="PHPUnit_Yo" file="vendor/gong023/src/PHPUnit_Yo.php">
    <arguments>
      <string name="sendUser">Your Name</string>
      <string name="onSuccess">false</string>
      <string name="onFailure">true</string>
    </arguments>
  </listener>
</listeners>
```

That's all.

If you turn `onSuccess` on at phpunit.xml.dist, PHPUnityo sends Yo only when test successes.

If you turn `onFailure` on at phpunit.xml.dist, PHPUnityo sends Yo only when test fails.

At travis-ci.org, PHPUnityo sends Yo with build URL.
