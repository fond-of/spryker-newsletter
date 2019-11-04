<?php

namespace FondOfSpryker\Yves\Newsletter\Plugin\Provider;

use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use Silex\Application;
use Spryker\Yves\Kernel\BundleConfigResolverAwareTrait;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

/**
 * @method \FondOfSpryker\Yves\CrossEngage\NewsletterConfig getConfig()
 */
class NewsletterControllerProvider extends AbstractYvesControllerProvider
{
    use BundleConfigResolverAwareTrait;

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app): void
    {
        $locale = $app->offsetGet('locale');

        $this
            ->addFormRoute()                // form only
            ->addFormSubmitRoute()          // submit logic
            ->addSubscribeSuccessRoute($locale)    // redirect after submit (contentful)
            ->addConfirmSubscription()      // confirm by token
            ->addUnsubscribe();             // unsubscribe by token
    }

    /**
     * @return $this
     */
    protected function addFormRoute(): self
    {
        $this->createController('/{newsletter}/form', NewsletterConstants::ROUTE_NEWSLETTER_FOOTER, 'Newsletter', 'Newsletter', 'form')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET|POST');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addFormSubmitRoute(): self
    {
        $this->createController('/{newsletter}/submit', NewsletterConstants::ROUTE_NEWSLETTER_SUBMIT_FORM, 'Newsletter', 'Newsletter', 'submit')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET|POST');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addSubscribeSuccessRoute(string $locale): self
    {
        $subscribePathPart = $this->getConfig()->getSubscribePath($locale);

        $this->createController(sprintf('/{newsletter}/%s', $subscribePathPart), NewsletterConstants::ROUTE_NEWSLETTER_SUBSCRIBE_SUCCESS, 'Newsletter', 'Newsletter', 'subscribe')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addConfirmSubscription(): self
    {
        $this->createController('/{newsletter}/confirm-subscription/{token}', NewsletterConstants::ROUTE_NEWSLETTER_CONFIRM_SUBSCRIPTION, 'Newsletter', 'Newsletter', 'confirmSubscription')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addUnsubscribe(): self
    {
        $this->createController('/{newsletter}/unsubscribe/{token}', NewsletterConstants::ROUTE_NEWSLETTER_UNSUBSCRIBE, 'Newsletter', 'Newsletter', 'unsubscribe')
            ->assert('newsletter', $this->getAllowedLocalesPattern() . 'newsletter|newsletter')
            ->value('newsletter', 'newsletter')
            ->method('GET');

        return $this;
    }
}
