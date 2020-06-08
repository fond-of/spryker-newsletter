<?php

namespace FondOfSpryker\Yves\Newsletter\Plugin\Router;

use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class NewsletterControllerProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @param  \Spryker\Yves\Router\Route\RouteCollection  $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     * @throws \Spryker\Shared\Kernel\Locale\LocaleNotFoundException
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $locale = $this->getApplication()->offsetGet('locale');

        $routeCollection = $this->addFormRoute($routeCollection);                                  // form only
        $routeCollection = $this->addFormSubmitRoute($routeCollection);                            // submit logic
        $routeCollection = $this->addConfirmSubscription($routeCollection);                        // confirm by token
        $routeCollection = $this->addUnsubscribe($routeCollection);                                // unsubscribe by token
        $routeCollection = $this->addRedirectSubscribeRoute($routeCollection, $locale);            // contentful-redirect after subscribe (addFormSubmitRoute)
        $routeCollection = $this->addRedirectAlreadySubscribed($routeCollection, $locale);         // contentful-redirect if user already subscribed (addConfirmSubscription)
        $routeCollection = $this->addRedirectSubscriptionConfirmedRoute($routeCollection, $locale);// contentful-redirect after subscription confirmend (addConfirmSubscription)
        $routeCollection = $this->addRedirectUnsubscribeRoute($routeCollection, $locale);          // redirect after unsubscribe (contentful)
        $routeCollection = $this->addRedirectFailure($routeCollection, $locale);                   // redirect any other error cases (contentful)

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     *
     * @deprecated Register widget `FondOfSpryker\Yves\Newsletter\Widget\NewsletterFooterFormWidget` instead and use it in tpl. Dont use render in tpl!
     */
    protected function addFormRoute(RouteCollection $routeCollection): RouteCollection
    {
        $name = $this->getName();

        $route = $this->buildRoute(sprintf('%s/form', $name), 'Newsletter', 'Newsletter', 'form');
        $route = $route->setMethods(['GET', 'POST']);
        $routeCollection->add(NewsletterConstants::ROUTE_NEWSLETTER_FOOTER, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addFormSubmitRoute(RouteCollection $routeCollection): RouteCollection
    {
        $name = $this->getName();

        $route = $this->buildRoute(sprintf('%s/submit', $name), 'Newsletter', 'Newsletter', 'submit');
        $route = $route->setMethods(['GET', 'POST']);
        $routeCollection->add(NewsletterConstants::ROUTE_NEWSLETTER_SUBMIT_FORM, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addConfirmSubscription(RouteCollection $routeCollection): RouteCollection
    {
        $name = $this->getName();
        $tokenName = $this->getTokenName();

        $route = $this->buildRoute(sprintf('%s/confirm-subscription/{%s}', $name, $tokenName), 'Newsletter', 'Newsletter', 'confirmSubscription');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(NewsletterConstants::ROUTE_NEWSLETTER_CONFIRM_SUBSCRIPTION, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addUnsubscribe(RouteCollection $routeCollection): RouteCollection
    {
        $name = $this->getName();
        $tokenName = $this->getTokenName();

        $route = $this->buildRoute(sprintf('%s/unsubscribe/{%s}', $name, $tokenName), 'Newsletter', 'Newsletter', 'unsubscribe');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(NewsletterConstants::ROUTE_NEWSLETTER_UNSUBSCRIBE, $route);

        return $routeCollection;
    }

    /**
     * @param  \Spryker\Yves\Router\Route\RouteCollection  $routeCollection
     * @param  string  $locale
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addRedirectSubscribeRoute(RouteCollection $routeCollection, string $locale): RouteCollection
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectSubscribePath($locale);

        $route = $this->buildRoute(sprintf('%s/%s', $name, $subscribePathPart), 'Newsletter', 'Newsletter', '');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_SUBSCRIBE, $route);

        return $routeCollection;
    }

    /**
     * @param  \Spryker\Yves\Router\Route\RouteCollection  $routeCollection
     * @param  string  $locale
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addRedirectSubscriptionConfirmedRoute(RouteCollection $routeCollection, string $locale): RouteCollection
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectSubscribtionConfirmedPath($locale);

        $route = $this->buildRoute(sprintf('%s/%s', $name, $subscribePathPart), 'Newsletter', 'Newsletter', '');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_SUBSCRIPTION_CONFIRMED, $route);

        return $routeCollection;
    }

    /**
     * @param  \Spryker\Yves\Router\Route\RouteCollection  $routeCollection
     * @param  string  $locale
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addRedirectAlreadySubscribed(RouteCollection $routeCollection, string $locale): RouteCollection
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectAlreadySubscribedPath($locale);

        $route = $this->buildRoute(sprintf('%s/%s', $name, $subscribePathPart), 'Newsletter', 'Newsletter', '');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_ALREADY_SUBSCRIBED, $route);

        return $routeCollection;
    }

    /**
     * @param  \Spryker\Yves\Router\Route\RouteCollection  $routeCollection
     * @param  string  $locale
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addRedirectUnsubscribeRoute(RouteCollection $routeCollection, string $locale): RouteCollection
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectUnsubscribePath($locale);

        $route = $this->buildRoute(sprintf('%s/%s', $name, $subscribePathPart), 'Newsletter', 'Newsletter', '');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_UNSUBSCRIBED, $route);

        return $routeCollection;
    }

    /**
     * @param  \Spryker\Yves\Router\Route\RouteCollection  $routeCollection
     * @param  string  $locale
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addRedirectFailure(RouteCollection $routeCollection, string $locale): RouteCollection
    {
        $name = $this->getName();
        $subscribePathPart = $this->getConfig()->getRedirectUnsubscribePath($locale);

        $route = $this->buildRoute(sprintf('%s/%s', $name, $subscribePathPart), 'Newsletter', 'Newsletter', '');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_FAILURE, $route);

        return $routeCollection;
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
