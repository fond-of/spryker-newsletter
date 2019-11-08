<?php

namespace FondOfSpryker\Service\Newsletter;

use FondOfSpryker\Service\Newsletter\Model\Generator\HashGenerator;
use FondOfSpryker\Service\Newsletter\Model\Generator\HashGeneratorInterface;
use FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilder;
use FondOfSpryker\Service\Newsletter\Model\Url\NewsletterUrlBuilderInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

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
}
