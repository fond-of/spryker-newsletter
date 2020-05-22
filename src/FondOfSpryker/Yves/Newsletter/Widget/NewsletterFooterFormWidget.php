<?php

namespace FondOfSpryker\Yves\Newsletter\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \FondOfSpryker\Yves\Newsletter\NewsletterFactory getFactory()
 */
class NewsletterFooterFormWidget extends AbstractWidget
{
    public function __construct()
    {
        $this->addParameter('newsletterFooterForm', $this->getFactory()->getNewsletterSubscriptionForm()->createView());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'NewsletterFooterFormWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@Newsletter/views/newsletter/footer-form-widget.twig';
    }
}
