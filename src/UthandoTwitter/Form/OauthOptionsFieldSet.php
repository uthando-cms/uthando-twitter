<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter\Form
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2018 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoTwitter\Form;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\Form\Fieldset;

class OauthOptionsFieldSet extends Fieldset
{
    public function init()
    {
        $this->add([
            'type' => TwitterAccessTokenFieldSet::class,
            'name' => 'access_token',
            'options' => [
                //'label' => 'Twitter Settings',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
            ],
            'attributes' => [
                'class' => 'col-md-12',
            ],
        ]);

        $this->add([
            'type' => TwitterOauthOptionsFieldSet::class,
            'name' => 'oauth_options',
            'options' => [
                //'label' => 'Twitter Settings',
                'twb-layout' => TwbBundleForm::LAYOUT_HORIZONTAL,
            ],
            'attributes' => [
                'class' => 'col-md-12',
            ],
        ]);
    }
}