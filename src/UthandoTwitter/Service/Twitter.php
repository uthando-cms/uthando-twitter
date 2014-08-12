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
     * @var ZendService\Twitter\Twitter
     */
    protected $twitter;
    
    /**
     * @var array
     */
    protected $options;
    
    public function getUserTimeLine($screenName = null)
    {
        $response = $this->twitter->statusesUserTimeline([
            'screen_name'   => ($screenName) ? $screenName : $this->getOption('screen_name')
        ]);
        
        return $this->processTweets($response);
    }
    
    public function processTweets(Response $response)
    {
        if ($response->isSuccess()) {
            $tweets = new TweetCollection($response->toValue(), $this->getOptions());
        } else {
            $tweets = $response->getErrors();
        }
        
        return $tweets;
    }
    
    public function getOption($option)
    {
        if (!in_array($option, $this->options)) {
            return null;
        }
        
        return $this->options[$option];
    }
    
    public function setOptions(array $options)
    {
        $this->options = $options;
        
        return $this;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * @param ZendService\Twitter\Twitter $twitter
     */
    public function setTwitter(TwitterService $twitter)
    {
        $this->twitter = $twitter;
    }
    
    /**
     * return ZendService\Twitter\Twitter
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
}
