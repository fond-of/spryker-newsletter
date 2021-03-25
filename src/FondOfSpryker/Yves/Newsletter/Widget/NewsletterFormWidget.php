<?php

namespace FondOfSpryker\Yves\Newsletter\Widget;

use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \FondOfSpryker\Yves\Newsletter\NewsletterFactory getFactory()
 */
class NewsletterFormWidget extends AbstractWidget
{
    /**
     * NewsletterFormWidget constructor.
     *
     * @param  string|null  $source
     */
    public function __construct(?string $source = null)
    {
        $this->addParameter('newsletterForm', $this->getFactory()->getNewsletterSubscriptionForm()->createView());
        $this->addParameter('source', $source);
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'NewsletterFormWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@Newsletter/views/newsletter/form-widget.twig';
    }
}
