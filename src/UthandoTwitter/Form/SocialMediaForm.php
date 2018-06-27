<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoTwitter\Form;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\Form\Form;

class SocialMediaForm extends Form
{
    public function init()
    {
        $this->add([
            'type' => TwitterFieldSet::class,
            'name' => 'twitter',
            'options' => [
                'label' => 'Twitter Settings',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
            ],
            'attributes' => [
                'class' => 'col-md-6',
            ],
        ]);
    }
}