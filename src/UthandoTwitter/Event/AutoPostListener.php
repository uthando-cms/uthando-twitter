<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter\Event
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoTwitter\Event;

use UthandoCommon\Service\AbstractService;
use UthandoTwitter\Service\Twitter;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

class AutoPostListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $events = $events->getSharedManager();

        $this->listeners[] = $events->attach(
            AbstractService::class,
            'update.twitter.status',
            [$this, 'twitterStatusUpdate']
        );
    }

    public function twitterStatusUpdate(Event $e)
    {
        /* @var Twitter $twitter */
        $twitter = $e->getTarget()->getService(Twitter::class);
        $status = $e->getParam('status');

        $response = $twitter->getTwitter()->statusesUpdate($status);

        $e->setParam('response', $response);

    }
}