<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitterTest\Controller
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoTwitterTest\Controller;

use UthandoTwitter\Model\TweetCollection;
use UthandoTwitterTest\Framework\ApplicationTestCase;

class TwitterControllerTest extends ApplicationTestCase
{
    public function testTwitterFeedAction()
    {
        $serviceMock = $this->getMockBuilder('UthandoTwitter\Service\Twitter')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceMock->expects($this->once())
            ->method('getUserTimeLine')
            ->will($this->returnValue(new TweetCollection()));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('UthandoTwitter\Service\Twitter', $serviceMock);

        $request = $this->getRequest();
        $headers = $request->getHeaders();
        $headers->addHeaders(array('X-Requested-With' =>'XMLHttpRequest'));

        $this->dispatch('/twitter');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('UthandoTwitter');
        $this->assertControllerName('UthandoTwitter\Controller\Twitter');
        $this->assertControllerClass('TwitterController');
        $this->assertMatchedRouteName('twitter');
    }
}
