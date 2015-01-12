<?php

use PHPUnityo\PHPUnityoNoApiTokenError;
use TinyConfig\TinyConfig;
use Yo\Service\SendYoService;
use Yo\Yo;

/**
 * Class PHPUnit_Yo
 */
class PHPUnit_Yo extends PHPUnit_Framework_BaseTestListener
{
    const TRAVIS_BASE_URI = 'https://travis-ci.org/';

    /**
     * @param  string                   $sendUser
     * @param  bool                     $onSuccess
     * @param  bool                     $onFailure
     * @throws PHPUnityoNoApiTokenError
     */
    public function __construct($sendUser, $onSuccess = false, $onFailure = false)
    {
        $apiToken = getenv('YO_API_TOKEN');
        if (empty($apiToken)) {
            throw new PHPUnityoNoApiTokenError('you should set Yo API token in ENV.');
        }
        TinyConfig::set('sendUser', $sendUser);
        TinyConfig::set('onSuccess', $onSuccess);
        TinyConfig::set('onFailure', $onFailure);
        TinyConfig::set('yo_api_token', $apiToken);
    }

    /**
     * @param PHPUnit_Framework_Test $test
     * @param float                  $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        if (! TinyConfig::get('onSuccess') === 'true') {
            return;
        }

        list($repoSlug, $jobId) = [getenv('TRAVIS_REPO_SLUG'), getenv('TRAVIS_BUILD_ID')];
        if (isset($repoSlug) && isset($jobId)) {
            $this->sendYo(self::TRAVIS_BASE_URI.$repoSlug.'/builds/'.$jobId);
        } else {
            $this->sendYo();
        }
    }

    /**
     * @param PHPUnit_Framework_Test                 $test
     * @param PHPUnit_Framework_AssertionFailedError $e
     * @param float                                  $time
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        if (! TinyConfig::get('onFailure') === 'true') {
            return;
        }

        list($repoSlug, $jobId) = [getenv('TRAVIS_REPO_SLUG'), getenv('TRAVIS_BUILD_ID')];
        if (isset($repoSlug) && isset($jobId)) {
            $this->sendYo(self::TRAVIS_BASE_URI.$repoSlug.'/builds/'.$jobId);
        } else {
            $this->sendYo();
        }
    }

    /**
     * @param  string                               $link
     * @throws \TinyConfig\TinyConfigEmptyException
     * @throws \Yo\Exception\BadResponseException
     */
    private function sendYo($link = '')
    {
        $yoConfig = ['token' => TinyConfig::get('yo_api_token')];
        if (! empty($link)) {
            $yoConfig['link'] = $link;
        }
        $yoClient = new Yo($yoConfig);

        (new SendYoService($yoClient->getHttpClient(), $yoClient->getOptions()))->yo(TinyConfig::get('sendUser'));
    }
}
