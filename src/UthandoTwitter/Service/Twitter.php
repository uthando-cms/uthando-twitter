<?php
namespace UthandoTwitter\Service;

use UthandoTwitter\Model\TweetCollection;
use ZendService\Twitter\Response;
use ZendService\Twitter\Twitter as TwitterService;
use UthandoCommon\Cache\CacheTrait;

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
            $response = $this->twitter->statusesUserTimeline([
                'screen_name' => ($screenName) ? $screenName : $this->getOption('screen_name')
            ]);

            $this->setCacheItem($screenName, $response);
        }

        return $this->processTweets($response);
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
            $tweets = $response->getErrors();
        }
        
        return $tweets;
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
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
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

    /**
     * @return TwitterService
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
}
