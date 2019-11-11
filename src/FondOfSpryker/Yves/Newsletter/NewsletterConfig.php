<?php

namespace FondOfSpryker\Yves\Newsletter;

use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;

class NewsletterConfig extends AbstractBundleConfig
{
    /**
     * @param string $locale
     *
     * @return string
     */
    public function getRedirectSubscribePath(string $locale): string
    {
        return $this->getLocalized(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_SUBSCRIBE, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getRedirectSubscribtionConfirmedPath(string $locale): string
    {
        return $this->getLocalized(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_SUBSCRIPTION_CONFIRMED, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getRedirectAlreadySubscribedPath(string $locale): string
    {
        return $this->getLocalized(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_ALREADY_SUBSCRIBED, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getRedirectFailurePath(string $locale): string
    {
        return $this->getLocalized(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_FAILURE, $locale);
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getRedirectUnsubscribePath(string $locale): string
    {
        return $this->getLocalized(NewsletterConstants::ROUTE_REDIRECT_NEWSLETTER_UNSUBSCRIBED, $locale);
    }

    /**
     * @param string $key
     * @param string $locale
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function getLocalized(string $key, string $locale, $default = null)
    {
        $localizedConfigs = $this->get(NewsletterConstants::NEWSLETTER_LOCALIZED_CONFIGS, []);

        if (!\is_array($localizedConfigs) || empty($localizedConfigs)) {
            return $default;
        }

        if (!\array_key_exists($locale, $localizedConfigs) || !\is_array($localizedConfigs[$locale])) {
            return $default;
        }

        $configs = $localizedConfigs[$locale];

        if (!\array_key_exists($key, $configs)) {
            return $default;
        }

        return $configs[$key];
    }
}
