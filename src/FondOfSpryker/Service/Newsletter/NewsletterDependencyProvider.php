<?php

namespace FondOfSpryker\Service\Newsletter;

use FondOfSpryker\Service\Newsletter\Model\Validator\HoneypotValidator;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;

class NewsletterDependencyProvider extends AbstractBundleDependencyProvider
{
    public const NEWSLETTER_FORM_VALIDATOR = 'NEWSLETTER_FORM_VALIDATOR';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = $this->addFormValidator($container);

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
     * @return \FondOfSpryker\Service\Newsletter\Model\Validator\HoneypotValidator[]
     */
    protected function registerFormValidator(): array
    {
        return [
            new HoneypotValidator(),
        ];
    }
}
