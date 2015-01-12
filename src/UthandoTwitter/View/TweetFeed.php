<?php
namespace UthandoTwitter\View;

use UthandoCommon\View\AbstractViewHelper;
use Zend\Stdlib\Exception\RuntimeException;
use Zend\Stdlib\Exception\InvalidArgumentException;

/**
 * View Helper
 * 
 */
class TweetFeed extends AbstractViewHelper
{
    /**
     * @var \UthandoTwitter\Service\Twitter
     */
    protected $twitter;
    
    /**
     * Partial view script to use for rendering tweet feed
     *
     * @var string|array
     */
    protected $partial = 'uthando-twitter-feed';
    
    public function __invoke()
    {
        return $this;
    }
    
    public function render()
    {
        $partial = $this->getPartial();

        return $this->renderPartial($partial);
    }
    
    public function renderPartial($partial = null)
    {
        if (null === $partial) {
            $partial = $this->getPartial();
        }
    
        if (empty($partial)) {
            throw new RuntimeException(
                'Unable to render menu: No partial view script provided'
            );
        }

        $timeLine = $this->getTwitter()->getUserTimeLine();

        if (is_array($timeLine) && $timeLine[0]->code == '32') {
            $timeLine = [];
        }



        $model = array(
            'tweets' => $timeLine
        );
    
        if (is_array($partial)) {
            if (count($partial) != 2) {
                throw new InvalidArgumentException(
                    'Unable to render menu: A view partial supplied as '
                    .  'an array must contain two values: partial view '
                    .  'script and module where script can be found'
                );
            }
            
            $partialHelper = $this->view->plugin('partial');
            return $partialHelper($partial[0], /*$partial[1], */$model);
        }
    
        $partialHelper = $this->view->plugin('partial');
        return $partialHelper($partial, $model);
    }
    
    /**
     * Gets the twitter instance
     * 
     * @return \UthandoTwitter\Service\Twitter
     */
    public function getTwitter()
    {
        if (!$this->twitter) {
            $this->twitter = $this->getServiceLocator()
                ->getServiceLocator()
                ->get('UthandoTwitter\Service\Twitter');
        }
        
        return $this->twitter;
    }
    
    /**
     * Sets which partial view script to use for rendering tweets
     *
     * @param  string|array $partial
     * @return \UthandoTwitter\View\TweetFeed
     */
    public function setPartial($partial)
    {
        if (null === $partial || is_string($partial) || is_array($partial)) {
            $this->partial = $partial;
        }
    
        return $this;
    }
    
    /**
     * Returns partial view script to use for rendering tweets
     *
     * @return string|array|null
     */
    public function getPartial()
    {
        return $this->partial;
    }

    public function __toString()
    {
        return $this->render();
    }
}
