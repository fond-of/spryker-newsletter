<?php

namespace FondOfSpryker\Service\Newsletter;

use FondOfSpryker\Service\Newsletter\Model\Validator\HoneypotValidator;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;
use Spryker\Shared\Kernel\Store;

class NewsletterDependencyProvider extends AbstractBundleDependencyProvider
{
    public const NEWSLETTER_FORM_VALIDATOR = 'NEWSLETTER_FORM_VALIDATOR';
    public const INSTANCE_STORE = 'INSTANCE_STORE';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = $this->addFormValidator($container);
        $container = $this->addStoreInstance($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function addFormValidator(Container $container): Container
    {
        $container[static::NEWSLETTER_FORM_VALIDATOR] = function () {
            return $this->registerFormValidator();
        };

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function addStoreInstance(Container $container): Container
    {
        $container[static::INSTANCE_STORE] = function () {
            return Store::getInstance();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Validator\HoneypotValidator[]
     */
    protected function registerFormValidator(): array
    {
        return [
            new HoneypotValidator(),
        ];
    }
}
