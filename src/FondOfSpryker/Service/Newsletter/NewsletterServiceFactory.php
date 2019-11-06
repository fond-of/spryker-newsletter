<?php

namespace FondOfSpryker\Service\Newsletter;

use FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilder;
use Spryker\Service\Kernel\AbstractServiceFactory;

class NewsletterServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilder
     */
    public function createNewsletterUrlBuilder(): NewsletterUrlBuilder
    {
        return new NewsletterUrlBuilder(
            $this->getApplication()
        );
    }

    /**
     * @return \Spryker\Shared\Kernel\Communication\Application
     */
    public function getApplication()
    {
        return $this->getProvidedDependency(NewsletterDependencyProvider::PLUGIN_APPLICATION);
    }
}
