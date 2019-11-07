<?php

namespace FondOfSpryker\Service\Newsletter\Model\Url;

use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use FondOfSpryker\Zed\Newsletter\NewsletterConfig;
use Generated\Shared\Transfer\NewsletterTransfer;
use Spryker\Shared\Kernel\Communication\Application;

class NewsletterUrlBuilder implements NewsletterUrlBuilderInterface
{
    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @param  array  $params
     * @return string
     */
    public function buildOptInUrl(array $params = []): string
    {
        return $this->application->url(NewsletterConstants::ROUTE_NEWSLETTER_CONFIRM_SUBSCRIPTION, $params);
    }

    /**
     * @param  array  $params
     * @return string
     */
    public function buildOptOutUrl(array $params = []): string
    {
        return $this->application->url(NewsletterConstants::ROUTE_NEWSLETTER_UNSUBSCRIBE, $params);
    }

    /**
     * @return string
     */
    public function getNameParam(): string
    {
        return NewsletterConstants::NEWSTLETTER;
    }

    /**
     * @return string
     */
    public function getTokenParam(): string
    {
        return NewsletterConstants::TOKEN;
    }
}
