<?php

namespace FondOfSpryker\Yves\Newsletter;

use FondOfSpryker\Yves\CrossEngage\Plugin\Newsletter\CrossEngageSubscribePlugin;
use FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePluginInterface;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class NewsletterDependencyProvider extends AbstractBundleDependencyProvider
{
    public const NEWSLETTER_SUBSCRIBER_PLUGIN = 'NEWSLETTER_SUBSCRIBER_PLUGIN';
    public const SERVICE_NEWSLETTER = 'SERVICE_NEWSLETTER';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = $this->addNewsletterSubscriberPlugins($container);
        $container = $this->addNewsletterService($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function addNewsletterSubscriberPlugins(Container $container): Container
    {
        $container[static::NEWSLETTER_SUBSCRIBER_PLUGIN] = function () {
            return $this->getNewsletterSubscriberPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function addNewsletterService(Container $container): Container
    {
        $container[static::SERVICE_NEWSLETTER] = function (Container $container) {
            return $container->getLocator()->newsletter()->service();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Yves\Newsletter\Dependency\Plugin\NewsletterSubscribePluginInterface|null
     */
    protected function getNewsletterSubscriberPlugin(): ?NewsletterSubscribePluginInterface
    {
        return new CrossEngageSubscribePlugin();
    }
}
