<?php
namespace UthandoTwitter\Model;

use UthandoCommon\Model\Collection;
use Zend\Filter\Word\UnderscoreToCamelCase;

class TweetCollection extends Collection
{
    /**
     * @var string
     */
    protected $userName;
    
    /**
     * @var string
     */
    protected $screenName;
    
    /**
     * @var int
     */
    protected $displayLimit = 4;
    
    /**
     * @var bool
     */
    protected $showDirectTweets = false;
    
    /**
     * @var bool
     */
    protected $showRetweets = true;
    
    /**
     * @var bool
     */
    protected $showTweetLinks = true;
    
    /**
     * @var bool
     */
    protected $showProfilePic = true;
    
    /**
     * @var int
     */
    protected $position = 0;
    
    public function __construct(array $tweets = array(), array $options = array())
    {   
        if (!empty($options)) {
            $this->setOptions($options);
        }
        
        if (!empty($tweets)) {
            $this->addTweets($tweets);
        }
    }
    
    public function setOptions(array $options)
    {
        $filter = new UnderscoreToCamelCase();
        
        foreach ($options as $key => $value) {
            $option = 'set' . $filter->filter($key);
            
            if (method_exists($this, $option)) {
                $this->$option($value);
            }
        }
    }
    
    /**
     * @param array $tweets
     */
    public function addTweets($tweets)
    {
        $count = 1;
        
        foreach ($tweets as $tweet) {
            if ($count > $this->getDisplayLimit()) {
                break;
            }
            
            $entity = new Tweet();
            
            $entity->setIdStr($tweet->id_str)
                ->setUserId($tweet->user->id)
                ->setUserName($tweet->user->name)
                ->setScreenName($tweet->user->screen_name)
                ->setProfileImage($tweet->user->profile_image_url_https)
                ->setVerified($tweet->user->verified)
                ->setText($tweet->text)
                ->setTime($tweet->created_at)
                ->setRetweetCount($tweet->retweet_count)
                ->setFavoriteCount($tweet->favorite_count)
                ->setEntities($tweet->entities);

            if (isset($tweet->retweeted_status)) {
                $retweet = new Tweet();
                $retweet->setIdStr($tweet->retweeted_status->id_str)
                    ->setUserId($tweet->retweeted_status->user->id)
                    ->setUserName($tweet->retweeted_status->user->name)
                    ->setScreenName($tweet->retweeted_status->user->screen_name)
                    ->setProfileImage($tweet->retweeted_status->user->profile_image_url_https)
                    ->setVerified($tweet->retweeted_status->user->verified)
                    ->setText($tweet->retweeted_status->text)
                    ->setTime($tweet->retweeted_status->created_at)
                    ->setRetweetCount($tweet->retweeted_status->retweet_count)
                    ->setFavoriteCount($tweet->retweeted_status->favorite_count)
                    ->setEntities($tweet->retweeted_status->entities);
                $entity->setRetweetStatus($retweet);
            }
            
            if (
                (($this->getShowRetweets()) || ((!$entity->isRetweet()) && (!$this->getShowRetweets())))
                && (($this->getShowDirectTweets()) || ((!$this->getShowDirectTweets()) && (!$entity->isDirect())))
                && (strlen($entity->getText()) > 1)
            ) {
                $this->add($entity);
                $count++;
            }
        }
        
        return $this->count();
    }
    
    /**
     * Check to see if we want to terminate this loop.
     */
    public function valid()
    {
        $valid = $this->current();
        
        // stop the loop I want to get off.
        if ((($this->position + 1) > $this->displayLimit)) {
            $valid = false;
        }
        
        return $valid;
    }

	/**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

	/**
     * @param field_type $userName
     */
    public function setUserName($userName)
    {
        $this->userName = (string) $userName;
    }

	/**
     * @return the $screenName
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

	/**
     * @param field_type $screenName
     */
    public function setScreenName($screenName)
    {
        $this->screenName = (string) $screenName;
    }

	/**
     * @return the $displayLimit
     */
    public function getDisplayLimit()
    {
        return $this->displayLimit;
    }

	/**
     * @param number $displayLimit
     */
    public function setDisplayLimit($displayLimit)
    {
        $this->displayLimit = (int) $displayLimit;
    }

	/**
     * @return the $showDirectTweets
     */
    public function getShowDirectTweets()
    {
        return $this->showDirectTweets;
    }

	/**
     * @param boolean $showDirectTweets
     */
    public function setShowDirectTweets($showDirectTweets)
    {
        $this->showDirectTweets = (bool) $showDirectTweets;
    }

	/**
     * @return the $showRetweets
     */
    public function getShowRetweets()
    {
        return $this->showRetweets;
    }

	/**
     * @param boolean $showRetweets
     */
    public function setShowRetweets($showRetweets)
    {
        $this->showRetweets = (bool) $showRetweets;
    }

	/**
     * @return the $showTweetLinks
     */
    public function getShowTweetLinks()
    {
        return $this->showTweetLinks;
    }

	/**
     * @param boolean $showTweetLinks
     */
    public function setShowTweetLinks($showTweetLinks)
    {
        $this->showTweetLinks = (bool) $showTweetLinks;
    }

	/**
     * @return the $showProfilePic
     */
    public function getShowProfilePic()
    {
        return $this->showProfilePic;
    }

	/**
     * @param boolean $showProfilePic
     */
    public function setShowProfilePic($showProfilePic)
    {
        $this->showProfilePic = (bool) $showProfilePic;
    }
}
