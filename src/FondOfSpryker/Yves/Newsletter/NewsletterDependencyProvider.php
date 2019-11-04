<?php

namespace FondOfSpryker\Yves\Newsletter;

use FondOfSpryker\Yves\CrossEngage\Plugin\Newsletter\CrossEngageSubscribePlugin;
use FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePlugin;
use FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePluginInterface;
use FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePluginInterface as NewsletterSubscribePluginInterfaceAlias;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class NewsletterDependencyProvider extends AbstractBundleDependencyProvider
{
    const NEWSLETTER_SUBSCRIBER_PLUGIN = 'NEWSLETTER_SUBSCRIBER_PLUGIN';

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addNewsletterSubscriberPlugins($container);

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function addNewsletterSubscriberPlugins(Container $container): Container
    {
        $container[static::NEWSLETTER_SUBSCRIBER_PLUGIN] = function () {
            return $this->getNewsletterSubscriberPlugin();
        };

        return $container;
    }

    /**
     * @return NewsletterSubscribePluginInterfaceAlias|null
     */
    protected function getNewsletterSubscriberPlugin(): ?NewsletterSubscribePluginInterface
    {
        return new CrossEngageSubscribePlugin();
    }
}
