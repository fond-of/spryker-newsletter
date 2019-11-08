<?php

namespace FondOfSpryker\Service\Newsletter\Model\Url;

use FondOfSpryker\Service\Newsletter\NewsletterConfig;
use FondOfSpryker\Shared\Newsletter\NewsletterConstants;
use Generated\Shared\Transfer\NewsletterTransfer;


class NewsletterUrlBuilder implements NewsletterUrlBuilderInterface
{
    /**
     * @var \FondOfSpryker\Service\Newsletter\Model\Url\NewsletterConfig
     */
    protected $config;

    public function __construct(NewsletterConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param  array $params
     * @return string
     */
    public function buildOptInUrl(array $params): string
    {
        return $this->buildUrl($params, $this->config->getOptInPathPattern());
    }

    /**
     * @param  array $params
     * @return string
     */
    public function buildOptOutUrl(array $params): string
    {
        return $this->buildUrl($params, $this->config->getOptoutPathPattern());
    }

    /**
     * @param  array $params
     * @return string
     */
    protected function buildUrl(array $params, string $pattern): string
    {
        return $this->config->getHostYves() . '/' . vsprintf($pattern, $params);
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
