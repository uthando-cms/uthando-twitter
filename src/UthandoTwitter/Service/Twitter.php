<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoTwitter\Service;

use UthandoTwitter\Model\TweetCollection;
use ZendService\Twitter\Response;
use ZendService\Twitter\Twitter as TwitterService;
use UthandoCommon\Cache\CacheTrait;

/**
 * Class Twitter
 *
 * @package UthandoTwitter\Service
 */
class Twitter
{
    use CacheTrait;

    /**
     * @var TwitterService
     */
    protected $twitter;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param null $screenName
     * @return array|TweetCollection
     */
    public function getUserTimeLine($screenName = null)
    {
        $response = $this->getCacheItem($screenName);

        if (!$response) {
            $response = $this->getTwitter()->statusesUserTimeline([
                'screen_name' => ($screenName) ? $screenName : $this->getOption('screen_name')
            ]);

            $this->setCacheItem($screenName, $response);
        }

        return $this->processTweets($response);
    }

    /**
     * @param $option
     * @return null
     */
    public function getOption($option)
    {
        if (!in_array($option, $this->options)) {
            return null;
        }

        return $this->options[$option];
    }

    /**
     * @param Response $response
     * @return array|TweetCollection
     */
    public function processTweets(Response $response)
    {
        if ($response->isSuccess()) {
            $tweets = new TweetCollection($response->toValue(), $this->getOptions());
        } else {
            $errors = $response->getErrors();
            $tweets = [
                'errors' => $errors,
            ];
        }

        return $tweets;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return TwitterService
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param TwitterService $twitter
     * @return $this
     */
    public function setTwitter(TwitterService $twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }
}
