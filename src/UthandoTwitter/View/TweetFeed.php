<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter\View
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoTwitter\View;

use UthandoCommon\View\AbstractViewHelper;
use Zend\Stdlib\Exception\RuntimeException;
use Zend\Stdlib\Exception\InvalidArgumentException;
use Zend\View\Helper\Partial;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class TweetFeed
 *
 * @package UthandoTwitter\View
 * @method PhpRenderer getView()
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
    protected $partial = 'uthando-twitter/twitter/twitter-feed';

    /**
     * @return $this
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        $partial = $this->getPartial();

        return $this->renderPartial($partial);
    }

    /**
     * @param null $partial
     * @return string
     */
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

        $model = array(
            'tweets' => $timeLine
        );

        /** @var Partial $partialHelper */
        $partialHelper = $this->getView()->plugin('partial');

        if (is_array($partial)) {
            if (count($partial) != 2) {
                throw new InvalidArgumentException(
                    'Unable to render menu: A view partial supplied as '
                    . 'an array must contain two values: partial view '
                    . 'script and module where script can be found'
                );
            }

            return $partialHelper($partial[0], /*$partial[1], */
                $model);
        }

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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
