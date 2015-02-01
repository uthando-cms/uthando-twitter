<?php
namespace UthandoTwitter\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use UthandoCommon\Controller\ServiceTrait;
use Zend\View\Model\ViewModel;

class TwitterController extends AbstractActionController
{
    use ServiceTrait;
    
    public function twitterFeedAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest()) {
            throw new \Exception('Not allowed');
        }
        
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        
        /* @var $service \UthandoTwitter\Service\Twitter */
        $service = $this->getService('UthandoTwitter\Service\Twitter');
        
        //try {
            $tweets = $service->getUserTimeLine();
            $viewModel->setVariable('tweets', $tweets);
        //} catch (\Exception $e) {
            
        ///}
        
        return $viewModel;
    }
}
