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
            ->addFormRoute()                        // form only
            ->addFormSubmitRoute()                  // submit logic 
            ->addSubscribeSuccessRoute($locale)     // redirect after submit (contentful)
            ->addAlreadySubscribed($locale)         // redirect if user already subscribed (contentful)
            ->addConfirmSubscription()              // confirm by token
            ->addUnsubscribe()                      // unsubscribe by token
            ->addFailure($locale);                  // any other error cases
    }

    /**
     * @return $this
     */
    protected function addFormRoute(): self
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
    protected function addFormSubmitRoute(): self
    {
        $name = $this->getName();

        $this->createController(sprintf('/{%s}/submit', $name), NewsletterConstants::ROUTE_NEWSLETTER_SUBMIT_FORM, 'Newsletter', 'Newsletter', 'submit')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
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
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getSubscribePath($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_NEWSLETTER_SUBSCRIBE_SUCCESS, 'Newsletter', 'Newsletter', 'subscribe')
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
    protected function addAlreadySubscribed(string $locale): self
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getAlreadySubscribed($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_NEWSLETTER_ALREADY_SUBSCRIBED, 'Newsletter', 'Newsletter', 'subscribe')
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
    protected function addFailure(string $locale): self
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getFailure($locale);

        $this->createController(sprintf('/{%s}/%s', $name, $subscribePathPart), NewsletterConstants::ROUTE_NEWSLETTER_FAILURE, 'Newsletter', 'Newsletter', 'subscribe')
            ->assert($name, $this->getAllowedLocalesPattern() . sprintf('%s|%s', $name, $name))
            ->value($name, $name)
            ->method('GET');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addConfirmSubscription(): self
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
    protected function addUnsubscribe(): self
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
