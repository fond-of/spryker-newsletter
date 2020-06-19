<?php

namespace FondOfSpryker\Service\Newsletter;

use FondOfSpryker\Service\Newsletter\Model\Generator\HashGenerator;
use FondOfSpryker\Service\Newsletter\Model\Generator\HashGeneratorInterface;
use FondOfSpryker\Service\Newsletter\Model\Resolver\LanguagePrefixResolver;
use FondOfSpryker\Service\Newsletter\Model\Resolver\ResolverInterface;
use FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilder;
use FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilderInterface;
use FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorCollection;
use FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorCollectionInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Shared\Kernel\Store;

class NewsletterServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilder
     */
    public function createNewsletterUrlBuilder(): NewsletterUrlBuilderInterface
    {
        return new NewsletterUrlBuilder($this->getConfig());
    }

    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Generator\HashGeneratorInterface
     */
    public function createHashGenerator(): HashGeneratorInterface
    {
        return new HashGenerator($this->getConfig());
    }

    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Resolver\ResolverInterface
     */
    public function createLanguagePrefixResolver(): ResolverInterface
    {
        return new LanguagePrefixResolver($this->getStoreInstance());
    }

    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Validator\FormValidatorCollectionInterface
     */
    public function createFormValidatorCollection(): FormValidatorCollectionInterface
    {
        return new FormValidatorCollection($this->getProvidedDependency(NewsletterDependencyProvider::NEWSLETTER_FORM_VALIDATOR));
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStoreInstance(): Store
    {
        return $this->getProvidedDependency(NewsletterDependencyProvider::INSTANNCE_STORE);
    }
}
