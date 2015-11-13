<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoTwitter\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use UthandoCommon\Service\ServiceTrait;
use Zend\View\Model\ViewModel;

/**
 * Class TwitterController
 *
 * @package UthandoTwitter\Controller
 */
class TwitterController extends AbstractActionController
{
    use ServiceTrait;

    /**
     * @return ViewModel
     * @throws \Exception
     */
    public function twitterFeedAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            throw new \Exception('Not allowed');
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);

        /* @var $service \UthandoTwitter\Service\Twitter */
        $service = $this->getService('UthandoTwitter\Service\Twitter');

        $tweets = $service->getUserTimeLine();
        $viewModel->setVariable('tweets', $tweets);

        return $viewModel;
    }
}
