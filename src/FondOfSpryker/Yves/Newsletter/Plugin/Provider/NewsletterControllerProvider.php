<?php

namespace FondOfSpryker\Yves\Newsletter\Plugin\Provider;

use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use Silex\Application;
use Spryker\Yves\Kernel\BundleConfigResolverAwareTrait;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

/**
 * @deprecated use FondOfSpryker\Yves\Newsletter\Plugin\Router\NewsletterControllerProviderPlugin instead
 * @method \FondOfSpryker\Yves\Newsletter\NewsletterConfig getConfig()
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
            ->addFormRoute()                                // form only
            ->addFormSubmitRoute()                          // submit logic
            ->addConfirmSubscription()                      // confirm by token
            ->addUnsubscribe()                              // unsubscribe by token
            ->addRedirectSubscribeRoute($locale)            // contentful-redirect after subscribe (addFormSubmitRoute)
            ->addRedirectAlreadySubscribed($locale)         // contentful-redirect if user already subscribed (addConfirmSubscription)
            ->addRedirectSubscriptionConfirmedRoute($locale)// contentful-redirect after subscription confirmend (addConfirmSubscription)
            ->addRedirectUnsubscribeRoute($locale)          // redirect after unsubscribe (contentful)
            ->addRedirectFailure($locale);                  // redirect any other error cases (contentful)
    }

    /**
     * @return $this
     */
    protected function addFormRoute()
    {
        $name = $this->getName();

        $this->createController(sprintf('/{%s}/form', $name), NewsletterConstants::ROUTE_NEWSLETTER_FOOTER, 'Newsletter', 'Newsletter', 'form')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET|POST');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addFormSubmitRoute()
    {
        $name = $this->getName();

        $this->createController(sprintf('/{%s}/submit', $name), NewsletterConstants::ROUTE_NEWSLETTER_SUBMIT_FORM, 'Newsletter', 'Newsletter', 'submit')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET|POST');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addConfirmSubscription()
    {
        $name = $this->getName();
        $tokenName = $this->getTokenName();

        $this->createController(sprintf('/{%s}/confirm-subscription/{%s}', $name, $tokenName), NewsletterConstants::ROUTE_NEWSLETTER_CONFIRM_SUBSCRIPTION, 'Newsletter', 'Newsletter', 'confirmSubscription')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addUnsubscribe()
    {
        $name = $this->getName();
        $tokenName = $this->getTokenName();

        $this->createController(sprintf('/{%s}/unsubscribe/{%s}', $name, $tokenName), NewsletterConstants::ROUTE_NEWSLETTER_UNSUBSCRIBE, 'Newsletter', 'Newsletter', 'unsubscribe')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addRedirectSubscribeRoute(string $locale)
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectSubscribePath($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_SUBSCRIBE, 'Newsletter', 'Newsletter', '')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addRedirectSubscriptionConfirmedRoute(string $locale)
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectSubscribtionConfirmedPath($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_SUBSCRIPTION_CONFIRMED, 'Newsletter', 'Newsletter', '')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addRedirectAlreadySubscribed(string $locale)
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectAlreadySubscribedPath($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_ALREADY_SUBSCRIBED, 'Newsletter', 'Newsletter', '')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addRedirectUnsubscribeRoute(string $locale)
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectUnsubscribePath($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_UNSUBSCRIBED, 'Newsletter', 'Newsletter', '')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @param string $locale
     *
     * @return $this
     */
    protected function addRedirectFailure(string $locale)
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectFailurePath($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_FAILURE, 'Newsletter', 'Newsletter', '')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @return string
     */
    protected function getName(): string
    {
        return NewsletterConstants::NEWSTLETTER;
    }

    /**
     * @return string
     */
    protected function getTokenName(): string
    {
        return NewsletterConstants::TOKEN;
    }
}
